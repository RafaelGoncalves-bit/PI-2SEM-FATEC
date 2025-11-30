<?php
session_start(); // Inicia a sessão para ler os dados

// TRAVA DE SEGURANÇA
// Se não tiver a variável 'usuario_id' na sessão, é porque não logou.
if (!isset($_SESSION['usuario_id'])) {
    // Redireciona para o login
    header('Location: ' . BASE_URL . '/view/funcionario/login.php');

    exit; // Mata o script aqui
}


// 1. Importações
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../dao/ClienteDAO.php';
require_once __DIR__ . '/../model/ClienteModel.php';

class ClienteController {
    private $dao;

    // 2. Construtor: Prepara a Conexão e o DAO
    public function __construct() {
        $db = new Database();
        $conexao = $db->getConnection();
        $this->dao = new ClienteDAO($conexao);
    }

    // 3. O Roteador (Switch Case)
    public function processarRequisicao() {
        // Usar $_REQUEST permite pegar 'acao' vinda de GET (link) ou POST (form)
        $acao = $_REQUEST['acao'] ?? 'listar';

        switch ($acao) {
            case 'cadastrar':
                $this->salvarCliente();
                break;
            
            case 'atualizar':
                $this->atualizarCliente();
                break;

            case 'excluir':
                $this->excluirCliente();
                break;

            case 'editar':
                $this->mostrarFormularioEdicao();
                break;

            case 'listar':
            default:
                $this->listarClientes();
                break;
        }
    }

    // =========================================================================
    // MÉTODOS PRIVADOS (Lógica e Validação)
    // =========================================================================

    private function listarClientes() {
        $listaClientes = $this->dao->listarTodos();
        
        // Ajuste o caminho para sua view de clientes
        require_once __DIR__ . '/../view/cliente/index.php'; 
    }

    private function salvarCliente() {
        // 1. Captura os dados do HTML
        $nome = $_POST['nome'] ?? null;
        $endereco = $_POST['endereco'] ?? null;
        $telefone = $_POST['telefone'] ?? null;
        $email = $_POST['email'] ?? null;
        $tipo = $_POST['tipo'] ?? 'Fisico'; // 'Fisica' ou 'Juridica'
        $documento = $_POST['documento'] ?? null;

        // 2. Validação básica
        if (empty($nome) || empty($email) || empty($documento)) {
            echo "Erro: Nome, Email e Documento são obrigatórios.";
            return; 
        }

        // 3. Cria o Objeto Model
        $cliente = new ClienteModel();
        $cliente->setNome($nome);
        $cliente->setEndereco($endereco);
        $cliente->setTelefone($telefone);
        $cliente->setEmail($email);
        $cliente->setTipo($tipo);
        $cliente->setDocumento($documento); // O setter já limpa (tira pontos/traços)
        // A senha fica nula por padrão, como definimos no Model

        // 4. Manda o DAO salvar no banco
        try {
            $this->dao->cadastrar($cliente);
            
            // 5. Redireciona para a listagem
            header('Location: ClienteController.php?acao=listar');
            exit;

        } catch (Exception $e) {
            echo "Erro ao salvar cliente: " . $e->getMessage();
        }
    }

    private function excluirCliente() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                $this->dao->excluir($id);
            } catch (Exception $e) {
                // Captura erro de chave estrangeira (se o cliente tiver orçamentos)
                echo "Erro: Não é possível excluir um cliente que já possui orçamentos.";
                // Adiciona um link para voltar
                echo '<br><a href="ClienteController.php?acao=listar">Voltar</a>';
                exit;
            }
        }
        
        header('Location: ClienteController.php?acao=listar');
        exit;
    }

    private function mostrarFormularioEdicao() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            $clienteAtual = $this->dao->buscarPorId($id);
            
            if ($clienteAtual) {
                // Carrega a view de edição
                require_once __DIR__ . '/../view/cliente/update.php';
            } else {
                echo "Cliente não encontrado.";
                header('Location: ClienteController.php?acao=listar');
            }
        } else {
            header('Location: ClienteController.php?acao=listar');
        }
    }

    private function atualizarCliente() {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: ClienteController.php?acao=listar');
            exit;
        }

        $cliente = new ClienteModel();
        $cliente->setId($id);
        $cliente->setNome($_POST['nome']);
        $cliente->setEndereco($_POST['endereco']);
        $cliente->setTelefone($_POST['telefone']);
        $cliente->setEmail($_POST['email']);
        $cliente->setTipo($_POST['tipo']);
        $cliente->setDocumento($_POST['documento']);

        $this->dao->atualizar($cliente);

        header('Location: ClienteController.php?acao=listar');
        exit;
    }
}

// =========================================================================
// GATILHO DE EXECUÇÃO
// =========================================================================
$controller = new ClienteController();
$controller->processarRequisicao();