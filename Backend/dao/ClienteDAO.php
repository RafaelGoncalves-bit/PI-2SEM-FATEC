<?php
// Backend/dao/ClienteDAO.php

require_once __DIR__ . '/../model/ClienteModel.php';

class ClienteDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ==================================================================
    // C - CADASTRAR
    // ==================================================================
    public function cadastrar(ClienteModel $cliente) {
        // Note que estamos gravando a senha (mesmo que seja nula)
        $sql = "INSERT INTO cliente (nome, endereco, telefone, email, tipo, documento, senha) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $cliente->getNome());
        $stmt->bindValue(2, $cliente->getEndereco());
        $stmt->bindValue(3, $cliente->getTelefone());
        $stmt->bindValue(4, $cliente->getEmail());
        $stmt->bindValue(5, $cliente->getTipo());
        $stmt->bindValue(6, $cliente->getDocumento()); // Lembre-se que o Model já limpa (tira pontos/traços)
        $stmt->bindValue(7, $cliente->getSenha()); // Vai gravar NULL por enquanto
        
        return $stmt->execute();
    }

    // ==================================================================
    // R - LISTAR TODOS
    // ==================================================================
    public function listarTodos() {
        $sql = "SELECT * FROM cliente ORDER BY nome ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================================================
    // R - BUSCAR POR ID (Para preencher o form de edição)
    // ==================================================================
    public function buscarPorId($id) {
        $sql = "SELECT * FROM cliente WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dado) {
            $cliente = new ClienteModel();
            $cliente->setId($dado['id']);
            $cliente->setNome($dado['nome']);
            $cliente->setEndereco($dado['endereco']);
            $cliente->setTelefone($dado['telefone']);
            $cliente->setEmail($dado['email']);
            $cliente->setTipo($dado['tipo']);
            $cliente->setDocumento($dado['documento']);
            // Não vamos puxar a senha para a tela de edição por segurança
            
            return $cliente;
        }
        return null;
    }

    // ==================================================================
    // U - ATUALIZAR
    // ==================================================================
    public function atualizar(ClienteModel $cliente) {
        // Nota: Este update NÃO mexe na senha.
        // A lógica de "mudar senha" deve ser um método separado no futuro.
        $sql = "UPDATE cliente SET nome = ?, endereco = ?, telefone = ?, email = ?, tipo = ?, documento = ? 
                WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $cliente->getNome());
        $stmt->bindValue(2, $cliente->getEndereco());
        $stmt->bindValue(3, $cliente->getTelefone());
        $stmt->bindValue(4, $cliente->getEmail());
        $stmt->bindValue(5, $cliente->getTipo());
        $stmt->bindValue(6, $cliente->getDocumento());
        $stmt->bindValue(7, $cliente->getId());
        
        return $stmt->execute();
    }

    // ==================================================================
    // D - EXCLUIR
    // ==================================================================
    public function excluir($id) {
        // CUIDADO: Se o cliente já tiver orçamentos, o banco pode travar
        // (por causa da Chave Estrangeira).
        // No futuro, o ideal é "desativar" o cliente em vez de "excluir".
        $sql = "DELETE FROM cliente WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }
}