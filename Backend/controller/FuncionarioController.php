<?php
session_start(); // Inicia a sessão para ler os dados

// TRAVA DE SEGURANÇA
// Se não tiver a variável 'usuario_id' na sessão, é porque não logou.
if (!isset($_SESSION['usuario_id'])) {
    // Redireciona para o login
    header('Location: ../view/funcionario/login.php');
    exit; // Mata o script aqui
}

// 1. Importações (Caminhos relativos baseados na sua estrutura)
// O __DIR__ pega o diretório atual (controller) e sobe um nível (..)
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../dao/FuncionarioDAO.php';
require_once __DIR__ . '/../model/FuncionarioModel.php';

class FuncionarioController {
    private $dao;

    // 2. Construtor: Prepara a Conexão e o DAO
    public function __construct() {
        // Cria a conexão usando sua classe Database (db.php)
        $db = new Database();
        $conexao = $db->getConnection();
        
        // Instancia o DAO passando a conexão
        $this->dao = new FuncionarioDAO($conexao);
    }

    // 3. O Roteador (Switch Case)
    // Decide qual método chamar baseado no ?acao=... da URL
    public function processarRequisicao() {
        $acao = $_GET['acao'] ?? 'listar'; // Padrão: listar

        switch ($acao) {
            case 'cadastrar':
                $this->salvarNovoFuncionario();
                break;
            
            case 'atualizar':
                $this->atualizarFuncionario();
                break;

            case 'excluir':
                $this->excluirFuncionario();
                break;

            case 'editar':
                $this->mostrarFormularioEdicao();
                break;

            case 'listar':
            default:
                $this->listarFuncionarios();
                break;
        }
    }

    // =========================================================================
    // MÉTODOS PRIVADOS (Lógica e Validação)
    // =========================================================================

    private function listarFuncionarios() {
        // 1. Pede os dados para o DAO
        $listaFuncionarios = $this->dao->listarTodos();
        
        // 2. Inclui a View para mostrar na tela
        // Caminho: sai de controller(..), entra em view/funcionario
        require_once __DIR__ . '/../view/funcionario/index.php';
    }

    private function salvarNovoFuncionario() {
        // 1. Captura os dados do HTML
        $nome = $_POST['nome'] ?? null;
        $email = $_POST['email'] ?? null;
        $telefone = $_POST['telefone'] ?? null;

        // 2. Validação básica
        if (empty($nome) || (empty($email))) {
            echo "Erro: Nome obrigatório e Email obrigatório.";
            return; // Para a execução aqui se der erro
        }

        // 3. Cria o Objeto Model (A caixa de transporte)
        $funcionario = new FuncionarioModel();
        $funcionario->setNome($nome);
        $funcionario->setEmail($email);
        $funcionario->setTelefone($telefone);

        // 4. Manda o DAO salvar no banco
        try {
            $this->dao->cadastrar($funcionario);
            
            // 5. Redireciona de volta para a listagem (Self-redirect)
            header('Location: FuncionarioController.php?acao=listar');
            exit;

        } catch (Exception $e) {
            echo "Erro ao salvar: " . $e->getMessage();
        }
    }

    private function excluirFuncionario() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->dao->excluir($id);
        }
        
        // Redireciona para a listagem atualizada
        header('Location: FuncionarioController.php?acao=listar');
        exit;
    }

    private function mostrarFormularioEdicao() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            // Busca os dados atuais para preencher os inputs
            $funcionarioAtual = $this->dao->buscarPorId($id);
            
            // Carrega a view de edição (update.php)
            // A variável $servicoAtual estará disponível dentro desse arquivo HTML
            require_once __DIR__ . '/../view/funcionario/update.php';
        } else {
            header('Location: FuncionarioController.php?acao=listar');
        }
    }

    private function atualizarFuncionario() {
        // Pega o ID que veio (geralmente num input hidden)
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $funcionario = new FuncionarioModel();
        $funcionario->setId($id);
        $funcionario->setNome($nome);
        $funcionario->setEmail($email);
        $funcionario->setTelefone($telefone);

        $this->dao->atualizar($funcionario);

        header('Location: FuncionarioController.php?acao=listar');
        exit;
    }
}

// =========================================================================
// GATILHO DE EXECUÇÃO
// =========================================================================
// Instancia e roda o controller assim que o arquivo é chamado pelo navegador
$controller = new FuncionarioController();
$controller->processarRequisicao();