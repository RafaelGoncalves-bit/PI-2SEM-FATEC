<?php 
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../../controller/ClienteController.php';
?>

<table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Documento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
            // 🛑 ATENÇÃO: A variável $listaClientes JÁ ESTÁ DISPONÍVEL AQUI, 
            // pois o Controller a criou ANTES de dar o require.
            
            if (!empty($listaClientes)): 
                foreach ($listaClientes as $cliente): 
            ?>
                <tr>
                    <td><?= $cliente['id'] ?></td>
                    <td><?= $cliente['nome'] ?></td>
                    <td><?= $cliente['endereco'] ?></td>
                    <td><?= $cliente['telefone'] ?></td>
                    <td><?= $cliente['email'] ?></td>
                    <td><?= $cliente['tipo'] ?></td>
                    <td><?= $cliente['documento'] ?></td>
                    <td>
                        <a href="../../Backend/controller/ClienteController.php?acao=editar&id=<?= $cliente['id'] ?>">Editar</a> | 
                        <a href="../../Backend/controller/ClienteController.php?acao=excluir&id=<?= $cliente['id'] ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php 
                endforeach; 
            else: 
            ?>
                <tr>
                    <td colspan="5">Nenhum cliente cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<?php 
require_once __DIR__ . '/../partials/footer.php';

?>