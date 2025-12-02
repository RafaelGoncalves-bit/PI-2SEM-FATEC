<?php
session_start();
// Se não estiver logado, manda pro login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: view/funcionario/login.php');
    exit;
}

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/dao/DashboardDAO.php';

// Inicializa o DAO e busca os dados
$db = new Database();
$dashboardDAO = new DashboardDAO($db->getConnection());

$totalOrcamentos = $dashboardDAO->contarOrcamentosPendentes();
$totalOSPendentes = $dashboardDAO->contarOSPendentes();
$agendamentosHoje = $dashboardDAO->contarAgendamentosHoje();
$proximos = $dashboardDAO->listarProximosAgendamentos();

// Carrega o Cabeçalho e Navbar
// Ajuste os caminhos pois estamos na raiz
require_once __DIR__ . '/view/partials/header.php';
require_once __DIR__ . '/view/partials/navbar.php';
?>

<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🚀 Painel de Controle</h3>
        <span class="text-muted"><?= date('d/m/Y') ?></span>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #ffc107 !important;">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Orçamentos Pendentes</h6>
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 class="mb-0 fw-bold text-dark"><?= $totalOrcamentos ?></h2>
                        <span class="fs-1">💰</span>
                    </div>
                    <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=listar" class="stretched-link text-decoration-none text-muted small mt-2 d-block">Ver propostas &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #dc3545 !important;">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Aguardando Agendamento</h6>
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 class="mb-0 fw-bold text-dark"><?= $totalOSPendentes ?></h2>
                        <span class="fs-1">📋</span>
                    </div>
                    <a href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=pendentes" class="stretched-link text-decoration-none text-muted small mt-2 d-block">Agendar agora &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #0d6efd !important;">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Visitas Hoje</h6>
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 class="mb-0 fw-bold text-dark"><?= $agendamentosHoje ?></h2>
                        <span class="fs-1">🚚</span>
                    </div>
                    <a href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=agenda" class="stretched-link text-decoration-none text-muted small mt-2 d-block">Ver rota do dia &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">📅 Próximos Serviços</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Data/Hora</th>
                                <th>Cliente</th>
                                <th>Funcionário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proximos)): ?>
                                <?php foreach ($proximos as $item): 
                                    $data = new DateTime($item['data_agendamento']);
                                ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold"><?= $data->format('d/m') ?></span> 
                                            <small class="text-muted"><?= $data->format('H:i') ?></small>
                                        </td>
                                        <td>
                                            <?= explode(' ', $item['cliente'])[0] ?> <br>
                                            <small class="text-muted" style="font-size:0.75rem"><?= mb_strimwidth($item['endereco'], 0, 30, "...") ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <?= $item['funcionario'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Agenda livre nos próximos dias.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">⚡ Ações Rápidas</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=novo" class="btn btn-primary btn-lg text-start">
                        💰 Novo Orçamento
                    </a>
                    <a href="<?= BASE_URL ?>/controller/ClienteController.php?acao=novo" class="btn btn-outline-dark text-start">
                        👤 Cadastrar Cliente
                    </a>
                    <a href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=novo" class="btn btn-outline-secondary text-start">
                        ➕ Agendar Manualmente
                    </a>
                </div>
            </div>
            
            <div class="alert alert-info mt-3 shadow-sm border-0">
                <small>💡 <strong>Dica:</strong> Mantenha os status das OS atualizados para que os relatórios fiquem corretos.</small>
            </div>
        </div>

    </div>
</div>

<?php require_once __DIR__ . '/view/partials/footer.php'; ?>