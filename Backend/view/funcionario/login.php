<?php
require_once __DIR__ . '/../partials/header.php';
?>
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); /* Azul degradê */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
    </style>

<div class="card card-login bg-white">
    <div class="text-center mb-4">
        <h3 class="fw-bold text-primary">Acesso Restrito</h3>
        <p class="text-muted">Sistema de Agendamento</p>
    </div>

    <form action="<?= BASE_URL ?>/controller/LoginController.php?acao=login" method="POST">
        
        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="emailInput" placeholder="name@example.com" required>
            <label for="emailInput">E-mail</label>
        </div>
        
        <div class="form-floating mb-4">
            <input type="password" name="senha" class="form-control" id="senhaInput" placeholder="Password" required>
            <label for="senhaInput">Senha</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">Entrar no Sistema</button>
        
    </form>
    
    <div class="text-center mt-3">
        <small class="text-muted">
            Login de Teste:<br>
            <strong>admin@empresa.com</strong> / <strong>123456</strong>
        </small>
    </div>
</div>

<?php
require_once __DIR__ . '/../partials/footer.php';
?>