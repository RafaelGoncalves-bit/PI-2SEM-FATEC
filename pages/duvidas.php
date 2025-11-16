<?php include("../modelo/topo.html"); ?>

<main class="container my-5">

  <section class="text-center">
    <h2 class="titulo-secao">Dúvidas Frequentes</h2>
    <p class="subtitulo-secao">Encontre respostas rápidas sobre nossos serviços.</p>
  </section>

  <div class="accordion accordion-flush" id="faqXC">

    <div class="accordion-item">
      <h2 class="accordion-header" id="faq1">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#resposta1">
          <i class="bi bi-question-circle me-2 text-primary"></i> Pergunta 1
        </button>
      </h2>
      <div id="resposta1" class="accordion-collapse collapse" data-bs-parent="#faqXC">
        <div class="accordion-body">
          Sua resposta original...
        </div>
      </div>
    </div>

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
