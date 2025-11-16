<?php include("../modelo/topo.html"); ?>

<main class="container vh-100 d-flex justify-content-center align-items-center">

  <div class="login-card">

    <div class="text-center mb-3">
      <img src="../img/logo.jpeg" width="70" class="rounded-circle mb-2 border border-primary" alt="Logo XC Limpeza">
      <h2 class="text-primary fw-bold">Criar Conta</h2>
      <p class="text-muted mb-4">Preencha os dados abaixo</p>
    </div>

    <form action="#" method="POST">
      
      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" required>
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
