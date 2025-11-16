<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Serviços - XC Limpeza</title>
  <link rel="stylesheet" href="../css/estilo.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
</head>
<body>
  <?php include("modelo/topo.html"); ?>

  <main class="container my-5">
    <section class="text-center">
      <h2 class="titulo-secao">Nossos Serviços</h2>
      <p class="subtitulo-secao">Mantenha seus estofados limpos e protegidos.</p>
    </section>

    <div class="row gy-4 mt-2">
      <!-- Mantenha seus textos originais nos cards abaixo -->
      <div class="col-md-4">
        <div class="card-servico p-4 text-center">
          <i class="bi bi-couch icon-servico"></i>
          <h5>Limpeza de Sofás</h5>
          <p>Seu texto original...</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-servico p-4 text-center">
          <i class="bi bi-chair icon-servico"></i>
          <h5>Poltronas</h5>
          <p>Seu texto original...</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-servico p-4 text-center">
          <i class="bi bi-grid-3x3 icon-servico"></i>
          <h5>Cadeiras</h5>
          <p>Seu texto original...</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-servico p-4 text-center">
          <i class="bi bi-cloud icon-servico"></i>
          <h5>Colchões</h5>
          <p>Seu texto original...</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-servico p-4 text-center">
          <i class="bi bi-shield-lock icon-servico"></i>
          <h5>Impermeabilização</h5>
          <p>Seu texto original...</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-servico p-4 text-center">
          <i class="bi bi-droplet-half icon-servico"></i>
          <h5>Limpeza a Vapor</h5>
          <p>Seu texto original...</p>
        </div>
      </div>
    </div>
  </main>

  <?php include("modelo/rodape.html"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
