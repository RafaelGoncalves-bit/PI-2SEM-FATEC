<?php
    require_once __DIR__ . '/../partials/header.php';
    require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="container mt-4">
    <h2>Novo Orçamento</h2>

    <form action="<?= BASE_URL ?>/controller/OrcamentoController.php?acao=salvar" method="POST">

        <div class="card mb-4">
            <div class="card-header">Dados do Pedido</div>
            <div class="card-body row">
                
                <div class="col-md-6">
                    <label>Cliente:</label>
                    <select name="cliente_id" class="form-select" required>
                        <option value="">Selecione...</option>
                        <?php foreach ($listaClientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>">
                                <?= $cliente['nome'] ?> (<?= $cliente['documento'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Data:</label>
                    <input type="date" name="data_emissao" class="form-control" 
                           value="<?= date('Y-m-d') ?>" required>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Itens do Orçamento</span>
                <button type="button" class="btn btn-success btn-sm" onclick="adicionarLinha()">
                    + Adicionar Item
                </button>
            </div>
            
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Serviço</th>
                            <th>Tamanho</th>
                            <th style="width: 100px;">Qtd</th>
                            <th style="width: 50px;">Ação</th>
                        </tr>
                    </thead>
                    <tbody id="lista-itens">
                        </tbody>
                </table>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100">Finalizar Orçamento</button>
    </form>
</div>

<table style="display: none;">
    <tr id="linha-modelo">
        <td>
            <select name="servicos[]" class="form-select" required>
                <option value="">Escolha o serviço...</option>
                <?php foreach ($listaServicos as $servico): ?>
                    <option value="<?= $servico['id'] ?>">
                        <?= $servico['nome'] ?> (R$ <?= number_format($servico['preco_base'], 2, ',', '.') ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
            <select name="tamanhos[]" class="form-select" required>
                <option value="">Escolha o tamanho...</option>
                <?php foreach ($listaTamanhos as $tamanho): ?>
                    <option value="<?= $tamanho['id'] ?>">
                        <?= $tamanho['dimensao'] ?> (x<?= $tamanho['multiplicador_preco'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
            <input type="number" name="quantidades[]" class="form-control" value="1" min="1" required>
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="removerLinha(this)">X</button>
        </td>
    </tr>
</table>

<script>
    function adicionarLinha() {
        // 1. Pega a tabela onde vamos inserir
        const tabela = document.getElementById('lista-itens');
        
        // 2. Pega a linha modelo escondida
        const modelo = document.getElementById('linha-modelo');
        
        // 3. Clona (copia) a linha modelo
        // true significa "copie tudo que tem dentro também"
        const novaLinha = modelo.cloneNode(true);
        
        // 4. Remove o ID da cópia (para não ter IDs duplicados)
        novaLinha.removeAttribute('id');
        
        // 5. Joga a cópia dentro da tabela visível
        tabela.appendChild(novaLinha);
    }

    function removerLinha(botao) {
        // Pega a linha (tr) onde o botão está e a remove
        const linha = botao.closest('tr');
        linha.remove();
    }

    // Opcional: Adicionar uma linha automaticamente ao abrir a página
    window.onload = function() {
        adicionarLinha();
    }
</script>

<?php
require_once __DIR__ . '/../partials/footer.php';
?>
