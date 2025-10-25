<?php
require_once __DIR__ . '/../partials/navbar.php';

?>

<form class="container mt-2" method="post" action="<?= BASE_URL ?>/controller/TipoController.php">
  <div class="mb-3">
    <label for="nome_tipo" class="form-label">Tipo de Serviço:</label>
    <input type="text" class="form-control" id="nome_tipo" name="nome">
  </div>
  <div class="mb-3">
    <label for="descricao_tipo" class="form-label">Descrição:</label>
    <input type="text" class="form-control" id="descricao_tipo" name="descricao">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>