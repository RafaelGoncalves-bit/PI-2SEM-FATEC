<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../../controller/ServicoController.php';
?>

<table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço Base</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
            // 🛑 ATENÇÃO: A variável $listaServicos JÁ ESTÁ DISPONÍVEL AQUI, 
            // pois o Controller a criou ANTES de dar o require.
            
            if (!empty($listaServicos)): 
                foreach ($listaServicos as $servico): 
            ?>
                <tr>
                    <td><?= $servico['id'] ?></td>
                    <td><?= $servico['nome'] ?></td>
                    <td><?= $servico['descricao'] ?></td>
                    <td>R$ <?= number_format($servico['preco_base'], 2, ',', '.') ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/controller/ServicoController.php?acao=editar&id=<?= $servico['id'] ?>">Editar</a> | 
                        <a href="<?= BASE_URL ?>/controller/ServicoController.php?acao=excluir&id=<?= $servico['id'] ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php 
                endforeach; 
            else: 
            ?>
                <tr>
                    <td colspan="5">Nenhum serviço cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<?php 
require_once __DIR__ . '/../partials/footer.php';

?>