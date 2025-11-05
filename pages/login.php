<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - XC Limpeza</title>
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    body {
  background: linear-gradient(135deg, rgba(230, 240, 255, 0.8), rgba(200, 220, 255, 0.8));
  backdrop-filter: blur(6px);
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}


    .login-card {
      background: rgba(255,255,255,0.8);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.2);
      padding: 2.5rem;
      width: 100%;
      max-width: 400px;
      color: #333;
    }

    .login-card h1 {
      font-weight: 700;
      color: #0043b3;
      margin-bottom: 1.5rem;
    }

    .btn-login {
      background: linear-gradient(90deg, #006eff, #0048b1);
      border: none;
      color: #fff;
    }

    .btn-login:hover {
      background: #003a8c;
    }

    .link-card {
      display: block;
      text-align: center;
      margin-top: 1rem;
      color: #0048b1;
      text-decoration: none;
    }

    .link-card:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h1 class="text-center">Login</h1>
    <form action="./index.php" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email_conf" required>
      </div>
      <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha_conf" required>
      </div>
      <button type="submit" class="btn btn-login w-100 py-2">Entrar</button>
      <a href="./cadastro.php" class="link-card">Faça seu cadastro</a>
    </form>
  </div>
</body>
</html>
