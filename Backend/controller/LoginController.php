<?php
// INICIA A SESSÃO (Obrigatório para login funcionar)

session_start();

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../dao/FuncionarioDAO.php';
require_once __DIR__ . '/../model/FuncionarioModel.php';

class LoginController {
    private $funcionarioDAO;

    public function __construct() {
        $db = new Database();
        $this->funcionarioDAO = new FuncionarioDAO($db->getConnection());
    }

    public function processarRequisicao() {
        $acao = $_GET['acao'] ?? 'login';

        if ($acao == 'login') {
            $this->fazerLogin();
        } elseif ($acao == 'logout') {
            $this->fazerLogout();
        }
    }

    private function fazerLogin() {
        $email = $_POST['email'] ?? '';
        $senhaDigitada = $_POST['senha'] ?? '';

        // 1. Busca no banco pelo email
        $funcionario = $this->funcionarioDAO->buscarPorEmail($email);

        // 2. Verifica se achou E se a senha bate (Hash vs Texto)
        if ($funcionario && password_verify($senhaDigitada, $funcionario->getSenha())) {
            
            // Verifica se está Ativo
            if ($funcionario->getStatus() !== 'Ativo') {
                echo "<script>alert('Usuário inativo. Contate o suporte.'); window.location.href='" . BASE_URL . "/view/funcionario/login.php'; </script>";
                exit;
            }

            // SUCESSO! Salva os dados na Sessão do navegador
            $_SESSION['usuario_id'] = $funcionario->getId();
            $_SESSION['usuario_nome'] = $funcionario->getNome();
            
            // Redireciona para a página inicial (ajuste conforme seu arquivo principal)
            header('Location: ' . BASE_URL . '/index.php'); 
            exit;

        } else {
            // ERRO
            echo "<script>alert('E-mail ou senha incorretos!'); window.location.href='" . BASE_URL . "/view/funcionario/login.php'; </script>";
        }
    }

    private function fazerLogout() {
        // Limpa a sessão e chuta para o login
        session_destroy();
        header('Location: ' . BASE_URL . '/view/funcionario/login.php');
        exit;
    }
}

// Roda o controller
$controller = new LoginController();
$controller->processarRequisicao();