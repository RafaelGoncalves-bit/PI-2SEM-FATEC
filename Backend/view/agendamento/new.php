<?php 
    require_once __DIR__ . '/../partials/header.php';
    require_once __DIR__ . '/../partials/navbar.php';

    $os_pre_selecionada = $_GET['os_selecionada'] ?? null;
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        
        <div class="col-md-6 mb-4">
            
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">📅 Agendar Serviço</h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=salvar" method="POST">

                        <h6 class="text-primary mb-3">1. Qual Serviço será Agendado?</h6>
                        <div class="form-floating mb-4">
                            <select name="os_id" id="os_id" class="form-select" required>
                                <option value="" selected disabled>Selecione uma OS Pendente...</option>
                                <?php if (!empty($listaOSPendentes)): ?>
                                    <?php foreach ($listaOSPendentes as $os): ?>
                                        <option value="<?= $os['id'] ?>" 
                                            <?= ($os_pre_selecionada == $os['id']) ? 'selected' : '' ?>>
                                            OS #<?= $os['id'] ?> - Cliente: <?= $os['cliente_nome'] ?> 
                                            (Orçamento #<?= $os['id'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="" disabled>Nenhuma ordem de serviço aguardando agendamento.</option>
                                <?php endif; ?>
                            </select>
                            <label for="os_id">Ordem de Serviço</label>
                        </div>

                        <hr>
                        
                        <h6 class="text-primary mb-3">2. Quando e Quem?</h6>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <select name="funcionario_id" id="funcionario_id" class="form-select" required onchange="carregarAgenda()">
                                        <option value="" selected disabled>Selecione o Funcionário...</option>
                                        <?php foreach ($listaFuncionarios as $func): ?>
                                            <option value="<?= $func['id'] ?>"><?= $func['nome'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="funcionario_id">👷 Quem vai realizar?</label>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <input type="datetime-local" name="data_hora" id="data_hora" class="form-control" required>
                                    <label for="data_hora">📅 Data e Hora</label>
                                </div>
                                <div class="form-text">
                                    Horário de atendimento: 07:00 às 18:00 (Seg-Sáb).
                                </div>
                            </div>
                        </div>
                        
                        <hr class="mt-4">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=listar" class="btn btn-light border me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                💾 Confirmar Agendamento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-secondary text-white py-3">
                    <h5 class="mb-0">🗓️ Disponibilidade do Funcionário</h5>
                </div>
                <div class="card-body">
                    <div id="calendario-status" class="text-center text-muted">
                        Selecione um funcionário para ver os agendamentos.
                    </div>
                    <div id="lista-horarios" class="mt-4"></div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
    const BASE_URL = "<?= BASE_URL ?>";

    function carregarAgenda() {
        const funcionarioId = document.getElementById('funcionario_id').value;
        const statusDiv = document.getElementById('calendario-status');
        const listaHorariosDiv = document.getElementById('lista-horarios');

        if (!funcionarioId) {
            statusDiv.innerHTML = 'Selecione um funcionário para ver os agendamentos.';
            listaHorariosDiv.innerHTML = '';
            return;
        }

        statusDiv.innerHTML = 'Carregando agenda...';
        listaHorariosDiv.innerHTML = '';

        // AJAX para buscar a agenda do funcionário
        fetch(BASE_URL + '/controller/AgendamentoController.php?acao=ver_disponibilidade&funcionario_id=' + funcionarioId)
            .then(response => response.json())
            .then(data => {
                statusDiv.innerHTML = `Agendamentos de <b>${document.getElementById('funcionario_id').options[document.getElementById('funcionario_id').selectedIndex].text}</b>:`;
                
                if (data.length === 0) {
                    listaHorariosDiv.innerHTML = '<div class="alert alert-success">✅ Agenda livre! Nenhum compromisso ativo.</div>';
                    return;
                }

                let html = '<ul class="list-group">';
                data.forEach(item => {
                    // Formata a data (assumindo que item.data_agendamento é YYYY-MM-DD HH:MM:SS)
                    const dataHora = new Date(item.data_agendamento);
                    const dataFormatada = dataHora.toLocaleDateString('pt-BR', { day: '2-digit', month: 'short' });
                    const horaFormatada = dataHora.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });

                    html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>${dataFormatada}</strong> às ${horaFormatada}
                                <br>
                                <small class="text-muted">Cliente: ${item.cliente_nome}</small>
                            </div>
                            <span class="badge bg-primary rounded-pill">OS #${item.os_id}</span>
                        </li>
                    `;
                });
                html += '</ul>';
                listaHorariosDiv.innerHTML = html;
            })
            .catch(error => {
                statusDiv.innerHTML = '<div class="alert alert-danger">❌ Erro ao carregar dados da agenda.</div>';
                console.error('Erro na requisição AJAX:', error);
            });
    }

    // Tenta carregar a agenda se já houver um funcionário selecionado ao carregar a página (útil para edição)
    document.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById('funcionario_id').value) {
            carregarAgenda();
        }
    });
</script>

<?php 
    require_once __DIR__ . '/../partials/footer.php';
?>