<?php

session_start(); // Inicia a sessão para ler os dados

// TRAVA DE SEGURANÇA
// Se não tiver a variável 'usuario_id' na sessão, é porque não logou.
if (!isset($_SESSION['usuario_id'])) {
    // Redireciona para o login
    header('Location: ' . BASE_URL . '/view/funcionario/login.php');
    exit; // Mata o script aqui
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../dao/AgendamentoDAO.php';
require_once __DIR__ . '/../dao/OrdemServicoDAO.php';
require_once __DIR__ . '/../dao/FuncionarioDAO.php';
// IMPORTANTE: Adicionei a importação do Model aqui
require_once __DIR__ . '/../model/AgendamentoModel.php'; 
require_once __DIR__ . '/../dao/OrcamentoDAO.php';

class AgendamentoController {
    private $agendamentoDAO;
    private $funcionarioDAO;
    private $ordemServicoDAO;
    private $orcamentoDAO;

    

    // === SUAS REGRAS DE FLEXIBILIDADE ===
    const HORA_INICIO = 7; 
    const HORA_FIM = 18;    
    const INTERVALO_HORAS = 2; 
    const DIAS_PROIBIDOS = [0,6]; 

    public function __construct() {
        $db = new Database();
        $conn = $db->getConnection();
        $this->agendamentoDAO = new AgendamentoDAO($conn);
        $this->ordemServicoDAO = new OrdemServicoDAO($conn);
        $this->funcionarioDAO = new FuncionarioDAO($conn);
        $this->orcamentoDAO = new OrcamentoDAO($conn);

    }

    public function processarRequisicao() {
        $acao = $_GET['acao'] ?? 'listar';

        switch ($acao) {
            case 'novo':
                $this->mostrarFormulario();
                break;
            case 'salvar':
                $this->salvarAgendamento();
                break;
            case 'gerar_os':
                $this->gerarOSApartirDoOrcamento();
                break;
            case 'listar_os':
                $this->listarTodasOS();
                break;
            case 'agenda':
                $this->verAgenda();
                break;
            case 'cancelar':
                $this->cancelarAgendamento();
                break;
            case 'concluir_os':
                $this->concluirOS();
                break;
            case 'pendentes':
                 $this->listarOSPendentes();
                break;
            case 'ver_disponibilidade':
                $this->verDisponibilidade();
                break;
        }
    }

    // 1. Método corrigido (Nome da variável do DAO)
    private function gerarOSApartirDoOrcamento() {
        $orcamentoId = $_GET['id_orcamento'];
        
        // CORREÇÃO: Mudado de $this->servi para $this->ordemServicoDAO
        $this->ordemServicoDAO->criarAPartirDoOrcamento($orcamentoId); 

        $this->orcamentoDAO->atualizarStatus($orcamentoId, 'Aprovado');
        
        header('Location: AgendamentoController.php?acao=novo');
    }

    private function mostrarFormulario() {
        $listaFuncionarios = $this->funcionarioDAO->listarTodos();
        $listaOSPendentes = $this->ordemServicoDAO->listarPendentes(); // CORREÇÃO: Busca no DAO correto
        require_once __DIR__ . '/../view/agendamento/new.php';
    }


    // 2. O ALGORITMO DE VALIDAÇÃO E SALVAMENTO
    private function salvarAgendamento() {
        $osId = $_POST['os_id'];
        $funcionarioId = $_POST['funcionario_id'];
        $dataHoraInput = $_POST['data_hora']; 

        try {
            // ... (VALIDAÇÕES DE HORÁRIO BÁSICAS (A e B) MANTIDAS) ...
            
            $dataDesejada = new DateTime($dataHoraInput);
            
            // A. Dia da Semana (Fica)
            $diaSemana = (int)$dataDesejada->format('w');
            if (in_array($diaSemana, self::DIAS_PROIBIDOS)) {
                throw new Exception("Não trabalhamos aos Sabados e aos Domingos.");
            }

            // B. Horário (Fica)
            $hora = (int)$dataDesejada->format('H');
            if ($hora < self::HORA_INICIO || $hora >= self::HORA_FIM) {
                throw new Exception("Horário inválido. Atendemos de " . self::HORA_INICIO . ":00 às " . self::HORA_FIM . ":00.");
            }
            if ($this->agendamentoDAO->verificarConflitoDeHorario($funcionarioId, $dataHoraInput)) {
                throw new Exception("CONFLITO! O funcionário já tem um serviço agendado dentro do intervalo de +/- " . self::INTERVALO_HORAS . " horas da hora proposta.");
            }

            // --- AQUI ESTÁ A GRANDE CORREÇÃO ---
            
            // 1. Criamos o Objeto Model
            $agendamento = new AgendamentoModel();
            $agendamento->setOrdemServicoId($osId);
            $agendamento->setFuncionarioId($funcionarioId);
            $agendamento->setDataAgendamento($dataHoraInput);

            // 2. Passamos o OBJETO para o DAO (agora casa com o DAO)
            $this->agendamentoDAO->agendar($agendamento);

            $this->ordemServicoDAO->atualizarStatus($osId, 'Agendado');
            
// --- CÓDIGO REFATORADO PARA MOSTRAR POPUP E REDIRECIONAR ---
            
            // Usamos JavaScript para mostrar a mensagem de sucesso e redirecionar.
            // O \n no alert quebra a linha para melhor visualização
            $dataObj = new DateTime($dataHoraInput);
            $dataHoraFormatada = $dataObj->format('d/m/Y') . ' às ' . $dataObj->format('H:i');

            echo "<script>
                alert('🎉 Sucesso! Agendamento criado.\\n\\nOS #$osId agendada para $dataHoraFormatada .');
                window.location.href = 'AgendamentoController.php?acao=agenda';
            </script>";
            exit; // Mata o script após o echo para garantir que o JS execute
            
        } catch (Exception $e) {
                $fullErrorMsg = $e->getMessage();
                $cleanErrorMsg = '';
    
                // 1. Tenta identificar e limpar a mensagem do MySQL Trigger (Erro 1644)
                $triggerMarker = '1644 Erro:';
                $triggerPos = strpos($fullErrorMsg, $triggerMarker);
    
                if ($triggerPos !== false) {
                    // Se o marcador for encontrado, extrai a mensagem limpa
                    $cleanErrorMsg = trim(substr($fullErrorMsg, $triggerPos + strlen($triggerMarker)));
                } else {
                    // 2. Para todos os outros erros (Conflito de 2 horas, etc.)
                    $cleanErrorMsg = str_replace(array("\n", "\r"), ' ', $fullErrorMsg);
                }
    
                // 3. Fallback (Garantia de que a mensagem não fique vazia)
                if (empty($cleanErrorMsg)) {
                    $cleanErrorMsg = "Ocorreu um erro desconhecido ao agendar. Verifique o log.";
                }
    
                // Exibe a mensagem de erro limpa no pop-up
                echo "<script>
                    alert('❌ Erro ao agendar: $cleanErrorMsg');
                    window.history.back();
                </script>";
                exit;
        }
    }

    private function listarTodasOS() {
        $listaOS = $this->ordemServicoDAO->listarTodas();
        require_once __DIR__ . '/../view/agendamento/lista_os.php';
    }

    private function verAgenda() {
        $listaAgenda = $this->agendamentoDAO->listarCronologico();
        require_once __DIR__ . '/../view/agendamento/agenda.php';
    }

    private function cancelarAgendamento() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            try {
                $this->agendamentoDAO->cancelar($id);
            } catch (Exception $e) {
                // AGORA MOSTRAMOS O ERRO
                echo "<script>alert('Erro ao cancelar: " . $e->getMessage() . "'); window.history.back();</script>";
                exit; 
            }
        }
        
        header('Location: AgendamentoController.php?acao=agenda');
        exit;
    }

    private function concluirOS() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->ordemServicoDAO->concluir($id);
        }
        // Volta para a lista de OS
        header('Location: AgendamentoController.php?acao=listar_os');
        exit;
    }

    private function listarOSPendentes() {
        // Busca apenas as OS com status 'Aguardando'
        $listaPendentes = $this->ordemServicoDAO->listarPendentes();
        
        // Carrega a view específica
        require_once __DIR__ . '/../view/agendamento/pendentes.php';
    }

    private function verDisponibilidade() {
        $funcionarioId = $_GET['funcionario_id'] ?? null;
        
        if ($funcionarioId) {
            // Reutilizamos a lógica do DAO (listarCronologico, mas filtrando)
            // NOTA: Você precisará adicionar um método no DAO para buscar por ID de funcionário
            $agenda = $this->agendamentoDAO->listarPorFuncionario($funcionarioId);
            
            // Define o cabeçalho para o navegador entender que é JSON
            header('Content-Type: application/json');
            echo json_encode($agenda);
        } else {
            header('Content-Type: application/json');
            echo json_encode([]);
        }
        exit;
    }
}

$controller = new AgendamentoController();
$controller->processarRequisicao();