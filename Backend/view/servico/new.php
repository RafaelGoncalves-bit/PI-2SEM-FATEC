<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';

$isEdit = isset($servico) && !empty($servico);
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <?= $isEdit ? '✏️ Editar Serviço' : '🧹 Novo Serviço' ?>
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="<?= BASE_URL ?>/controller/ServicoController.php?acao=salvar" method="POST">
                        
                        <?php if ($isEdit): ?>
                            <input type="hidden" name="id" value="<?= $servico->getId() ?>">
                        <?php endif; ?>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required
                                   value="<?= $isEdit ? $servico->getNome() : '' ?>">
                            <label for="nome">Nome do Serviço (ex: Lavagem Sofá)</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="descricao" name="descricao" placeholder="Desc" style="height: 100px"><?= $isEdit ? $servico->getDescricao() : '' ?></textarea>
                            <label for="descricao">Descrição Detalhada</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="preco" name="preco" placeholder="0,00" required
                                   value="<?= $isEdit ? number_format($servico->getprecoBase() , 2, ',', '.') : '' ?>">
                            <label for="preco">Preço Base (R$)</label>
                            <div class="form-text">Use vírgula para centavos (ex: 150,00).</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= BASE_URL ?>/controller/ServicoController.php?acao=listar" class="btn btn-light me-md-2 border">Cancelar</a>
                            <button type="submit" class="btn btn-success px-5">💾 Salvar</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>