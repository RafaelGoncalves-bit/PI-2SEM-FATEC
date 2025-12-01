<?php 
    require_once __DIR__ . '/../partials/header.php';
    require_once __DIR__ . '/../partials/navbar.php';

?>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>📅 Agendar Serviço</h3>
        </div>
        <div class="card-body">
            
            <form action="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=salvar" method="POST">

                <div class="mb-3">
                    <label class="form-label">Qual serviço será realizado?</label>
                    <select name="os_id" class="form-select" required>
                        <option value="">Selecione uma OS Pendente...</option>
                        
                        <?php if (!empty($listaOSPendentes)): ?>
                            <?php foreach ($listaOSPendentes as $os): ?>
                                <option value="<?= $os['id'] ?>">
                                    OS #<?= $os['id'] ?> - Cliente: <?= $os['cliente_nome'] ?> 
                                    (Orçamento #<?= $os['orcamento_id'] ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>Nenhuma ordem de serviço aguardando agendamento.</option>
                        <?php endif; ?>
                    </select>
                    <div class="form-text">Apenas OS com status 'Aguardando' aparecem aqui.</div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quem vai realizar?</label>
                        <select name="funcionario_id" class="form-select" required>
                            <option value="">Selecione o Funcionário...</option>
                            <?php foreach ($listaFuncionarios as $func): ?>
                                <option value="<?= $func['id'] ?>"><?= $func['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data e Hora:</label>
                        <input type="datetime-local" name="data_hora" class="form-control" required>
                        <div class="form-text">
                            Horário de atendimento: 07:00 às 18:00 (Seg-Sáb).
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg">Confirmar Agendamento</button>
                    <a href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</div>

<?php 
    require_once __DIR__ . '/../partials/footer.php';
?>