<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contato - XC Limpeza</title>
  <link rel="stylesheet" href="css/estilo.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
</head>
<body>
  <?php include("modelo/topo.html"); ?>

<main class="container my-5">

  <section class="text-center">
    <h2 class="titulo-secao">Fale Conosco</h2>
    <p class="subtitulo-secao">Estamos prontos para te atender.</p>
  </section>

  <div class="row align-items-center gy-4">

    <div class="col-md-5">
      <div class="p-4 rounded shadow-sm bg-white h-100">
        <p><i class="bi bi-geo-alt-fill text-primary"></i> Endereço original</p>
        <p><i class="bi bi-envelope text-primary"></i> E-mail original</p>
        <p><i class="bi bi-clock text-primary"></i> Horário original</p>
        <p><i class="bi bi-telephone-fill text-primary"></i> Telefone original</p>
      </div>
    </div>

    <div class="col-md-7">
      <div class="p-4 rounded shadow-sm bg-white">
        <form action="#" method="post">
          
          <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea id="mensagem" name="mensagem" rows="4" class="form-control" required></textarea>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-primary px-4">Enviar</button>
          </div>

        </form>
      </div>
    </div>

  </div>

  <section class="text-center mt-5">
    <h2 class="titulo-secao">Nossa Localização</h2>
    <p class="subtitulo-secao">Veja no mapa</p>

    <iframe class="map-embed"
      src="https://www.google.com/maps?q=Rua%20do%20Metalurgico%2C%20Jose%20Ometto%20I%2C%20Araras%20SP&output=embed"
      allowfullscreen></iframe>
  </section>

</main>

<?php include("modelo/rodape.html"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const paginaAtual = window.location.pathname.split("/").pop();
  document.querySelectorAll(".nav-link").forEach(link=>{
    if(link.getAttribute("href")===paginaAtual){link.classList.add("active")}
  });
</script>

</body>
</html>
