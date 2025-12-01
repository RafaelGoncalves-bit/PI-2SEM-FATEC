<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';

// Verifica se estamos editando (Checa se o objeto existe e tem ID)
// NOTA: Agora usamos a seta (->) e o método getId()
$isEdit = isset($cliente) && $cliente->getId();
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <?= $isEdit ? '✏️ Editar Cliente' : '👤 Novo Cliente' ?>
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="<?= BASE_URL ?>/controller/ClienteController.php?acao=salvar" method="POST">
                        
                        <?php if ($isEdit): ?>
                            <input type="hidden" name="id" value="<?= $cliente->getId() ?>">
                        <?php endif; ?>

                        <div class="row mb-3">
                            <div class="col-md-8 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required
                                           value="<?= $isEdit ? $cliente->getNome() : '' ?>">
                                    <label for="nome">Nome Completo / Razão Social</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="tipo" name="tipo">
                                        <option value="Fisico" <?= ($isEdit && $cliente->getTipo() == 'Fisico') ? 'selected' : '' ?>>Pessoa Física</option>
                                        <option value="Juridico" <?= ($isEdit && $cliente->getTipo() == 'Juridico') ? 'selected' : '' ?>>Pessoa Jurídica</option>
                                    </select>
                                    <label for="tipo">Tipo de Cliente</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="documento" name="documento" placeholder="CPF/CNPJ" required
                                           value="<?= $isEdit ? $cliente->getDocumento() : '' ?>">
                                    <label for="documento">CPF / CNPJ</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone"
                                           value="<?= $isEdit ? $cliente->getTelefone() : '' ?>">
                                    <label for="telefone">Telefone / WhatsApp</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="email"
                                   value="<?= $isEdit ? $cliente->getEmail() : '' ?>">
                            <label for="email">E-mail</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço"
                                   value="<?= $isEdit ? $cliente->getEndereco() : '' ?>">
                            <label for="endereco">Endereço Completo</label>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= BASE_URL ?>/controller/ClienteController.php?acao=listar" class="btn btn-light me-md-2 border">Cancelar</a>
                            <button type="submit" class="btn btn-success px-5">
                                <?= $isEdit ? '💾 Salvar Alterações' : '✨ Cadastrar' ?>
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>