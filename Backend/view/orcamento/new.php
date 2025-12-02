<?php
    require_once __DIR__ . '/../partials/header.php';
    require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>💰 Novo Orçamento</h3>
            <p class="text-muted mb-0">Preencha os dados abaixo para gerar uma nova proposta.</p>
        </div>
        <a href="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=listar" class="btn btn-light border shadow-sm">
            🔙 Voltar
        </a>
    </div>

    <form action="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=salvar" method="POST">
        
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary">1. Dados do Pedido</h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <div class="form-floating">
                            <select name="cliente_id" id="cliente_id" class="form-select" required>
                                <option value="" selected disabled>Selecione um cliente...</option>
                                <?php foreach ($listaClientes as $cliente): ?>
                                    <option value="<?= $cliente['id'] ?>">
                                        <?= $cliente['nome'] ?> (Doc: <?= $cliente['documento'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="cliente_id">👤 Cliente Solicitante</label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-floating">
                            <input type="date" name="data_emissao" id="data_emissao" class="form-control" 
                                   value="<?= date('Y-m-d') ?>" required readonly>
                            <label for="data_emissao">📅 Data de Emissão</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary">2. Itens do Serviço</h5>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="adicionarLinha()">
                    <i class="fs-6">➕</i> Adicionar Item
                </button>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" style="width: 40%;">Serviço</th>
                                <th style="width: 30%;">Tamanho / Dimensão</th>
                                <th style="width: 15%;">Quantidade</th>
                                <th class="text-end pe-4" style="width: 10%;">Remover</th>
                            </tr>
                        </thead>
                        <tbody id="lista-itens">
                            </tbody>
                    </table>
                </div>
                
                <div id="aviso-vazio" class="text-center py-5 text-muted" style="display:none;">
                    <small>Nenhum item adicionado. Clique no botão "+" acima.</small>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
            <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                ✅ Finalizar e Gerar Orçamento
            </button>
        </div>

    </form>
</div>

<table style="display: none;">
    <tr id="linha-modelo">
        <td class="ps-4">
            <select name="servicos[]" class="form-select border-0 bg-light" required>
                <option value="" selected disabled>Escolha o serviço...</option>
                <?php foreach ($listaServicos as $servico): ?>
                    <option value="<?= $servico['id'] ?>">
                        <?= $servico['nome'] ?> (R$ <?= number_format($servico['preco_base'], 2, ',', '.') ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
            <select name="tamanhos[]" class="form-select border-0 bg-light" required>
                <option value="" selected disabled>Tamanho...</option>
                <?php foreach ($listaTamanhos as $tamanho): ?>
                    <option value="<?= $tamanho['id'] ?>">
                        <?= $tamanho['dimensao'] ?> (x<?= $tamanho['multiplicador_preco'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
            <input type="number" name="quantidades[]" class="form-control border-0 bg-light text-center" value="1" min="1" required>
        </td>
        <td class="text-end pe-4">
            <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="removerLinha(this)" title="Remover item">
                🗑️
            </button>
        </td>
    </tr>
</table>

<script>
    function adicionarLinha() {
        const tabela = document.getElementById('lista-itens');
        const modelo = document.getElementById('linha-modelo');
        const aviso = document.getElementById('aviso-vazio');

        // Clona a linha
        const novaLinha = modelo.cloneNode(true);
        novaLinha.removeAttribute('id');
        
        // Adiciona efeito visual simples (opcional)
        novaLinha.style.animation = "fadeIn 0.5s";

        tabela.appendChild(novaLinha);
        
        // Esconde o aviso de vazio se existir
        if(aviso) aviso.style.display = 'none';
    }

    function removerLinha(botao) {
        if(confirm('Remover este item?')) {
            const linha = botao.closest('tr');
            linha.remove();
        }
    }

    // CSS Animation manual para o JS
    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);

    // Inicializa com uma linha
    window.onload = function() {
        adicionarLinha();
    }
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>