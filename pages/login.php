<?php 
$email = 'admin@admin';
$senha = 123;
?>
<?php include("../modelo/topo.html"); ?>

<body class="background-login">

<main class="container vh-100 d-flex justify-content-center align-items-center">

  <div class="login-card">

    <div class="text-center mb-3">
      <img src="../img/logo.jpeg" width="70" class="rounded-circle mb-2 border border-primary" alt="Logo XC Limpeza">
      <h2 class="text-primary fw-bold">Bem-vindo(a)</h2>
      <p class="text-muted mb-4">Acesse sua conta</p>
    </div>

    <form action="./index.php" method="POST">
      
      <div class="mb-3">
        <label for="email" class="form-label"><i class="bi bi-envelope"></i> E-mail</label>
        <input type="email" class="form-control" id="email" name="email_conf" required>
      </div>

      <div class="mb-3">
        <label for="senha" class="form-label"><i class="bi bi-lock"></i> Senha</label>
        <input type="password" class="form-control" id="senha" name="senha_conf" required>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary w-100 py-2">Entrar</button>
        <a href="./cadastro.php" class="link-card mt-3 d-block">Não tem uma conta? <strong>Cadastre-se</strong></a>
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
