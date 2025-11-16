<?php
// Backend/dao/TamanhoDAO.php

require_once __DIR__ . '/../model/TamanhoModel.php';

class TamanhoDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // C - Cadastrar
    public function cadastrar(TamanhoModel $tamanho) {
        $sql = "INSERT INTO tamanho (dimensao, multiplicador_preco) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $tamanho->getDimensao());
        $stmt->bindValue(2, $tamanho->getMultiplicadorPreco());
        return $stmt->execute();
    }

    // R - Listar
    public function listarTodos() {
        $sql = "SELECT * FROM tamanho ORDER BY dimensao ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // R - Buscar por ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM tamanho WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dado) {
            $tamanho = new TamanhoModel();
            $tamanho->setId($dado['id']);
            $tamanho->setDimensao($dado['dimensao']);
            $tamanho->setMultiplicadorPreco($dado['multiplicador_preco']);
            return $tamanho;
        }
        return null;
    }

    // U - Atualizar
    public function atualizar(TamanhoModel $tamanho) {
        $sql = "UPDATE tamanho SET dimensao = ?, multiplicador_preco = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $tamanho->getDimensao());
        $stmt->bindValue(2, $tamanho->getMultiplicadorPreco());
        $stmt->bindValue(3, $tamanho->getId());
        return $stmt->execute();
    }

    // D - Excluir
    public function excluir($id) {
        $sql = "DELETE FROM tamanho WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}