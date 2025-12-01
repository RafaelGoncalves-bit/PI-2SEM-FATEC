<?php 
    require_once __DIR__ . '/../partials/header.php';
    require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🔎 Detalhes do Orçamento #<?= $orcamento->getId() ?></h3>
        <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=listar" class="btn btn-outline-secondary border shadow-sm">
            🔙 Voltar
        </a>
    </div>

    <div class="card border-0 shadow-lg">
        
        <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">
                Proposta para o Cliente: <?= $orcamento->getNomeCliente() ?? 'N/A' ?>
            </h5>
            
            <?php 
                $status = $orcamento->getStatus();
                $badgeClass = 'bg-secondary';
                if($status == 'Pendente') $badgeClass = 'bg-warning text-dark';
                if($status == 'Aprovado') $badgeClass = 'bg-success';
                if($status == 'Rejeitado') $badgeClass = 'bg-danger';
            ?>
            <span class="badge rounded-pill <?= $badgeClass ?> fs-6 p-2">
                <?= $status ?>
            </span>
        </div>
        
        <div class="card-body p-4">
            
            <div class="row mb-4 border-bottom pb-3">
                <div class="col-md-4">
                    <strong>📅 Data de Emissão:</strong> 
                    <span class="text-muted"><?= date('d/m/Y', strtotime($orcamento->getDataEmissao())) ?></span>
                </div>
                
                <div class="col-md-4">
                    <strong>ID do Cliente:</strong> 
                    <span class="text-muted">#<?= $orcamento->getClienteId() ?></span>
                </div>
                
                <div class="col-md-4 text-end">
                    <strong>💸 TOTAL GERAL:</strong> 
                    <span class="h4 text-success fw-bold">R$ <?= number_format($orcamento->getValorTotal(), 2, ',', '.') ?></span>
                </div>
            </div>

            <h5>Itens do Pedido:</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40%;">Serviço Detalhado</th>
                            <th>Dimensão</th>
                            <th style="width: 10%;">Qtd</th>
                            <th class="text-end" style="width: 15%;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orcamento->getItens() as $item): ?>
                            <tr>
                                <td class="fw-bold"><?= $item->getNomeServico() ?></td> 
                                <td>
                                    <?= $item->getNomeTamanho() ?> 
                                    (x<?= number_format($item->getMultiplicadorPreco(), 2, '.', '') ?>)
                                </td>
                                <td><?= $item->getQuantidade() ?></td>
                                <td class="text-end fw-bold">R$ <?= number_format($item->getValorCalculado(), 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
        
        <div class="card-footer bg-light text-end p-4">
            <?php if ($status == 'Pendente'): ?>
                <span class="text-muted me-3">Aprovar esta proposta:</span>
                <a href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=gerar_os&id_orcamento=<?= $orcamento->getId() ?>" 
                class="btn btn-success btn-lg shadow-sm"
                onclick="return confirm('ATENÇÃO: Isso vai gerar a Ordem de Serviço e não poderá ser desfeito. Continuar?');">
                    ✅ Aprovar e Gerar OS
                </a>
            <?php elseif ($status == 'Aprovado'): ?>
                <span class="badge bg-success p-2 fs-6">🎉 Este orçamento já gerou uma Ordem de Serviço.</span>
            <?php else: ?>
                <span class="badge bg-danger p-2 fs-6">❌ Proposta Rejeitada ou Cancelada.</span>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    require_once __DIR__ . '/../partials/footer.php';
?>