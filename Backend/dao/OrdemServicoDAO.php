<?php
// Backend/dao/OrdemServicoDAO.php

require_once __DIR__ . '/../model/OrdemServicoModel.php';

class OrdemServicoDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Cria a OS baseada no orçamento aprovado
    public function criarAPartirDoOrcamento($orcamentoId) {
        $sql = "INSERT INTO ordem_servico (orcamento_id, data_geracao, status_servico) 
                VALUES (?, NOW(), 'Aguardando')";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $orcamentoId);
        $stmt->execute();
        
        // Retorna o ID da nova OS gerada
        return $this->pdo->lastInsertId();
    }

    // Busca OS que ainda não tem agendamento (Para o select do formulário de agenda)
// Backend/dao/OrdemServicoDAO.php

    public function listarPendentes() {
        // Traz OS + Nome do Cliente + Data Geração
        $sql = "SELECT os.id, os.data_geracao, c.nome as cliente_nome, c.endereco 
                FROM ordem_servico os
                JOIN orcamento o ON os.orcamento_id = o.id
                JOIN cliente c ON o.cliente_id = c.id
                WHERE os.status_servico = 'Aguardando'
                ORDER BY os.data_geracao ASC"; // As mais antigas primeiro (fila)
                
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTodas() {
        // Traz OS + Nome Cliente + Status + Valor (do Orçamento)
        $sql = "SELECT os.*, c.nome as cliente_nome, o.valor_total 
                FROM ordem_servico os
                JOIN orcamento o ON os.orcamento_id = o.id
                JOIN cliente c ON o.cliente_id = c.id
                ORDER BY os.id DESC"; // As mais novas primeiro
                
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarStatus($id, $novoStatus) {
        $sql = "UPDATE ordem_servico SET status_servico = ? WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $novoStatus);
        $stmt->bindValue(2, $id);
        
        return $stmt->execute();
    }

    public function concluir($id) {
        try {
            $sql = "CALL sp_concluir_os(?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao concluir OS: " . $e->getMessage());
        }
    }
}
