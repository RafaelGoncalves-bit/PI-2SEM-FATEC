<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>👥 Meus Clientes</h3>
            <p class="text-muted mb-0">Gerencie sua base de contatos.</p>
        </div>
        <a href="<?= BASE_URL ?>/controller/ClienteController.php?acao=novo" class="btn btn-primary btn-lg shadow-sm">
            <i class="fs-6">➕</i> Novo Cliente
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0 text-muted">Lista de Cadastros</h5>
                </div>
                <div class="col-md-6">
                    <input type="text" id="filtroCliente" class="form-control" placeholder="🔍 Buscar por nome ou documento...">
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tabelaClientes">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Nome / Razão Social</th>
                            <th>Documento</th>
                            <th>Contato</th>
                            <th>Tipo</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listaClientes)): ?>
                            <?php foreach ($listaClientes as $c): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">
                                        <?= $c['nome'] ?>
                                        <div class="small text-muted fw-normal"><?= $c['email'] ?></div>
                                    </td>
                                    <td><?= $c['documento'] ?></td>
                                    <td><?= $c['telefone'] ?></td>
                                    <td>
                                        <?php if($c['tipo'] == 'Juridico'): ?>
                                            <span class="badge bg-info text-dark">🏢 PJ</span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-dark border">👤 PF</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?= BASE_URL ?>/controller/ClienteController.php?acao=editar&id=<?= $c['id'] ?>" 
                                           class="btn btn-sm btn-outline-primary" title="Editar">
                                            ✏️
                                        </a>
                                        <a href="<?= BASE_URL ?>/controller/ClienteController.php?acao=excluir&id=<?= $c['id'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Tem certeza que deseja excluir este cliente?');" title="Excluir">
                                            🗑️
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">Nenhum cliente cadastrado.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('filtroCliente').addEventListener('keyup', function() {
    let termo = this.value.toLowerCase();
    let linhas = document.querySelectorAll('#tabelaClientes tbody tr');
    
    linhas.forEach(linha => {
        let texto = linha.innerText.toLowerCase();
        linha.style.display = texto.includes(termo) ? '' : 'none';
    });
});
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>