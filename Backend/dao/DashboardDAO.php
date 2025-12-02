<?php
require_once __DIR__ . '/../config/db.php';

class DashboardDAO {
    private $pdo;

    public function __construct($conn) {
        $this->pdo = $conn;
    }

    // Conta quantos orçamentos estão esperando aprovação
    public function contarOrcamentosPendentes() {
        $sql = "SELECT COUNT(*) FROM orcamento WHERE status = 'Pendente'";
        return $this->pdo->query($sql)->fetchColumn();
    }

    // Conta quantas OS precisam ser agendadas
    public function contarOSPendentes() {
        $sql = "SELECT COUNT(*) FROM ordem_servico WHERE status_servico = 'Aguardando'";
        return $this->pdo->query($sql)->fetchColumn();
    }

    // Conta quantos agendamentos existem para HOJE
    public function contarAgendamentosHoje() {
        $sql = "SELECT COUNT(*) FROM agendamento 
                WHERE status = 'Ativo' 
                AND DATE(data_agendamento) = CURDATE()";
        return $this->pdo->query($sql)->fetchColumn();
    }

    // Traz os próximos 5 compromissos (independente da data)
    public function listarProximosAgendamentos() {
        $sql = "SELECT a.data_agendamento, c.nome as cliente, c.endereco, f.nome as funcionario
                FROM agendamento a
                JOIN ordem_servico os ON a.ordem_servico_id = os.id
                JOIN orcamento o ON os.orcamento_id = o.id
                JOIN cliente c ON o.cliente_id = c.id
                JOIN funcionario f ON a.funcionario_id = f.id
                WHERE a.status = 'Ativo' AND a.data_agendamento >= NOW()
                ORDER BY a.data_agendamento ASC
                LIMIT 5";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}