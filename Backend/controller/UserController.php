<?php
require_once __DIR__ . '/../model/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioModel = new UserModel();

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco']; 

    $resultado = $usuarioModel->inserir($nome, $telefone, $email, $endereco);

    if ($resultado) {
        echo "<h1> usuario cadastrado com sucesso</h1>";
    } else {
        echo "Erro ao cadastrar usuário.";
    }

    
}