<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<form class="container mt-2" method="post" action="<?= BASE_URL ?>/controller/FuncionarioController.php?acao=atualizar">
    <input type="hidden" name="id" value="<?= $funcionarioAtual->getId() ?>">


  <div class="mb-3">
    <label for="nome" class="form-label">Nome do Funcionario:</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?= $funcionarioAtual->getNome() ?>">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="text" class="form-control" id="email" name="email" value="<?= $funcionarioAtual->getEmail() ?>">
  </div>
  <div class="mb-3">
    <label for="telefone" class="form-label">Telefone:</label>
    <input type="number" class="form-control" id="telefone" name="telefone" value="<?= $funcionarioAtual->getTelefone() ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
require_once __DIR__ . '/../partials/footer.php';

?>