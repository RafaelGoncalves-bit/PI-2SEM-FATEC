<?php
    require_once __DIR__ . '/../partials/header.php';
    require_once __DIR__ . '/../partials/navbar.php';
?>


<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Orçamentos Realizados</h2>
        <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=novo" class="btn btn-primary">
            + Novo Orçamento
        </a>
    </div>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Data Emissão</th>
                <th>Status</th>
                <th>Total</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lista)): // O Controller manda essa variavel $lista ?>
                <?php foreach ($lista as $orcamento): ?>
                    <tr>
                        <td>#<?= $orcamento['id'] ?></td>
                        
                        <td><?= $orcamento['nome_cliente'] ?></td>
                        
                        <td><?= date('d/m/Y', strtotime($orcamento['data_emissao'])) ?></td>
                        
                        <td>
                            <span class="badge bg-<?= $orcamento['status'] == 'Pendente' ? 'warning' : 'success' ?>">
                                <?= $orcamento['status'] ?>
                            </span>
                        </td>
                        
                        <td>R$ <?= number_format($orcamento['valor_total'], 2, ',', '.') ?></td>
                        
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=detalhes&id=<?= $orcamento['id'] ?>" 
                               class="btn btn-info btn-sm text-white">
                                👁️ Ver Itens
                            </a>

                            <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=excluir&id=<?= $orcamento['id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Tem certeza? Isso apagará todos os itens deste orçamento!');">
                                🗑️
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhum orçamento encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
    require_once __DIR__ . '/../partials/footer.php';
?>
