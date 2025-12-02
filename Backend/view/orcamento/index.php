<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>💰 Orçamentos</h3>
            <p class="text-muted mb-0">Controle de propostas e vendas.</p>
        </div>
        <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=novo" class="btn btn-primary btn-lg shadow-sm">
            <i class="fs-6">➕</i> Nova Proposta
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#ID</th>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Valor Total</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listaOrcamentos)): ?>
                            <?php foreach ($listaOrcamentos as $o): 
                                // Lógica de Cores
                                $badgeClass = 'bg-secondary';
                                if($o['status'] == 'Pendente') $badgeClass = 'bg-warning text-dark';
                                if($o['status'] == 'Aprovado') $badgeClass = 'bg-success';
                                if($o['status'] == 'Rejeitado') $badgeClass = 'bg-danger';
                                if($o['status'] == 'Cancelado') $badgeClass = 'bg-secondary';
                            ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-muted">#<?= str_pad($o['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                    
                                    <td><?= date('d/m/Y', strtotime($o['data_emissao'])) ?></td>
                                    
                                    <td>
                                        <span class="fw-bold text-dark"><?= $o['cliente_nome'] ?></span>
                                    </td>
                                    
                                    <td class="fw-bold text-success">
                                        R$ <?= number_format($o['valor_total'], 2, ',', '.') ?>
                                    </td>
                                    
                                    <td>
                                        <span class="badge rounded-pill <?= $badgeClass ?>">
                                            <?= $o['status'] ?>
                                        </span>
                                    </td>
                                    
                                    <td class="text-end pe-4">
                                        <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=detalhes&id=<?= $o['id'] ?>" 
                                           class="btn btn-sm btn-info text-white" title="Ver Detalhes">
                                            👁️ Detalhes
                                        </a>
                                        
                                        <?php if($o['status'] !== 'Cancelado' && $o['status'] !== 'Rejeitado'): ?>
                                            <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=cancelar&id=<?= $o['id'] ?>" 
                                               class="btn btn-sm btn-outline-secondary ms-1"
                                               onclick="return confirm('Cancelar este orçamento?');" title="Cancelar">
                                                🚫
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center py-4 text-muted">Nenhum orçamento encontrado.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>