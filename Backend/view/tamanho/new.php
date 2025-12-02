<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';

$isEdit = isset($tamanho) && !empty($tamanho);
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <?= $isEdit ? '✏️ Editar Tamanho' : '📏 Novo Tamanho' ?>
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="<?= BASE_URL ?>/controller/TamanhoController.php?acao=salvar" method="POST">
                        
                        <?php if ($isEdit): ?>
                            <input type="hidden" name="id" value="<?= $tamanho->getId() ?>">
                        <?php endif; ?>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="dimensao" name="dimensao" placeholder="Dimensão" required
                                   value="<?= $isEdit ? $tamanho->getDimensao() : '' ?>">
                            <label for="dimensao">Descrição (ex: 3 Lugares, King Size)</label>
                        </div>

                        <div class="form-floating mb-2">
                            <input type="number" step="0.01" class="form-control" id="multiplicador" name="multiplicador_preco" placeholder="1.00" required
                                   value="<?= $isEdit ? $tamanho->getMultiplicadorPreco() : '' ?>">
                            <label for="multiplicador">Fator Multiplicador</label>
                        </div>
                        
                        <div class="alert alert-info d-flex align-items-center mb-4 py-2">
                            <small>
                                ℹ️ <strong>Como funciona:</strong><br>
                                1.00 = Preço Normal<br>
                                1.50 = Aumenta 50% do valor<br>
                                2.00 = Dobra o valor
                            </small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= BASE_URL ?>/controller/TamanhoController.php?acao=listar" class="btn btn-light me-md-2 border">Cancelar</a>
                            <button type="submit" class="btn btn-success px-5">💾 Salvar</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>