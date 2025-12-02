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
        // CORREÇÃO: Adicionamos "AND status = 'Ativo'"
        // Assim, horários cancelados não bloqueiam a agenda!
        $sql = "SELECT data_agendamento FROM agendamento 
                WHERE funcionario_id = ? 
                AND data_agendamento LIKE ?
                AND status = 'Ativo'"; 
        
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
                WHERE a.status = 'Ativo'
                ORDER BY a.data_agendamento ASC"; // Do mais antigo para o futuro
                
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cancelar($id) {
        try {
            // Chama a procedure que criamos (sp_cancelar_agendamento)
            $sql = "CALL sp_cancelar_agendamento(?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao cancelar agendamento: " . $e->getMessage());
        }
    }

    public function listarPorFuncionario($funcionarioId) {
        $sql = "SELECT a.data_agendamento, c.nome as cliente_nome, os.id as os_id
                FROM agendamento a
                JOIN ordem_servico os ON a.ordem_servico_id = os.id
                JOIN orcamento o ON os.orcamento_id = o.id
                JOIN cliente c ON o.cliente_id = c.id
                WHERE a.funcionario_id = ? AND a.status = 'Ativo'
                ORDER BY a.data_agendamento ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $funcionarioId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // No arquivo Backend/dao/AgendamentoDAO.php

public function verificarConflitoDeHorario(int $funcionarioId, string $dataAgendamento): bool {
    // 1. Converte a data/hora proposta para um timestamp (para cálculos)
    $propostoTimestamp = strtotime($dataAgendamento);

    // 2. Calcula o limite inferior (proposto - 2 horas)
    // 3600 segundos = 1 hora
    $limiteInferior = date('Y-m-d H:i:s', $propostoTimestamp - (2 * 3600));

    // 3. Calcula o limite superior (proposto + 2 horas)
    $limiteSuperior = date('Y-m-d H:i:s', $propostoTimestamp + (2 * 3600));

    // SQL: Busca por agendamentos ativos para o funcionário DENTRO da janela de conflito
    $sql = "SELECT COUNT(*) 
            FROM agendamento 
            WHERE funcionario_id = ? 
            AND status = 'Ativo' 
            AND data_agendamento >= ? 
            AND data_agendamento <= ?";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $funcionarioId);
    $stmt->bindValue(2, $limiteInferior);
    $stmt->bindValue(3, $limiteSuperior);
    $stmt->execute();
    
    // Se o COUNT for maior que 0, há um conflito (true)
    return $stmt->fetchColumn() > 0;
}
}