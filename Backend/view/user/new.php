<?php
require_once __DIR__ . '/../partials/navbar.php';
?>

<div class="background-cadastro">
    <div class="container vh-100 d-flex justify-content-center align-items-center estrela">
        <div class="col-auto d-flex justify-content-center">
            <div class="login-card">
                <div>
                    <h1 class="text-center">Cadastro</h1>
                </div>
                <form action="<?= BASE_URL ?>/controller/UserController.php" method="POST" class="mt-2">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">telefone</label>
                        <input type="number" class="form-control" id="telefone" name="telefone" required>
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereco</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" required>
                    </div>
                    <!-- <div class="text-center">
                        <h5>Sexo</h2>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo" value="masculino">
                                <label class="form-check-label" for="sexo">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="feminino">
                                <label class="form-check-label" for="sexo1">Feminino</label>
                            </div>
                    </div> -->
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div> -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        <!-- <a href="./index.php" class="link-card">Login</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

