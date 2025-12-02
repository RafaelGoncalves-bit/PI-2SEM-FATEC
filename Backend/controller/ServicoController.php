<?php
require_once __DIR__ . '/../config/db.php';

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . '/view/funcionario/login.php');
    exit;
}

require_once __DIR__ . '/../dao/ServicoDAO.php';
require_once __DIR__ . '/../model/ServicoModel.php';

class ServicoController {
    private $dao;

    public function __construct() {
        $db = new Database();
        $this->dao = new ServicoDAO($db->getConnection());
    }

    public function processarRequisicao() {
        $acao = $_REQUEST['acao'] ?? 'listar'; // Alterado para REQUEST para pegar POST também

        switch ($acao) {
            // UNIFICADO: O formulário manda sempre 'salvar'
            case 'salvar':
                $this->decidirSalvarOuAtualizar();
                break;

            case 'excluir':
                $this->excluirServico();
                break;

            case 'editar':
                $this->mostrarFormularioEdicao();
                break;

            case 'novo':
                $this->mostrarFormularioCadastro();
                break;

            case 'listar':
            default:
                $this->listarServicos();
                break;
        }
    }

    // --- LÓGICA DE DECISÃO ---
    private function decidirSalvarOuAtualizar() {
        $id = $_POST['id'] ?? null;
        if (!empty($id)) {
            $this->atualizarServico();
        } else {
            $this->salvarNovoServico();
        }
    }

    private function listarServicos() {
        $listaServicos = $this->dao->listarTodos();
        require_once __DIR__ . '/../view/servico/index.php';
    }

    private function salvarNovoServico() {
        $nome = $_POST['nome'] ?? null;
        $descricao = $_POST['descricao'] ?? null;
        // Tratamento de Moeda (1.200,50 -> 1200.50)
        $preco = str_replace(['.', ','], ['', '.'], $_POST['preco'] ?? '0');

        if (empty($nome) || $preco <= 0) {
            echo "<script>alert('Nome obrigatório e preço maior que zero!'); window.history.back();</script>";
            return;
        }

        $servico = new ServicoModel();
        $servico->setNome($nome);
        $servico->setDescricao($descricao);
        $servico->setPrecoBase($preco);

        try {
            $this->dao->cadastrar($servico);
            header('Location: ServicoController.php?acao=listar');
            exit;
        } catch (Exception $e) {
            echo "Erro ao salvar: " . $e->getMessage();
        }
    }

    private function atualizarServico() {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = str_replace(['.', ','], ['', '.'], $_POST['preco']);

        $servico = new ServicoModel();
        $servico->setId($id);
        $servico->setNome($nome);
        $servico->setDescricao($descricao);
        $servico->setPrecoBase($preco);

        try {
            $this->dao->atualizar($servico);
            header('Location: ServicoController.php?acao=listar');
            exit;
        } catch (Exception $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
        }
    }

    private function excluirServico() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $this->dao->excluir($id);
            } catch (Exception $e) {
                echo "<script>alert('Erro: Serviço em uso!'); window.location.href='ServicoController.php?acao=listar';</script>";
                exit;
            }
        }
        header('Location: ServicoController.php?acao=listar');
        exit;
    }

    private function mostrarFormularioEdicao() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            // Busca Objeto (Model)
            $servico = $this->dao->buscarPorId($id);
            // Reutiliza o formulário NEW
            require_once __DIR__ . '/../view/servico/new.php';
        } else {
            header('Location: ServicoController.php?acao=listar');
        }
    }

    private function mostrarFormularioCadastro() {
        require_once __DIR__ . '/../view/servico/new.php';
    }
}

$controller = new ServicoController();
$controller->processarRequisicao();