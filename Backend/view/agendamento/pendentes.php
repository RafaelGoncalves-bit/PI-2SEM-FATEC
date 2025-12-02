<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>📋 Fila de Espera</h3>
            <p class="text-muted">Ordens de Serviço geradas, mas sem data marcada.</p>
        </div>
        <a href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=listar_os" class="btn btn-outline-secondary">
            Ver Todas as OS
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#OS</th>
                        <th>Data Geração</th>
                        <th>Cliente</th>
                        <th>Local</th>
                        <th class="text-end pe-4">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaPendentes)): ?>
                        <?php foreach ($listaPendentes as $os): 
                            $data = new DateTime($os['data_geracao']);
                        ?>
                            <tr>
                                <td class="ps-4 fw-bold text-danger">#<?= $os['id'] ?></td>
                                <td><?= $data->format('d/m/Y H:i') ?></td>
                                <td><?= $os['cliente_nome'] ?></td>
                                <td class="text-muted small"><?= mb_strimwidth($os['endereco'], 0, 30, '...') ?></td>
                                <td class="text-end pe-4">
                                    <a href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=novo&os_selecionada=<?= $os['id'] ?>" 
                                       class="btn btn-primary btn-sm">
                                        📅 Agendar Agora
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <h4 class="text-success">🎉 Tudo em dia!</h4>
                                <p class="text-muted">Nenhuma Ordem de Serviço pendente de agendamento.</p>
                                <a href="<?= BASE_URL ?>/index.php" class="btn btn-outline-primary mt-2">Voltar ao Painel</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>