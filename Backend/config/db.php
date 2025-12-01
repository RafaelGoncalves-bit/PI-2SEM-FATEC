<?php
date_default_timezone_set('America/Sao_Paulo');

class Database {
    private $host = "localhost";
    private $dbname = "u579326255_g1";
    private $username = "u579326255_g1";
    private $password = "Uo5@Q:djSd";
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->pdo = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
define('BASE_URL', 'public_html/g1');


?>