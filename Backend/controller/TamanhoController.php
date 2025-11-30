<?php
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
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../dao/TamanhoDAO.php';
require_once __DIR__ . '/../model/TamanhoModel.php';

class TamanhoController {
    private $dao;

    // 2. Construtor: Prepara a Conexão e o DAO
    public function __construct() {
        // Cria a conexão usando sua classe Database (db.php)
        $db = new Database();
        $conexao = $db->getConnection();
        
        // Instancia o DAO passando a conexão
        $this->dao = new TamanhoDAO($conexao);
    }

    // 3. O Roteador (Switch Case)
    // Decide qual método chamar baseado no ?acao=... da URL
    public function processarRequisicao() {
        $acao = $_GET['acao'] ?? 'listar'; // Padrão: listar

        switch ($acao) {
            case 'cadastrar':
                $this->salvarNovoTamanho();
                break;
            
            case 'atualizar':
                $this->atualizarTamanho();
                break;

            case 'excluir':
                $this->excluirTamanho();
                break;

            case 'editar':
                $this->mostrarFormularioEdicao();
                break;

            case 'listar':
            default:
                $this->listarTamanhos();
                break;
        }
    }

    // =========================================================================
    // MÉTODOS PRIVADOS (Lógica e Validação)
    // =========================================================================

    private function listarTamanhos() {
        // 1. Pede os dados para o DAO
        $listaTamanhos = $this->dao->listarTodos();
        
        // 2. Inclui a View para mostrar na tela
        // Caminho: sai de controller(..), entra em view/tamanho
        require_once __DIR__ . '/../view/tamanho/index.php';
    }

    private function salvarNovoTamanho() {
        // 1. Captura os dados do HTML
        $dimensao = $_POST['dimensao'] ?? null;
        $multiplicadorPreco = $_POST['multiplicador_preco'] ?? 0; 

        // 2. Validação básica
        if (empty($dimensao) || $multiplicadorPreco <= 0) {
            echo "Erro: Nome obrigatório e Preço deve ser maior que zero.";
            return; // Para a execução aqui se der erro
        }

        // 3. Cria o Objeto Model (A caixa de transporte)
        $tamanho = new TamanhoModel();
        $tamanho->setDimensao($dimensao);
        $tamanho->setMultiplicadorPreco($multiplicadorPreco);

        // 4. Manda o DAO salvar no banco
        try {
            $this->dao->cadastrar($tamanho);
            
            // 5. Redireciona de volta para a listagem (Self-redirect)
            header('Location: TamanhoController.php?acao=listar');
            exit;

        } catch (Exception $e) {
            echo "Erro ao salvar: " . $e->getMessage();
        }
    }

    private function excluirTamanho() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->dao->excluir($id);
        }
        
        // Redireciona para a listagem atualizada
        header('Location: TamanhoController.php?acao=listar');
        exit;
    }

    private function mostrarFormularioEdicao() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            // Busca os dados atuais para preencher os inputs
            $tamanhoAtual = $this->dao->buscarPorId($id);
            
            // Carrega a view de edição (update.php)
            // A varitamanho estará disponível dentro desse arquivo HTML
            require_once __DIR__ . '/../view/tamanho/update.php';
        } else {
            header('Location: TamanhoController.php?acao=listar');
        }
    }

    private function atualizarTamanho() {
        // Pega o ID que veio (geralmente num input hidden)
        $id = $_POST['id'];
        $dimensao = $_POST['dimensao'];
        $multiplicadorPreco = $_POST['multiplicador_preco'];

        $tamanho = new TamanhoModel();
        $tamanho->setId($id);
        $tamanho->setDimensao($dimensao);
        $tamanho->setMultiplicadorPreco($multiplicadorPreco);

        $this->dao->atualizar($tamanho);

        header('Location: TamanhoController.php?acao=listar');
        exit;
    }
}

// =========================================================================
// GATILHO DE EXECUÇÃO
// =========================================================================
// Instancia e roda o controller assim que o arquivo é chamado pelo navegador
$controller = new TamanhoController();
$controller->processarRequisicao();