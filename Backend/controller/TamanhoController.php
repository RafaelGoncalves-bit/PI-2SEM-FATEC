<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . '/view/funcionario/login.php');
    exit;
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../dao/TamanhoDAO.php';
require_once __DIR__ . '/../model/TamanhoModel.php';

class TamanhoController {
    private $dao;

    public function __construct() {
        $db = new Database();
        $this->dao = new TamanhoDAO($db->getConnection());
    }

    public function processarRequisicao() {
        $acao = $_REQUEST['acao'] ?? 'listar';

        switch ($acao) {
            // UNIFICADO
            case 'salvar':
                $this->decidirSalvarOuAtualizar();
                break;

            case 'excluir':
                $this->excluirTamanho();
                break;

            case 'editar':
                $this->mostrarFormularioEdicao();
                break;

            case 'novo':
                $this->mostrarFormularioCadastro();
                break;

            case 'listar':
            default:
                $this->listarTamanhos();
                break;
        }
    }

    // Corrigido typo (deciding -> decidir)
    private function decidirSalvarOuAtualizar() {
        $id = $_POST['id'] ?? null;
        if (!empty($id)) {
            $this->atualizarTamanho();
        } else {
            $this->salvarNovoTamanho();
        }
    }

    private function listarTamanhos() {
        $listaTamanhos = $this->dao->listarTodos();
        require_once __DIR__ . '/../view/tamanho/index.php';
    }

    private function salvarNovoTamanho() {
        $dimensao = $_POST['dimensao'] ?? null;
        $multiplicadorPreco = $_POST['multiplicador_preco'] ?? 0;

        if (empty($dimensao) || $multiplicadorPreco <= 0) {
            echo "<script>alert('Dimensão obrigatória!'); window.history.back();</script>";
            return;
        }

        $tamanho = new TamanhoModel();
        $tamanho->setDimensao($dimensao);
        $tamanho->setMultiplicadorPreco($multiplicadorPreco);

        try {
            $this->dao->cadastrar($tamanho);
            header('Location: TamanhoController.php?acao=listar');
            exit;
        } catch (Exception $e) {
            echo "Erro ao salvar: " . $e->getMessage();
        }
    }

    private function atualizarTamanho() {
        $id = $_POST['id'];
        $dimensao = $_POST['dimensao'];
        $multiplicadorPreco = $_POST['multiplicador_preco'];

        $tamanho = new TamanhoModel();
        $tamanho->setId($id);
        $tamanho->setDimensao($dimensao);
        $tamanho->setMultiplicadorPreco($multiplicadorPreco);

        try {
            $this->dao->atualizar($tamanho);
            header('Location: TamanhoController.php?acao=listar');
            exit;
        } catch (Exception $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
        }
    }

    private function excluirTamanho() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $this->dao->excluir($id);
            } catch (Exception $e) {
                 echo "<script>alert('Erro: Tamanho em uso!'); window.location.href='TamanhoController.php?acao=listar';</script>";
                 exit;
            }
        }
        header('Location: TamanhoController.php?acao=listar');
        exit;
    }

    private function mostrarFormularioEdicao() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            // Busca Objeto (Model)
            $tamanho = $this->dao->buscarPorId($id);
            // Reutiliza o formulário NEW
            require_once __DIR__ . '/../view/tamanho/new.php';
        } else {
            header('Location: TamanhoController.php?acao=listar');
        }
    }

    private function mostrarFormularioCadastro() {
        require_once __DIR__ . '/../view/tamanho/new.php';
    }
}

$controller = new TamanhoController();
$controller->processarRequisicao();