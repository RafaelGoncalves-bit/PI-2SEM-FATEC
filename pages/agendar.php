<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agendar - XC Limpeza</title>
  <link rel="stylesheet" href="css/estilo.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
</head>
<body>
  <?php include("modelo/topo.html"); ?>

<main class="container my-5">

  <section class="text-center mb-4">
    <h2 class="titulo-secao">Agendar Serviço</h2>
    <p class="subtitulo-secao">Escolha o melhor dia para higienizar seus estofados.</p>
  </section>

  <div class="p-4 rounded shadow-sm bg-white mx-auto" style="max-width: 650px;">

    <form action="#" method="POST">

      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" required>
      </div>

  <?php include("modelo/rodape.html"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Tipo de Serviço</label>
        <select class="form-select" required>
          <option>Limpeza de Sofá</option>
          <option>Limpeza de Colchão</option>
          <option>Impermeabilização</option>
          <option>Limpeza a Vapor</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Data</label>
        <input type="date" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 py-2">Agendar</button>

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
