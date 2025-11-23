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
    public function listarCronologico() {
    // Traz Data, Hora, Cliente, Endereço, Funcionário e Serviço
    // Note os múltiplos JOINS para pegar endereço do cliente e nome do funcionário
    $sql = "SELECT a.*, 
                   c.nome as cliente_nome, 
                   c.endereco as cliente_endereco,
                   f.nome as funcionario_nome,
                   os.id as os_id
            FROM agendamento a
            JOIN ordem_servico os ON a.ordem_servico_id = os.id
            JOIN orcamento o ON os.orcamento_id = o.id
            JOIN cliente c ON o.cliente_id = c.id
            JOIN funcionario f ON a.funcionario_id = f.id
            ORDER BY a.data_agendamento ASC"; // Do mais antigo para o futuro
            
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}