<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . '/view/login.php');
    exit;
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../dao/ClienteDAO.php';
require_once __DIR__ . '/../model/ClienteModel.php';

class ClienteController {
    private $dao;

    public function __construct() {
        $db = new Database();
        $this->dao = new ClienteDAO($db->getConnection());
    }

    public function processarRequisicao() {
        $acao = $_REQUEST['acao'] ?? 'listar';

        switch ($acao) {
            case 'salvar':
                $this->decidirSalvarOuAtualizar();
                break;

            case 'excluir':
                $this->excluirCliente();
                break;

            case 'editar':
                $this->mostrarFormularioEdicao();
                break;

            case 'novo':
                $this->mostrarFormularioCadastro();
                break;

            case 'listar':
            default:
                $this->listarClientes();
                break;
        }
    }

    // =========================================================================
    // MÉTODOS DE ROTEAMENTO (DECISÃO)
    // =========================================================================

    private function decidirSalvarOuAtualizar() {
        // Verifica se veio um ID escondido no formulário
        $id = $_POST['id'] ?? null;

        if (!empty($id)) {
            $this->atualizarCliente(); // Tem ID = Edição
        } else {
            $this->cadastrarCliente(); // Sem ID = Novo
        }
    }

    // =========================================================================
    // AÇÕES DO CRUD
    // =========================================================================

    private function cadastrarCliente() {
        $cliente = $this->montarObjetoPeloPost();
        
        try {
            $this->dao->cadastrar($cliente);
            header('Location: ClienteController.php?acao=listar');
            exit;
        } catch (Exception $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    }

    private function atualizarCliente() {
        $id = $_POST['id']; // Garante que pegou o ID
        
        $cliente = $this->montarObjetoPeloPost();
        $cliente->setId($id); // Seta o ID no modelo para o DAO saber quem atualizar

        try {
            $this->dao->atualizar($cliente);
            header('Location: ClienteController.php?acao=listar');
            exit;
        } catch (Exception $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
        }
    }

    private function excluirCliente() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $this->dao->excluir($id);
            } catch (Exception $e) {
                echo "<script>alert('Erro: Cliente possui orçamentos vinculados.'); window.location.href='ClienteController.php?acao=listar';</script>";
                exit;
            }
        }
        header('Location: ClienteController.php?acao=listar');
        exit;
    }

    // =========================================================================
    // VISUALIZAÇÃO E AUXILIARES
    // =========================================================================

    private function listarClientes() {
        $listaClientes = $this->dao->listarTodos();
        require_once __DIR__ . '/../view/cliente/index.php';
    }

    private function mostrarFormularioCadastro() {
        // Carrega a view limpa
        require_once __DIR__ . '/../view/cliente/new.php';
    }

    private function mostrarFormularioEdicao() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $cliente = $this->dao->buscarPorId($id); // Busca dados do banco
            // A view vai usar a variável $cliente para preencher os campos
            require_once __DIR__ . '/../view/cliente/new.php';
        } else {
            header('Location: ClienteController.php?acao=listar');
        }
    }

    // Método auxiliar para não repetir código (DRY)
    private function montarObjetoPeloPost() {
        $cliente = new ClienteModel();
        $cliente->setNome($_POST['nome']);
        $cliente->setEndereco($_POST['endereco']);
        $cliente->setTelefone($_POST['telefone']);
        $cliente->setEmail($_POST['email']);
        $cliente->setTipo($_POST['tipo']);
        $cliente->setDocumento($_POST['documento']);
        return $cliente;
    }
}

$controller = new ClienteController();
$controller->processarRequisicao();