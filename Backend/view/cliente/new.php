<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<form class="container mt-2" method="post" action="<?= BASE_URL ?>/controller/ClienteController.php?acao=cadastrar">
  <div class="mb-3">
    <label for="nome" class="form-label">Nome:</label>
    <input type="text" class="form-control" id="nome" name="nome" required>
  </div>

  <div class="mb-3">
    <label for="endereco" class="form-label">Endereço:</label>
    <input type="text" class="form-control" id="endereco" name="endereco" required>
  </div>

  <div class="mb-3">
    <label for="telefone" class="form-label">Telefone:</label>
    <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(19) 99999-9900">
    
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="text" class="form-control" id="email" name="email" required>
  </div>

  <select class="form-select" aria-label="Default select example" name="tipo" required>
    <option selected>Tipo Cliente</option>
    <option value="Fisico">Pessoa Fisica (CPF)</option>
    <option value="Juridico">Pessoa Jurícida (CNPJ)</option>
  </select>   

  <div class="mb-3">
    <label for="documento" class="form-label">Documento:</label>
    <input type="text" class="form-control" id="documento" name="documento" required>
  </div>

  <button type="submit" class="btn btn-primary mt-3">Submit</button>

</form>  

<?php
require_once __DIR__ . '/../partials/footer.php';

?>