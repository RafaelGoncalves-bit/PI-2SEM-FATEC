<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<form action="<?= BASE_URL ?>/controller/TamanhoController.php?acao=atualizar" method="POST">
    
    <input type="hidden" name="id" value="<?= $tamanhoAtual->getId() ?>">

  <div class="mb-3">
    <label for="dimensao" class="form-label">Dimensão:</label>
    <input type="text" class="form-control" id="dimensao" name="dimensao" value="<?= $tamanhoAtual->getDimensao() ?>">
  </div>

  <div class="mb-3">
    <label for="preco_base" class="form-label">Multiplicador de Preço</label>
    <input type="text" class="form-control" id="preco_base" name="multiplicador_preco" value=<?= $tamanhoAtual->getMultiplicadorPreco() ?>>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
require_once __DIR__ . '/../partials/footer.php';

?>