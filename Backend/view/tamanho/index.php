<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>📏 Tamanhos & Dimensões</h3>
            <p class="text-muted mb-0">Defina os multiplicadores de preço por tamanho.</p>
        </div>
        <a href="<?= BASE_URL ?>/controller/TamanhoController.php?acao=novo" class="btn btn-primary btn-lg shadow-sm">
            <i class="fs-6">➕</i> Novo Tamanho
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Descrição da Dimensão</th>
                            <th>Fator Multiplicador</th>
                            <th>Exemplo Prático</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listaTamanhos)): ?>
                            <?php foreach ($listaTamanhos as $t): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-dark fs-6">
                                        <?= $t['dimensao'] ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark fs-6">
                                            x <?= number_format($t['multiplicador_preco'], 2, '.', '') ?>
                                        </span>
                                    </td>
                                    <td class="text-muted small">
                                        Serviço de R$ 100 vira 
                                        <strong>R$ <?= number_format(100 * $t['multiplicador_preco'], 2, ',', '.') ?></strong>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?= BASE_URL ?>/controller/TamanhoController.php?acao=editar&id=<?= $t['id'] ?>" 
                                           class="btn btn-sm btn-outline-primary" title="Editar">
                                            ✏️
                                        </a>
                                        <a href="<?= BASE_URL ?>/controller/TamanhoController.php?acao=excluir&id=<?= $t['id'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Tem certeza? Isso afetará novos orçamentos.');" title="Excluir">
                                            🗑️
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">Nenhum tamanho cadastrado.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>