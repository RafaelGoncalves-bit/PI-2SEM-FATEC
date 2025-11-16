<?php include("../modelo/topo.html"); ?>

<main class="container my-5">

  <!-- Título -->
  <section class="text-center">
    <h2 class="titulo-secao">Nossos Serviços</h2>
    <p class="subtitulo-secao">Mantenha seus estofados limpos e protegidos.</p>
  </section>

  <!-- Cards de Serviços -->
  <div class="row gy-4 mt-2">

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

  <!-- =============================
       EQUIPAMENTOS PROFISSIONAIS
  ============================== -->
  <section class="text-center mt-5">
    <h2 class="titulo-secao">Equipamentos Profissionais</h2>
    <p class="subtitulo-secao">Tecnologia avançada para resultados superiores.</p>
  </section>

  <div class="row g-4 mt-4">

    <!-- Aspirador -->
    <div class="col-md-4">
      <div class="equip-card shadow-sm p-3 rounded h-100">
        <img src="../img/equip_aspirador_wap.jpg" class="img-fluid rounded mb-3" alt="Aspirador WAP">
        <h5 class="fw-bold">Aspirador WAP GTW INOX</h5>
        <p class="small">Alta sucção, ideal para remoção profunda de sujeira em estofados.</p>
      </div>
    </div>

    <!-- Kit de Escovas -->
    <div class="col-md-4">
      <div class="equip-card shadow-sm p-3 rounded h-100">
        <img src="../img/equip_kit_limpeza.jpg" class="img-fluid rounded mb-3" alt="Kit de Limpeza">
        <h5 class="fw-bold">Kit Profissional de Higienização</h5>
        <p class="small">Ideal para limpeza detalhada de cantos, texturas e superfícies delicadas.</p>
      </div>
    </div>

    <!-- Extratora -->
    <div class="col-md-4">
      <div class="equip-card shadow-sm p-3 rounded h-100">
        <img src="../img/equip_extratora_ea262.jpg" class="img-fluid rounded mb-3" alt="Extratora EA262">
        <h5 class="fw-bold">Extratora EA262</h5>
        <p class="small">Equipamento industrial para higienização profunda com extração de líquidos.</p>
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
