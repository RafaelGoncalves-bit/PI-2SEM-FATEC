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
    </div>
    <div class="col-md-6">
      <div class="galeria-card shadow-sm p-2 rounded">
        <img src="../img/depois_sofa_azul.jpg" class="img-fluid rounded" alt="Depois sofá azul">
        <p class="fw-bold mt-2 text-center text-success">Depois</p>
      </div>
    </div>
  </div>

  <!-- =============================
       COLCHÃO
  ============================== -->
  <h4 class="mt-5 mb-2">Colchão</h4>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="galeria-card shadow-sm p-2 rounded">
        <img src="../img/antes_colchao.jpg" class="img-fluid rounded" alt="Antes colchão">
        <p class="fw-bold mt-2 text-center text-primary">Antes</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="galeria-card shadow-sm p-2 rounded">
        <img src="../img/depois_colchao.jpg" class="img-fluid rounded" alt="Depois colchão">
        <p class="fw-bold mt-2 text-center text-success">Depois</p>
      </div>
    </div>
  </div>

  <!-- =============================
       SOFÁ CANTO MARROM
  ============================== -->
  <h4 class="mt-5 mb-2">Sofá Canto</h4>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="galeria-card shadow-sm p-2 rounded">
        <img src="../img/antes_sofa_canto.jpg" class="img-fluid rounded" alt="Antes sofá canto">
        <p class="fw-bold mt-2 text-center text-primary">Antes</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="galeria-card shadow-sm p-2 rounded">
        <img src="../img/depois_sofa_canto.jpg" class="img-fluid rounded" alt="Depois sofá canto">
        <p class="fw-bold mt-2 text-center text-success">Depois</p>
      </div>
    </div>
  </div>

  <!-- =============================
       POLTRONAS
  ============================== -->
  <h4 class="mt-5 mb-2">Poltronas</h4>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="galeria-card shadow-sm p-2 rounded">
        <img src="../img/antes_poltronas.jpg" class="img-fluid rounded" alt="Antes poltronas">
        <p class="fw-bold mt-2 text-center text-primary">Antes</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="galeria-card shadow-sm p-2 rounded">
        <img src="../img/depois_poltronas.jpg" class="img-fluid rounded" alt="Depois poltronas">
        <p class="fw-bold mt-2 text-center text-success">Depois</p>
      </div>
    </div>
  </div>

</main>

<?php include("modelo/rodape.html"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const atual = window.location.pathname.split("/").pop();
  document.querySelectorAll(".nav-link").forEach(z => {
    if (z.getAttribute("href") === atual) z.classList.add("active");
  });
</script>

</body>
</html>
