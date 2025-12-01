
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= BASE_URL ?>">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Serviço
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/ServicoController.php?acao=listar">Index</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/view/servico/new.php">Insert</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tamanho
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/TamanhoController.php?acao=listar">Index</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/view/tamanho/new.php">Insert</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cliente
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/ClienteController.php?acao=listar">Index</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/view/cliente/new.php">Insert</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Funcionário
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/FuncionarioController.php?acao=listar">Index</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/view/funcionario/new.php">Insert</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Orçamento
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=listar">Index</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=novo">insert</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Agendamento
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=agenda">Index</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>/controller/AgendamentoController.php?acao=novo">insert</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>


<?php
require_once __DIR__ . '/footer.php';
?>

