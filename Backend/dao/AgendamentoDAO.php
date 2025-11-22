<?php
require_once __DIR__ . '/../model/AgendamentoModel.php';

class AgendamentoDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function agendar(AgendamentoModel $agendamento) {
        $sql = "INSERT INTO agendamento (ordem_servico_id, funcionario_id, data_agendamento) 
                VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $agendamento->getOrdemServicoId());
        $stmt->bindValue(2, $agendamento->getFuncionarioId());
        $stmt->bindValue(3, $agendamento->getDataAgendamento());
        return $stmt->execute();
    }

    public function buscarAgendamentosDoDia($funcionarioId, $data) {
        $sql = "SELECT data_agendamento FROM agendamento 
                WHERE funcionario_id = ? AND data_agendamento LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $funcionarioId);
        $stmt->bindValue(2, $data . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function listarTodos() {
        // SQL para listar agendamentos com nomes de Funcionario e Cliente...
        // Faremos depois para a tela de calendário
    }
}