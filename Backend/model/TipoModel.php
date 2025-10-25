<?php
require_once __DIR__ . '/../config/db.php';

class TipoModel {
    private $pdo;
    private $table = 'tipos_servico'; // nome correto da tabela

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // ✅ LISTAR TODOS
    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ BUSCAR POR ID
    public function buscarPorId($id_tipo) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_tipo = ?");
        $stmt->execute([$id_tipo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ INSERIR NOVO REGISTRO
    public function inserir($nome_tipo, $descricao) {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (nome_tipo, descricao) VALUES (?, ?)");
        return $stmt->execute([$nome_tipo, $descricao]);
    }

    // ✅ ATUALIZAR REGISTRO EXISTENTE
    public function atualizar($id_tipo, $nome_tipo, $descricao) {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} 
                                     SET nome_tipo = ?, descricao = ? 
                                     WHERE id_tipo = ?");
        return $stmt->execute([$nome_tipo, $descricao, $id_tipo]);
    }

    // ✅ EXCLUIR REGISTRO
    public function excluir($id_tipo) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_tipo = ?");
        return $stmt->execute([$id_tipo]);
    }
}
