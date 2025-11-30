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

      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 py-2">Cadastrar</button>

      <div class="text-center mt-3">
        <a href="./login.php" class="link-card">Já possui conta? Entrar</a>
      </div>

    </form>

  </div>

</main>

<?php include("../modelo/rodape.html"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const paginaAtual = window.location.pathname.split("/").pop();
  document.querySelectorAll(".nav-link").forEach(link=>{
    if(link.getAttribute("href")===paginaAtual){link.classList.add("active")}
  });
</script>

</body>
</html>
