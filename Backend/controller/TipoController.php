<?php
require_once __DIR__ . '/../model/TipoModel.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipoModel = new TipoModel();

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $resultado = $tipoModel->inserir($nome, $descricao);

    if ($resultado) {
        echo "<h1>Deu certo!</h1>";
    } else {
        echo "<h1>Erro ao cadastrar usuário.</h1>";
    }

}
?>