<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro - XC Limpeza</title>
  <link rel="stylesheet" href="css/estilo.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
</head>
<body class="background-cadastro">
  <?php include("modelo/topo.html"); ?>

  <main class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="login-card">
      <div class="text-center mb-3">
        <img src="img/logo.jpeg" width="70" class="rounded-circle mb-2 border border-primary" alt="Logo XC Limpeza">
        <h2 class="text-primary fw-bold">Crie sua Conta</h2>
        <p class="text-muted mb-4">Cadastre-se para agendar e acompanhar seus serviços.</p>
      </div>

      <form action="./login.php" method="POST">
        <div class="mb-3">
          <label for="nome" class="form-label"><i class="bi bi-person"></i> Nome Completo</label>
          <input type="text" id="nome" name="nome" class="form-control" required>
        </div>

        <div class="text-center mb-3">
          <h6 class="fw-bold text-secondary">Sexo</h6>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sexo" id="masculino" value="Masculino" required>
            <label class="form-check-label" for="masculino">Masculino</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sexo" id="feminino" value="Feminino" required>
            <label class="form-check-label" for="feminino">Feminino</label>
          </div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label"><i class="bi bi-envelope"></i> E-mail</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="senha" class="form-label"><i class="bi bi-lock"></i> Senha</label>
          <input type="password" id="senha" name="senha" class="form-control" required>
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary w-100 py-2">Cadastrar</button>
          <a href="./login.php" class="link-card mt-3 d-block">Já tem uma conta? <strong>Entrar</strong></a>
        </div>
      </form>
    </div>
  </main>

  <?php include("modelo/rodape.html"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
