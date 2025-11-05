<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendar Limpeza - XC Limpeza</title>
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<?php include("../modelo/topo.html"); ?>

<body>
  <main class="container py-5">
    <h1 class="text-center mb-4">Agende sua Limpeza</h1>
    <p class="text-center text-secondary mb-5">
      Preencha o formulário abaixo e entraremos em contato para confirmar o melhor horário.<br>
      Atendemos <strong>Araras e região</strong> — com qualidade, segurança e pontualidade.
    </p>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card-servico p-4">
          <form action="#" method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="nome" class="form-label fw-semibold">Nome completo</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Seu nome" required>
              </div>
              <div class="col-md-6">
                <label for="telefone" class="form-label fw-semibold">Telefone</label>
                <input type="tel" id="telefone" name="telefone" class="form-control" placeholder="(19) 99999-9999" required>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label fw-semibold">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="exemplo@email.com">
              </div>
              <div class="col-md-6">
                <label for="servico" class="form-label fw-semibold">Tipo de serviço</label>
                <select id="servico" name="servico" class="form-select" required>
                  <option value="">Selecione...</option>
                  <option>Limpeza de Sofá</option>
                  <option>Limpeza de Colchão</option>
                  <option>Limpeza de Cadeiras</option>
                  <option>Limpeza de Poltronas</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="data" class="form-label fw-semibold">Data preferida</label>
                <input type="date" id="data" name="data" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="horario" class="form-label fw-semibold">Horário aproximado</label>
                <select id="horario" name="horario" class="form-select">
                  <option>Manhã</option>
                  <option>Tarde</option>
                  <option>Noite</option>
                </select>
              </div>
              <div class="col-12">
                <label for="mensagem" class="form-label fw-semibold">Mensagem adicional</label>
                <textarea id="mensagem" name="mensagem" class="form-control" rows="3" placeholder="Ex: Tenho um sofá grande e duas cadeiras..."></textarea>
              </div>
            </div>

            <div class="text-center mt-4">
              <a href="https://wa.me/5519998566099?text=Olá! Gostaria de agendar uma limpeza de estofados."
                 target="_blank" class="btn btn-primary btn-lg">
                 <i class="bi bi-whatsapp"></i> Enviar pelo WhatsApp
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <?php include("../modelo/rodape.html"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
