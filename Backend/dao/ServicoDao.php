<?php
// Backend/dao/ServicoDAO.php

// Importa o modelo para que o PHP entenda o que é "ServicoModel"
require_once __DIR__ . '/../model/ServicoModel.php';

class ServicoDAO {
    private $pdo;

    // Recebe a conexão pronta do Controller
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ==================================================================
    // C - CADASTRAR
    // ==================================================================
    public function cadastrar(ServicoModel $servico) {
        $sql = "INSERT INTO servico (nome, descricao, preco_base) VALUES (?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $servico->getNome());
        $stmt->bindValue(2, $servico->getDescricao());
        $stmt->bindValue(3, $servico->getPrecoBase());
        
        return $stmt->execute();
    }

    // ==================================================================
    // R - LISTAR TODOS (Para o index.php)
    // ==================================================================
    public function listarTodos() {
        $sql = "SELECT * FROM servico ORDER BY nome ASC";
        $stmt = $this->pdo->query($sql);
        
        // Retorna arrays associativos puros do banco
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================================================
    // R - BUSCAR POR ID (Para o update.php)
    // ==================================================================
    public function buscarPorId($id) {
        $sql = "SELECT * FROM servico WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se achar, cria o Objeto ServicoModel e devolve preenchido
        if ($dado) {
            $servico = new ServicoModel();
            $servico->setId($dado['id']);
            $servico->setNome($dado['nome']);
            $servico->setDescricao($dado['descricao']);
            $servico->setPrecoBase($dado['preco_base']);
            
            return $servico;
        }
        
        return null;
    }

    // ==================================================================
    // U - ATUALIZAR
    // ==================================================================
    public function atualizar(ServicoModel $servico) {
        $sql = "UPDATE servico SET nome = ?, descricao = ?, preco_base = ? WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $servico->getNome());
        $stmt->bindValue(2, $servico->getDescricao());
        $stmt->bindValue(3, $servico->getPrecoBase());
        $stmt->bindValue(4, $servico->getId()); // Importante para o WHERE
        
        return $stmt->execute();
    }

    // ==================================================================
    // D - EXCLUIR
    // ==================================================================
    public function excluir($id) {
        $sql = "DELETE FROM servico WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }
}