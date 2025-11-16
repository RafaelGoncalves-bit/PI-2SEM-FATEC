<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<form class="container mt-2" method="post" action="<?= BASE_URL ?>/controller/TamanhoController.php?acao=cadastrar">
  <div class="mb-3">
    <label for="nome_tipo" class="form-label">Dimensão:</label>
    <input type="text" class="form-control" id="dimensao" name="dimensao" placeholder="EX: Padrão">
    <small>Padrão = 2 Lugares - Grande = 3 Lugares - Assim Por Diante</small>
  </div>

  <div class="mb-3">
    <label for="descricao_tipo" class="form-label">Multiplicador de preço:</label>
    <input type="number" class="form-control" name="multiplicador_preco" step="0.01" min="0.01" placeholder="Ex: 1.0" required>  </div>
    <small>Use 1.0 para preço normal, 1.5 para aumentar 50%, 2.0 para dobrar.</small> <br>
  <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>

<?php
require_once __DIR__ . '/../partials/footer.php';

?>