<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Início - XC Limpeza</title>
  <link rel="stylesheet" href="../css/estilo.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
</head>
<body>
  <?php include("../modelo/topo.html"); ?>

  <!-- Carrossel (imagens menores via .img-carousel no CSS) -->
  <div id="carouselMain" class="carousel slide container" data-bs-ride="carousel">
    <div class="carousel-inner rounded">
      <div class="carousel-item active">
        <img src="../img/usados (1).jpeg" class="d-block w-100 img-carousel" alt="Limpeza de sofá"/>
        <div class="carousel-caption">
          <h2>Higienização Profissional</h2>
          <p>Resultados visíveis e ambiente mais saudável.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../img/usados2 (3).jpeg" class="d-block w-100 img-carousel" alt="Limpeza de poltronas"/>
        <div class="carousel-caption">
          <h2>Cuidado com seu Estofado</h2>
          <p>Proteção e renovação do tecido.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../img/usados2 (1).jpeg" class="d-block w-100 img-carousel" alt="Equipamentos profissionais"/>
        <div class="carousel-caption">
          <h2>Equipamentos Certificados</h2>
          <p>Segurança e eficiência em cada atendimento.</p>
        </div>
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselMain" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselMain" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <main class="container my-5">

    <!-- Apresentação -->
    <section class="text-center">
      <h2 class="titulo-secao">Bem-vindo à XC Limpeza</h2>
      <p class="subtitulo-secao">Higienização de estofados em Araras e região com qualidade e confiança.</p>
      <!-- Seu texto original pode ficar aqui -->
    </section>

    <!-- Importância da limpeza de sofá (mantendo seu conteúdo) -->
    <section class="text-center">
      <h2 class="titulo-secao">Por que limpar seu sofá?</h2>
      <p class="subtitulo-secao">Conforto, saúde e durabilidade para o seu ambiente.</p>
      <!-- Seu conteúdo original aqui (listas, parágrafos, etc.) -->
    </section>

    <!-- Mapa -->
    <section class="text-center">
      <h2 class="titulo-secao">Onde estamos</h2>
      <p class="subtitulo-secao">Atendemos Araras e região</p>
      <iframe class="map-embed"
        src="https://www.google.com/maps?q=Rua%20do%20Metalurgico%2C%20Jose%20Ometto%20I%2C%20Araras%20SP&output=embed"
        allowfullscreen></iframe>
    </section>
  </main>

  <?php include("../modelo/rodape.html"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
