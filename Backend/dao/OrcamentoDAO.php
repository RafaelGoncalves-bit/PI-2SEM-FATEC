<?php
// Backend/dao/OrcamentoDAO.php

require_once __DIR__ . '/../model/OrcamentoModel.php';
require_once __DIR__ . '/../model/ItemOrcamentoModel.php';

class OrcamentoDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ==================================================================
    // C - CADASTRAR (A Mágica da Transação)
    // ==================================================================
    public function cadastrar(OrcamentoModel $orcamento) {
        try {
            // 1. Inicia a Transação (Trava o banco para essa operação)
            $this->pdo->beginTransaction();

            // ---------------------------------------------------------
            // PASSO A: Salvar o MESTRE (Tabela orcamento)
            // ---------------------------------------------------------
            $sqlOrcamento = "INSERT INTO orcamento (cliente_id, data_emissao, valor_total, status) 
                             VALUES (?, ?, ?, ?)";
            
            $stmt = $this->pdo->prepare($sqlOrcamento);
            $stmt->bindValue(1, $orcamento->getClienteId());
            $stmt->bindValue(2, $orcamento->getDataEmissao());
            $stmt->bindValue(3, $orcamento->getValorTotal());
            $stmt->bindValue(4, $orcamento->getStatus());
            $stmt->execute();

            // O PULO DO GATO: Pegar o ID que acabou de ser gerado
            $idOrcamentoGerado = $this->pdo->lastInsertId();

            // ---------------------------------------------------------
            // PASSO B: Salvar os DETALHES (Tabela item_orcamento)
            // ---------------------------------------------------------
            $sqlItem = "INSERT INTO item_orcamento (orcamento_id, servico_id, tamanho_id, quantidade, valor_calculado) 
                        VALUES (?, ?, ?, ?, ?)";
            $stmtItem = $this->pdo->prepare($sqlItem);

            // Loop para salvar cada item da lista
            foreach ($orcamento->getItens() as $item) {
                $stmtItem->bindValue(1, $idOrcamentoGerado); // Usa o ID do passo A
                $stmtItem->bindValue(2, $item->getServicoId());
                $stmtItem->bindValue(3, $item->getTamanhoId());
                $stmtItem->bindValue(4, $item->getQuantidade());
                $stmtItem->bindValue(5, $item->getValorCalculado());
                $stmtItem->execute();
            }

            // 2. Se chegou até aqui, confirma tudo!
            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            // 3. Se der qualquer erro, desfaz tudo (apaga o mestre se já tinha salvo)
            $this->pdo->rollBack();
            throw $e; // Joga o erro para o Controller tratar
        }
    }

    // ==================================================================
    // R - LISTAR TODOS (Com JOIN para pegar o nome do cliente)
    // ==================================================================
    public function listarTodos() {
        // JOIN: Cruzamos a tabela orcamento com a cliente para mostrar o nome na tela
        $sql = "SELECT o.*, c.nome AS nome_cliente 
                FROM orcamento o
                JOIN cliente c ON o.cliente_id = c.id 
                ORDER BY o.data_emissao DESC";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================================================
    // R - BUSCAR COMPLETO (Recupera Mestre + Itens)
    // ==================================================================
    public function buscarPorId($id) {
        // 1. Busca o Mestre
        $sql = "SELECT * FROM orcamento WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $dadoOrcamento = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dadoOrcamento) return null;

        // Hidrata o Objeto Mestre
        $orcamento = new OrcamentoModel();
        $orcamento->setId($dadoOrcamento['id']);
        $orcamento->setClienteId($dadoOrcamento['cliente_id']);
        $orcamento->setDataEmissao($dadoOrcamento['data_emissao']);
        $orcamento->setValorTotal($dadoOrcamento['valor_total']);
        $orcamento->setStatus($dadoOrcamento['status']);

        // 2. Busca os Itens desse orçamento
        $sqlItens = "SELECT i.*, s.nome as nome_servico, t.dimensao 
                     FROM item_orcamento i
                     JOIN servico s ON i.servico_id = s.id
                     JOIN tamanho t ON i.tamanho_id = t.id
                     WHERE i.orcamento_id = ?";
        
        $stmtItens = $this->pdo->prepare($sqlItens);
        $stmtItens->bindValue(1, $id);
        $stmtItens->execute();
        $listaItens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

        // Hidrata e adiciona cada Item ao Mestre
        foreach ($listaItens as $row) {
            $item = new ItemOrcamentoModel();
            $item->setId($row['id']);
            $item->setOrcamentoId($row['orcamento_id']);
            $item->setServicoId($row['servico_id']);
            $item->setTamanhoId($row['tamanho_id']);
            $item->setQuantidade($row['quantidade']);
            $item->setValorCalculado($row['valor_calculado']);
            $item->setNomeServico($row['nome_servico']); // O alias que usamos no SQL
            $item->setNomeTamanho($row['dimensao']);
            
            // Adiciona na lista interna do Model
            $orcamento->addItem($item);
        }

        return $orcamento;
    }

    // ==================================================================
    // U - ATUALIZAR STATUS (Por enquanto, só atualizamos status/total)
    // ==================================================================
    public function atualizarStatus($id, $novoStatus) {
        $sql = "UPDATE orcamento SET status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $novoStatus);
        $stmt->bindValue(2, $id);
        return $stmt->execute();
    }

    // ==================================================================
    // D - EXCLUIR (Cascade cuida dos itens)
    // ==================================================================
    public function excluir($id) {
        // Graças ao 'ON DELETE CASCADE' no banco, apagar o pai apaga os filhos
        $sql = "DELETE FROM orcamento WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}