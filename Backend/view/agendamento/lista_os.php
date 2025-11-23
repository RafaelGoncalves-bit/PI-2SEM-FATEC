<?php 
    require_once __DIR__ . '/../partials/header.php';
    require_once __DIR__ . '/../partials/navbar.php';
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📂 Ordens de Serviço (Geral)</h2>
        <div>
            <a href="AgendamentoController.php?acao=agenda" class="btn btn-outline-primary">📅 Ver Agenda</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#OS</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Valor</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaOS)): ?>
                        <?php foreach ($listaOS as $os): ?>
                            <tr>
                                <td><strong>#<?= $os['id'] ?></strong></td>
                                <td><?= $os['cliente_nome'] ?></td>
                                <td>
                                    <?php 
                                        // Cores dinâmicas para o status
                                        $cor = 'secondary';
                                        if($os['status_servico'] == 'Aguardando') $cor = 'warning';
                                        if($os['status_servico'] == 'Agendado') $cor = 'primary'; // Azul
                                        if($os['status_servico'] == 'Concluido') $cor = 'success';
                                    ?>
                                    <span class="badge bg-<?= $cor ?>"><?= $os['status_servico'] ?></span>
                                </td>
                                <td>R$ <?= number_format($os['valor_total'], 2, ',', '.') ?></td>
                                <td class="text-center">
                                    <?php if($os['status_servico'] == 'Aguardando'): ?>
                                        <a href="AgendamentoController.php?acao=novo&os_selecionada=<?= $os['id'] ?>" 
                                           class="btn btn-sm btn-success">📅 Agendar</a>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-secondary" disabled>Já Agendado</button>
                                    <?php endif; ?>

                                    <a href="../../Backend/controller/OrcamentoController.php?acao=detalhes&id=<?= $os['orcamento_id'] ?>" 
                                       class="btn btn-sm btn-info text-white">👁️ Ver Pedido</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">Nenhuma OS encontrada.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
    require_once __DIR__ . '/../partials/footer.php';
?>