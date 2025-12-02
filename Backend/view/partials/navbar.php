<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// Captura a URL para marcar o botão ativo
$uri = $_SERVER['REQUEST_URI'];
?>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4 sticky-top">
  <div class="container">
    
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= BASE_URL ?>/index.php">
        <span>🛠️ XC Limpeza </span>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto ms-lg-4">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= (strpos($uri, 'Cliente') || strpos($uri, 'Servico') || strpos($uri, 'Tamanho')) ? 'active-menu' : '' ?>" 
             href="#" role="button" data-bs-toggle="dropdown">
            📂 Cadastros
          </a>
          <ul class="dropdown-menu">
            <li><h6 class="dropdown-header text-uppercase text-muted" style="font-size: 0.7rem;">Geral</h6></li>
            <li>
                <a class="dropdown-item" href="<?= BASE_URL ?>/controller/ClienteController.php?acao=listar">
                    👥 Clientes
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header text-uppercase text-muted" style="font-size: 0.7rem;">Configurações</h6></li>
            <li>
                <a class="dropdown-item" href="<?= BASE_URL ?>/controller/ServicoController.php?acao=listar">
                    🧹 Serviços
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="<?= BASE_URL ?>/controller/TamanhoController.php?acao=listar">
                    📏 Tamanhos
                </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= strpos($uri, 'OrcamentoController') ? 'active-menu' : '' ?>" 
               href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=listar">
               💰 Orçamentos
            </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= strpos($uri, 'AgendamentoController') ? 'active-menu' : '' ?>" 
             href="#" role="button" data-bs-toggle="dropdown">
            📅 Operacional
          </a>
          <ul class="dropdown-menu">
            <li><h6 class="dropdown-header text-uppercase text-muted" style="font-size: 0.7rem;">Dia a Dia</h6></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=agenda">🗓️ Ver Calendário</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header text-uppercase text-muted" style="font-size: 0.7rem;">Gerência</h6></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=pendentes">⚠️ Fila de Espera</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=novo">➕ Novo Agendamento</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=listar_os">📂 Todas as O.S.</a></li>
          </ul>
        </li>

      </ul>
      
      <div class="d-flex align-items-center gap-3">
          <?php if (isset($_SESSION['usuario_nome'])): ?>
              <div class="text-white text-end d-none d-lg-block" style="line-height: 1.2;">
                  <small class="d-block text-white-50" style="font-size: 0.7rem;">Logado como</small>
                  <span class="fw-bold"><?= explode(' ', $_SESSION['usuario_nome'])[0] ?></span>
              </div>
              <a href="<?= BASE_URL ?>/controller/LoginController.php?acao=logout" 
                 class="btn btn-sm btn-sair rounded-pill px-3">Sair</a>
          <?php else: ?>
              <a href="<?= BASE_URL ?>/views/login.php" class="btn btn-light rounded-pill px-4 fw-bold">Entrar</a>
          <?php endif; ?>
      </div>
      
    </div>
  </div>
</nav>