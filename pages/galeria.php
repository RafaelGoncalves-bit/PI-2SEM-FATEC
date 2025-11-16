<?php include("../modelo/topo.html"); ?>

<main class="container my-5">

  <section class="text-center">
    <h2 class="titulo-secao">Galeria</h2>
    <p class="subtitulo-secao">Antes e depois dos nossos trabalhos.</p>
  </section>

  <!-- =============================
       SOFÁ AZUL
  ============================== -->
  <h4 class="mt-5 mb-2">Sofá Azul</h4>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="galeria-card shadow-sm p-2 rounded">
        <img src="../img/antes_sofa_azul.jpg" class="img-fluid rounded" alt="Antes sofá azul">
        <p class="fw-bold mt-2 text-center text-primary">Antes</p>
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

<?php include("../modelo/rodape.html"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const atual = window.location.pathname.split("/").pop();
  document.querySelectorAll(".nav-link").forEach(z => {
    if (z.getAttribute("href") === atual) z.classList.add("active");
  });
</script>

</body>
</html>
