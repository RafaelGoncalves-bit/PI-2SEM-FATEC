<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../../controller/FuncionarioController.php';
?>

<table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
            // 🛑 ATENÇÃO: A variável $listaFuncionarios JÁ ESTÁ DISPONÍVEL AQUI, 
            // pois o Controller a criou ANTES de dar o require.
            
            if (!empty($listaFuncionarios)): 
                foreach ($listaFuncionarios as $funcionario): 
            ?>
                <tr>
                    <td><?= $funcionario['id'] ?></td>
                    <td><?= $funcionario['nome'] ?></td>
                    <td><?= $funcionario['email'] ?></td>
                    <td><?= $funcionario['telefone']?></td>
                    <td>
                        <a href="../../Backend/controller/FuncionarioController.php?acao=editar&id=<?= $funcionario['id'] ?>">Editar</a> | 
                        <a href="../../Backend/controller/FuncionarioController.php?acao=excluir&id=<?= $funcionario['id'] ?>" 
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