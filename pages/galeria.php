<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Galeria - XC Limpeza</title>
  <link rel="stylesheet" href="css/estilo.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
</head>
<body>
  <?php include("modelo/topo.html"); ?>

  <main class="container my-5">
    <section class="text-center">
      <h2 class="titulo-secao">Galeria</h2>
      <p class="subtitulo-secao">Antes e depois dos nossos trabalhos.</p>
    </section>

    <div class="row g-4">
      <!-- Mantenha suas imagens e textos originais -->
      <div class="col-md-4 col-sm-6">
        <div class="card">
          <img src="img/usados (1).jpeg" class="card-img-top rounded" alt="Exemplo"/>
          <div class="card-body">
            <h6 class="fw-bold text-primary">Título original</h6>
            <p class="card-text">Descrição original...</p>
          </div>
        </div>
      </div>

      <!-- Duplique os cards conforme sua galeria -->
    </div>
  </main>

  <?php include("modelo/rodape.html"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
