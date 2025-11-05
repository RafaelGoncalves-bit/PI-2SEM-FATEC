<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contato - XC Limpeza</title>
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<?php include("../modelo/topo.html"); ?>

<body>
  <main class="container py-5">
    <h1 class="text-center text-dark mb-4">Fale Conosco</h1>
    <p class="text-center text-secondary mb-5">
      Entre em contato para tirar dúvidas ou agendar sua limpeza.  
      Estamos prontos para atender você com agilidade e atenção!
    </p>

    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <form action="#" method="POST" class="card p-4 shadow-sm" style="background: rgba(255,255,255,0.9);">
          <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="Seu nome">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" placeholder="seuemail@email.com">
          </div>
          <div class="mb-3">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea id="mensagem" class="form-control" rows="4" placeholder="Escreva sua mensagem..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-100">Enviar</button>
          <a href="https://wa.me/5519998566099" target="_blank" class="btn btn-success w-100 mt-2">
            <i class="bi bi-whatsapp"></i> Falar no WhatsApp
          </a>
        </form>
      </div>
    </div>
  </main>

  <?php include("../modelo/rodape.html"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
