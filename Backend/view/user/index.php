<?php 
require_once __DIR__ . '/../partials/navbar.php';

$email = 'admin@admin';
$senha = 123; 
?>


<div class="background-login">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="col-auto d-flex justify-content-center">
            <div class="login-card">
                <div>
                    <h1 class="text-center">Login</h1>
                </div>
                <form action="./index.php" method="POST" class="mt-2">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email_conf" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha_conf" required>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        <a href="new.php" class="link-card">Cadastrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
