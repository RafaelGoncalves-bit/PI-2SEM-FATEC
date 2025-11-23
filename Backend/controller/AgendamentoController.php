<?php
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
    const DIAS_PROIBIDOS = [0]; 

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
            // ... (VALIDAÇÕES DE HORÁRIO MANTIDAS IGUAIS) ...
            // Vou resumir as validações aqui para focar na correção do salvamento
            
            $dataDesejada = new DateTime($dataHoraInput);
            
            // A. Dia da Semana
            $diaSemana = (int)$dataDesejada->format('w');
            if (in_array($diaSemana, self::DIAS_PROIBIDOS)) {
                die("Erro: Não trabalhamos aos Domingos.");
            }

            // B. Horário
            $hora = (int)$dataDesejada->format('H');
            if ($hora < self::HORA_INICIO || $hora >= self::HORA_FIM) {
                die("Erro: Horário inválido.");
            }

            // C. Conflito de 2 horas
            $diaString = $dataDesejada->format('Y-m-d');
            $agendamentosExistentes = $this->agendamentoDAO->buscarAgendamentosDoDia($funcionarioId, $diaString);

            foreach ($agendamentosExistentes as $horarioOcupado) {
                $dataOcupada = new DateTime($horarioOcupado);
                $intervalo = $dataDesejada->diff($dataOcupada);
                $horasDeDiferenca = $intervalo->h + ($intervalo->days * 24);
                
                if ($horasDeDiferenca < self::INTERVALO_HORAS) {
                    die("Erro de Conflito: Necessário intervalo de " . self::INTERVALO_HORAS . " horas.");
                }
            }

            // --- AQUI ESTÁ A GRANDE CORREÇÃO ---
            
            // 1. Criamos o Objeto Model
            $agendamento = new AgendamentoModel();
            $agendamento->setOrdemServicoId($osId);
            $agendamento->setFuncionarioId($funcionarioId);
            $agendamento->setDataAgendamento($dataHoraInput);

            // 2. Passamos o OBJETO para o DAO (agora casa com o DAO)
            $this->agendamentoDAO->agendar($agendamento);
            
            echo "Sucesso! Agendado.";
            // header('Location: ...');

        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
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
}

$controller = new AgendamentoController();
$controller->processarRequisicao();