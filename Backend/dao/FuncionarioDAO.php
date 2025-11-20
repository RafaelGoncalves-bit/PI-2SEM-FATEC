<?php
// Backend/dao/FuncionarioDAO.php

// Importa o modelo para que o PHP entenda o que é "FuncionarioModel"
require_once __DIR__ . '/../model/FuncionarioModel.php';

class FuncionarioDAO {
    private $pdo;

    // Recebe a conexão pronta do Controller
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ==================================================================
    // C - CADASTRAR
    // ==================================================================
    public function cadastrar(FuncionarioModel $funcionario) {
        $sql = "INSERT INTO funcionario (nome, email, cpf, telefone) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $funcionario->getNome());
        $stmt->bindValue(2, $funcionario->getEmail());
        $stmt->bindValue(3, $funcionario->getCpf());
        $stmt->bindValue(4, $funcionario->getTelefone());

        
        return $stmt->execute();
    }

    // ==================================================================
    // R - LISTAR TODOS (Para o index.php)
    // ==================================================================
    public function listarTodos() {
        $sql = "SELECT * FROM funcionario ORDER BY nome ASC";
        $stmt = $this->pdo->query($sql);
        
        // Retorna arrays associativos puros do banco
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================================================
    // R - BUSCAR POR ID (Para o update.php)
    // ==================================================================
    public function buscarPorId($id) {
        $sql = "SELECT * FROM funcionario WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se achar, cria o Objeto FuncionarioModel e devolve preenchido
        if ($dado) {
            $funcionario = new FuncionarioModel();
            $funcionario->setId($dado['id']);
            $funcionario->setNome($dado['nome']);
            $funcionario->setEmail($dado['email']);
            $funcionario->setCpf($dado['cpf']);
            $funcionario->setTelefone($dado['telefone']);

            
            return $funcionario;
        }
        
        return null;
    }

    // ==================================================================
    // U - ATUALIZAR
    // ==================================================================
    public function atualizar(FuncionarioModel $funcionario) {
        $sql = "UPDATE funcionario SET nome = ?, email = ?, telefone = ? WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $funcionario->getNome());
        $stmt->bindValue(2, $funcionario->getEmail());
        $stmt->bindValue(3, $funcionario->getTelefone()); 
        $stmt->bindValue(4, $funcionario->getId()); 
        
        return $stmt->execute();
    }

    // ==================================================================
    // D - EXCLUIR
    // ==================================================================
    public function excluir($id) {
        $sql = "DELETE FROM funcionario WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }
}