<?php 
$email = 'admin@admin';
$senha = 123; 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilo.css">
    <style>
    .background-login{
            background-image: url("./img/background.png");
            background-size: cover;
            background-repeat: no-repeat;
        } </style>
</head>
<body class="background-login">
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
                        <a href="./cadastro.php" class="link-card">Cadastrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>