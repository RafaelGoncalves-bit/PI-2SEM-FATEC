<?php
// Backend/controller/OrcamentoController.php

require_once __DIR__ . '/../config/db.php';
// Importa os Models
require_once __DIR__ . '/../model/OrcamentoModel.php';
require_once __DIR__ . '/../model/ItemOrcamentoModel.php';
// Importa TODOS os DAOs necessários
require_once __DIR__ . '/../dao/OrcamentoDAO.php';
require_once __DIR__ . '/../dao/ClienteDAO.php';
require_once __DIR__ . '/../dao/ServicoDAO.php';
require_once __DIR__ . '/../dao/TamanhoDAO.php';

class OrcamentoController {
    private $orcamentoDAO;
    private $clienteDAO;
    private $servicoDAO;
    private $tamanhoDAO;

    public function __construct() {
        $db = new Database();
        $conn = $db->getConnection();

        // Instancia a "Equipe Completa"
        $this->orcamentoDAO = new OrcamentoDAO($conn);
        $this->clienteDAO   = new ClienteDAO($conn);
        $this->servicoDAO   = new ServicoDAO($conn);
        $this->tamanhoDAO   = new TamanhoDAO($conn);
    }

    public function processarRequisicao() {
        $acao = $_GET['acao'] ?? 'listar';

        switch ($acao) {
            case 'novo':
                $this->mostrarFormularioCadastro();
                break;
            case 'salvar':
                $this->salvarNovoOrcamento();
                break;
            case 'excluir':
                $this->excluirOrcamento();
                break;
            case 'detalhes':
                $this->mostrarDetalhes();
                break;
            case 'listar':
            default:
                $this->listarOrcamentos();
                break;
        }
    }

    // =========================================================================
    // 1. LISTAGEM (Simples)
    // =========================================================================
    private function listarOrcamentos() {
        $lista = $this->orcamentoDAO->listarTodos();
        require_once __DIR__ . '/../view/orcamento/index.php';
    }

    // =========================================================================
    // 2. PREPARAR O FORMULÁRIO (Carregar listas para os <select>)
    // =========================================================================
    private function mostrarFormularioCadastro() {
        // Busca os dados para preencher os dropdowns do HTML
        $listaClientes = $this->clienteDAO->listarTodos();
        $listaServicos = $this->servicoDAO->listarTodos();
        $listaTamanhos = $this->tamanhoDAO->listarTodos();

        // Manda tudo para a View
        require_once __DIR__ . '/../view/orcamento/new.php';
    }

    // =========================================================================
    // 3. SALVAR (A Lógica Pesada)
    // =========================================================================
    private function salvarNovoOrcamento() {
        // A. Recebe dados do Mestre (Capa)
        $clienteId = $_POST['cliente_id'];
        $dataEmissao = $_POST['data_emissao']; // Ex: 2023-11-20
        
        // B. Recebe os ARRAYS dos Itens (Vindos do JavaScript/HTML)
        // Ex: servicos[0]=1, servicos[1]=5...
        $servicosIds = $_POST['servicos'] ?? []; 
        $tamanhosIds = $_POST['tamanhos'] ?? [];
        $quantidades = $_POST['quantidades'] ?? [];

        // Validação básica
        if (empty($clienteId) || empty($servicosIds)) {
            echo "Erro: Selecione um cliente e pelo menos um serviço.";
            return;
        }

        // C. Cria o Objeto Mestre
        $orcamento = new OrcamentoModel();
        $orcamento->setClienteId($clienteId);
        $orcamento->setDataEmissao($dataEmissao);
        $orcamento->setStatus('Pendente');

        $valorTotalGeral = 0;

        // D. Loop para processar cada item da lista
        // Percorremos o array de serviços (índice 0, 1, 2...)
        foreach ($servicosIds as $index => $servicoId) {
            
            // Pega os dados correspondentes no mesmo índice
            $tamanhoId = $tamanhosIds[$index];
            $qtd = $quantidades[$index];

            // --- CÁLCULO DE PREÇO (Regra de Negócio) ---
            // 1. Busca preço base do serviço no banco
            $servicoObj = $this->servicoDAO->buscarPorId($servicoId);
            $precoBase = $servicoObj->getPrecoBase();

            // 2. Busca multiplicador do tamanho no banco
            $tamanhoObj = $this->tamanhoDAO->buscarPorId($tamanhoId);
            $multiplicador = $tamanhoObj->getMultiplicadorPreco();

            // 3. Calcula: (Base * Multiplicador) * Quantidade
            $valorUnitarioFinal = $precoBase * $multiplicador;
            $valorTotalItem = $valorUnitarioFinal * $qtd;

            // --- CRIA O OBJETO ITEM ---
            $item = new ItemOrcamentoModel();
            $item->setServicoId($servicoId);
            $item->setTamanhoId($tamanhoId);
            $item->setQuantidade($qtd);
            $item->setValorCalculado($valorTotalItem);

            // Adiciona na lista do Pai
            $orcamento->addItem($item);

            // Soma no total geral
            $valorTotalGeral += $valorTotalItem;
        }

        // E. Define o total final no Mestre
        $orcamento->setValorTotal($valorTotalGeral);

        // F. Manda Salvar TUDO (Graças à Transação no DAO)
        try {
            $this->orcamentoDAO->cadastrar($orcamento);
            header('Location: OrcamentoController.php?acao=listar');
            exit;
        } catch (Exception $e) {
            echo "Erro fatal ao salvar orçamento: " . $e->getMessage();
        }
    }

    // =========================================================================
    // 4. DETALHES (Ver um orçamento específico)
    // =========================================================================
    private function mostrarDetalhes() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            // Busca o objeto completo (Mestre + Itens)
            $orcamento = $this->orcamentoDAO->buscarPorId($id);
            
            // Precisamos buscar o nome do cliente também (se o DAO não trouxer direto)
            // Ou podemos ajustar o DAO para já trazer nomes. 
            // No nosso DAO atual, o buscarPorId traz os IDs. 
            // Para exibir nomes na tela, geralmente ajustamos a View ou buscamos objetos auxiliares aqui.
            
            // Vamos assumir que a View vai receber o objeto $orcamento
            require_once __DIR__ . '/../view/orcamento/view.php';
        }
    }

    private function excluirOrcamento() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->orcamentoDAO->excluir($id);
        }
        header('Location: OrcamentoController.php?acao=listar');
        exit;
    }
}

$controller = new OrcamentoController();
$controller->processarRequisicao();