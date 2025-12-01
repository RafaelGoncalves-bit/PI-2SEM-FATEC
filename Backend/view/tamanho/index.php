<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../../controller/TamanhoController.php';
?>

<table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dimensao</th>
                <th>Multiplicador de Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
            // 🛑 ATENÇÃO: A variável $listaTamanhos JÁ ESTÁ DISPONÍVEL AQUI, 
            // pois o Controller a criou ANTES de dar o require.
            
            if (!empty($listaTamanhos)): 
                foreach ($listaTamanhos as $tamanho): 
            ?>
                <tr>
                    <td><?= $tamanho['id'] ?></td>
                    <td><?= $tamanho['dimensao'] ?></td>
                    <td><?= number_format($tamanho['multiplicador_preco'], 2, '.', ',') ?>X</td>
                    <td>
                        <a href="<?= BASE_URL ?>/controller/TamanhoController.php?acao=editar&id=<?= $tamanho['id'] ?>">Editar</a> | 
                        <a href="<?= BASE_URL ?>/controller/TamanhoController.php?acao=excluir&id=<?= $tamanho['id'] ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php 
                endforeach; 
            else: 
            ?>
                <tr>
                    <td colspan="5">Nenhum tamanho cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<?php 
require_once __DIR__ . '/../partials/footer.php';

?>