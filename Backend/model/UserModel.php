<?php
require_once __DIR__ . '/../config/db.php';

class UserModel {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function inserir($nome, $telefone, $email, $endereco) {
        $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, telefone, email, endereco) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $telefone, $email, $endereco]);
    }

    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM clientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id_cliente = ?");
        return $stmt->execute([$id]);
    }

    public function buscarPorEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //ARRUMAR DAQ PARA BAIXO!!!
    public function atualizar($id, $nome, $email, $senha = null) {
    $sql = "UPDATE clientes SET nome = ?, email = ?";
    $params = [$nome, $email];

    if (!empty($senha)) {
        $sql .= ", senha = ?";
        $params[] = $senha;
    }

    $sql .= " WHERE id_usuario = ?";
    $params[] = $id;

    $stmt = $this->pdo->prepare($sql); // <-- Corrigido para $this->pdo
    return $stmt->execute($params);
}


}