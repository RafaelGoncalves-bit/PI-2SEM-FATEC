<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro - XC Limpeza</title>
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


    .cadastro-card {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(12px);
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.25);
      padding: 2.5rem;
      width: 100%;
      max-width: 480px;
      color: #333;
    }

    .cadastro-card h1 {
      font-weight: 700;
      color: #0043b3;
      margin-bottom: 1.5rem;
    }

    .btn-cadastro {
      background: linear-gradient(90deg, #006eff, #0048b1);
      border: none;
      color: #fff;
    }

    .btn-cadastro:hover {
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
  <div class="cadastro-card">
    <h1 class="text-center">Cadastro</h1>
    <form action="./login.php" method="POST">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome completo</label>
        <input type="text" id="nome" name="nome" class="form-control" placeholder="Seu nome" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Sexo</label>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="Masculino">
          <label class="form-check-label" for="sexoM">Masculino</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="Feminino">
          <label class="form-check-label" for="sexoF">Feminino</label>
        </div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="exemplo@email.com" required>
      </div>

      <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Crie uma senha" required>
      </div>

      <button type="submit" class="btn btn-cadastro w-100 py-2">Cadastrar</button>
      <a href="./login.php" class="link-card">Já possui conta? Faça login</a>
    </form>
  </div>
</body>
</html>
