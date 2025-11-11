<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dúvidas - XC Limpeza</title>
  <link rel="stylesheet" href="../css/estilo.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
</head>
<body>
  <?php include("../modelo/topo.html"); ?>

  <main class="container my-5">
    <section class="text-center">
      <h2 class="titulo-secao">Dúvidas Frequentes</h2>
      <p class="subtitulo-secao">Encontre respostas rápidas sobre nossos serviços.</p>
    </section>

    <div class="accordion accordion-flush" id="faqXC">
      <!-- Mantenha suas perguntas e respostas originais -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faq1">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#resposta1">
            <i class="bi bi-question-circle me-2 text-primary"></i> Pergunta 1 (seu texto)
          </button>
        </h2>
        <div id="resposta1" class="accordion-collapse collapse" data-bs-parent="#faqXC">
          <div class="accordion-body">
            Sua resposta original...
          </div>
        </div>
      </div>

      <!-- Duplique os itens do accordion conforme necessidade -->
    </div>
  </main>

  <?php include("../modelo/rodape.html"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
