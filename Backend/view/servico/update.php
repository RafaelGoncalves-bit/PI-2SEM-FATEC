<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<form action="<?= BASE_URL ?>/controller/ServicoController.php?acao=atualizar" method="POST">
    
    <input type="hidden" name="id" value="<?= $servicoAtual->getId() ?>">

  <div class="mb-3">
    <label for="nome" class="form-label">Nome:</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?= $servicoAtual->getNome() ?>">
  </div>

  <div class="mb-3">
    <label for="descricao" class="form-label">Descricao</label>
    <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $servicoAtual->getDescricao() ?>">
  </div>  

  <div class="mb-3">
    <label for="preco_base" class="form-label">Preço Base</label>
    <input type="text" class="form-control" id="preco_base" name="preco_base" value="<?= $servicoAtual->getPrecoBase() ?>">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
require_once __DIR__ . '/../partials/footer.php';

?>