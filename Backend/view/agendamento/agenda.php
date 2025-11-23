<?php 
    require_once __DIR__ . '/../partials/header.php';
?>
<style>
        .dia-header {
            background-color: #f8f9fa;
            border-left: 5px solid #0d6efd; /* Azul Bootstrap */
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .card-agendamento {
            border-left: 5px solid #198754; /* Verde Sucesso */
        }
</style>
<?php
    require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📅 Agenda de Compromissos</h2>
        <a href="AgendamentoController.php?acao=listar_os" class="btn btn-outline-dark">📂 Gerenciar OS</a>
    </div>

    <?php if (empty($listaAgenda)): ?>
        <div class="alert alert-info">Nenhum agendamento futuro encontrado.</div>
    <?php else: ?>

        <?php 
        $dataAtualControle = null; 
        
        // LOOP DA AGENDA
        foreach ($listaAgenda as $item): 
            // Converte a data do banco para formatar
            $dataObj = new DateTime($item['data_agendamento']);
            $diaFormatado = $dataObj->format('d/m/Y'); // Ex: 25/11/2025
            $horaFormatada = $dataObj->format('H:i');  // Ex: 14:30
            
            // LÓGICA DE AGRUPAMENTO:
            // Se a data mudou em relação à volta anterior do loop, imprime o cabeçalho do dia
            if ($diaFormatado !== $dataAtualControle): 
        ?>
            <div class="dia-header shadow-sm">
                Dia <?= $diaFormatado ?>
            </div>
            <?php $dataAtualControle = $diaFormatado; // Atualiza o controle ?>
        <?php endif; ?>

            <div class="card card-agendamento mb-3 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 text-center border-end">
                            <h3 class="text-success m-0"><?= $horaFormatada ?></h3>
                            <small class="text-muted">Horário</small>
                        </div>
                        <div class="col-md-7">
                            <h5 class="card-title"><?= $item['cliente_nome'] ?></h5>
                            <p class="card-text mb-1">
                                📍 <strong>Endereço:</strong> <?= $item['cliente_endereco'] ?>
                            </p>
                            <p class="card-text text-muted mb-0">
                                🔧 Referente à OS #<?= $item['os_id'] ?>
                            </p>
                        </div>
                        <div class="col-md-3 text-end">
                            <span class="badge bg-info text-dark">
                                👷 <?= $item['funcionario_nome'] ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>
</div>