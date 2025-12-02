<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>🧹 Catálogo de Serviços</h3>
            <p class="text-muted mb-0">Gerencie os preços base dos seus serviços.</p>
        </div>
        <a href="<?= BASE_URL ?>/controller/ServicoController.php?acao=novo" class="btn btn-primary btn-lg shadow-sm">
            <i class="fs-6">➕</i> Novo Serviço
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0 text-muted">Serviços Cadastrados</h5>
                </div>
                <div class="col-md-6">
                    <input type="text" id="filtroServico" class="form-control" placeholder="🔍 Buscar serviço...">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tabelaServicos">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Nome do Serviço</th>
                            <th>Descrição Resumida</th>
                            <th>Preço Base</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listaServicos)): ?>
                            <?php foreach ($listaServicos as $s): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-dark fs-6">
                                        <?= $s['nome'] ?>
                                    </td>
                                    <td class="text-muted">
                                        <?= mb_strimwidth($s['descricao'], 0, 60, '...') ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-success border border-success fs-6">
                                            R$ <?= number_format($s['preco_base'], 2, ',', '.') ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?= BASE_URL ?>/controller/ServicoController.php?acao=editar&id=<?= $s['id'] ?>" 
                                           class="btn btn-sm btn-outline-primary" title="Editar">
                                            ✏️
                                        </a>
                                        <a href="<?= BASE_URL ?>/controller/ServicoController.php?acao=excluir&id=<?= $s['id'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Tem certeza que deseja excluir este serviço?');" title="Excluir">
                                            🗑️
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">Nenhum serviço cadastrado ainda.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('filtroServico').addEventListener('keyup', function() {
    let termo = this.value.toLowerCase();
    let linhas = document.querySelectorAll('#tabelaServicos tbody tr');
    linhas.forEach(linha => {
        let texto = linha.innerText.toLowerCase();
        linha.style.display = texto.includes(termo) ? '' : 'none';
    });
});
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>