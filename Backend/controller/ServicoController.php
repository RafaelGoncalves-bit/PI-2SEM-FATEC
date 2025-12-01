<?php
require_once __DIR__ . '/../config/db.php';

session_start(); // Inicia a sessão para ler os dados

// TRAVA DE SEGURANÇA
// Se não tiver a variável 'usuario_id' na sessão, é porque não logou.
if (!isset($_SESSION['usuario_id'])) {
    // Redireciona para o login
    header('Location: ' . BASE_URL . '/view/funcionario/login.php');
    exit; // Mata o script aqui
}
// 1. Importações (Caminhos relativos baseados na sua estrutura)
// O __DIR__ pega o diretório atual (controller) e sobe um nível (..)
require_once __DIR__ . '/../dao/ServicoDAO.php';
require_once __DIR__ . '/../model/ServicoModel.php';

class ServicoController {
    private $dao;

    // 2. Construtor: Prepara a Conexão e o DAO
    public function __construct() {
        // Cria a conexão usando sua classe Database (db.php)
        $db = new Database();
        $conexao = $db->getConnection();
        
        // Instancia o DAO passando a conexão
        $this->dao = new ServicoDAO($conexao);
    }

    // 3. O Roteador (Switch Case)
    // Decide qual método chamar baseado no ?acao=... da URL
    public function processarRequisicao() {
        $acao = $_GET['acao'] ?? 'listar'; // Padrão: listar

        switch ($acao) {
            case 'cadastrar':
                $this->salvarNovoServico();
                break;
            
            case 'atualizar':
                $this->atualizarServico();
                break;

            case 'excluir':
                $this->excluirServico();
                break;

            case 'editar':
                $this->mostrarFormularioEdicao();
                break;

            case 'listar':
            default:
                $this->listarServicos();
                break;
        }
    }

    // =========================================================================
    // MÉTODOS PRIVADOS (Lógica e Validação)
    // =========================================================================

    private function listarServicos() {
        // 1. Pede os dados para o DAO
        $listaServicos = $this->dao->listarTodos();
        
        // 2. Inclui a View para mostrar na tela
        // Caminho: sai de controller(..), entra em view/servico
        require_once __DIR__ . '/../view/servico/index.php';
    }

    private function salvarNovoServico() {
        // 1. Captura os dados do HTML
        $nome = $_POST['nome'] ?? null;
        $descricao = $_POST['descricao'] ?? null;
        $preco = $_POST['preco_base'] ?? 0;

        // 2. Validação básica
        if (empty($nome) || $preco <= 0) {
            echo "Erro: Nome obrigatório e Preço deve ser maior que zero.";
            return; // Para a execução aqui se der erro
        }

        // 3. Cria o Objeto Model (A caixa de transporte)
        $servico = new ServicoModel();
        $servico->setNome($nome);
        $servico->setDescricao($descricao);
        $servico->setPrecoBase($preco);

        // 4. Manda o DAO salvar no banco
        try {
            $this->dao->cadastrar($servico);
            
            // 5. Redireciona de volta para a listagem (Self-redirect)
            header('Location: ServicoController.php?acao=listar');
            exit;

        } catch (Exception $e) {
            echo "Erro ao salvar: " . $e->getMessage();
        }
    }

    private function excluirServico() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->dao->excluir($id);
        }
        
        // Redireciona para a listagem atualizada
        header('Location: ServicoController.php?acao=listar');
        exit;
    }

    private function mostrarFormularioEdicao() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            // Busca os dados atuais para preencher os inputs
            $servicoAtual = $this->dao->buscarPorId($id);
            
            // Carrega a view de edição (update.php)
            // A variável $servicoAtual estará disponível dentro desse arquivo HTML
            require_once __DIR__ . '/../view/servico/update.php';
        } else {
            header('Location: ServicoController.php?acao=listar');
        }
    }

    private function atualizarServico() {
        // Pega o ID que veio (geralmente num input hidden)
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco_base'];

        $servico = new ServicoModel();
        $servico->setId($id);
        $servico->setNome($nome);
        $servico->setDescricao($descricao);
        $servico->setPrecoBase($preco);

        $this->dao->atualizar($servico);

        header('Location: ServicoController.php?acao=listar');
        exit;
    }
}

// =========================================================================
// GATILHO DE EXECUÇÃO
// =========================================================================
// Instancia e roda o controller assim que o arquivo é chamado pelo navegador
$controller = new ServicoController();
$controller->processarRequisicao();