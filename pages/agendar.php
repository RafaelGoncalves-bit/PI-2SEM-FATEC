<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agendar - XC Limpeza</title>
  <link rel="stylesheet" href="../css/estilo.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
</head>
<body>
  <?php include("../modelo/topo.html"); ?>

  <main class="container my-5">
    <section class="text-center">
      <h2 class="titulo-secao">Agende seu Serviço</h2>
      <p class="subtitulo-secao">Preencha e entraremos em contato.</p>
    </section>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="p-4 rounded shadow-sm bg-white">
          <form action="#" method="post">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" id="nome" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="telefone" class="form-label">Telefone</label>
              <input type="tel" id="telefone" name="telefone" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="servico" class="form-label">Serviço</label>
              <select id="servico" name="servico" class="form-select" required>
                <option value="">Selecione</option>
                <option value="sofa">Limpeza de Sofá</option>
                <option value="poltrona">Poltrona</option>
                <option value="cadeira">Cadeiras</option>
                <option value="colchao">Colchão</option>
                <option value="impermeabilizacao">Impermeabilização</option>
                <option value="vapor">Limpeza a Vapor</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="data" class="form-label">Data</label>
              <input type="date" id="data" name="data" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="mensagem" class="form-label">Mensagem</label>
              <textarea id="mensagem" name="mensagem" rows="4" class="form-control"></textarea>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary px-4">Agendar</button>
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
