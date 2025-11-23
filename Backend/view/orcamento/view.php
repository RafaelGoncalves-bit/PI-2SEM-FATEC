<?php
    require_once __DIR__ . '/../partials/header.php';
    require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">
    <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=listar" class="btn btn-secondary mb-3">Voltar</a>

    <div class="card">
        <div class="card-header bg-dark text-white">
            <h3>Orçamento #<?= $orcamento->getId() ?></h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <strong>Data:</strong> <?= date('d/m/Y', strtotime($orcamento->getDataEmissao())) ?>
                </div>
                <div class="col-md-4">
                    <strong>Status:</strong> <?= $orcamento->getStatus() ?>
                </div>
                <div class="col-md-4 text-end">
                    <strong>Total Geral:</strong> 
                    <span class="h4 text-success">R$ <?= number_format($orcamento->getValorTotal(), 2, ',', '.') ?></span>
                </div>
            </div>

            <h5>Itens do Pedido:</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Serviço</th>
                        <th>Tamanho</th>
                        <th>Qtd</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orcamento->getItens() as $item): ?>
                        <tr>
                            <td>Serviço: <?= $item->getNomeServico() ?></td> 
                            <td>Tamanho: <?= $item->getNomeTamanho() ?></td>
                            <td><?= $item->getQuantidade() ?></td>
                            <td class="text-end">R$ <?= number_format($item->getValorCalculado(), 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-end">
            <?php if ($orcamento->getStatus() == 'Pendente'): ?>
                <a href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=gerar_os&id_orcamento=<?= $orcamento->getId() ?>" 
                class="btn btn-success"
                onclick="return confirm('Tem certeza? Isso vai gerar uma Ordem de Serviço e não poderá ser desfeito.');">
                    ✅ Aprovar e Gerar OS
                </a>
            <?php else: ?>
                <span class="badge bg-success p-2">Este orçamento já foi aprovado e gerou uma OS.</span>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    require_once __DIR__ . '/../partials/footer.php';
?>
