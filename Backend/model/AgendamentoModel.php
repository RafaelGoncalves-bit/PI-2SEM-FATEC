<?php
// Backend/model/AgendamentoModel.php

class AgendamentoModel {
    private ?int $id = null;
    private int $ordemServicoId; // Qual serviço será feito
    private int $funcionarioId;  // Quem vai fazer
    private string $dataAgendamento; // Quando (Data e Hora)

    // --- ID ---
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // --- ORDEM DE SERVIÇO ID (FK) ---
    public function getOrdemServicoId(): int {
        return $this->ordemServicoId;
    }

    public function setOrdemServicoId(int $ordemServicoId): void {
        $this->ordemServicoId = $ordemServicoId;
    }

    // --- FUNCIONÁRIO ID (FK) ---
    public function getFuncionarioId(): int {
        return $this->funcionarioId;
    }

    public function setFuncionarioId(int $funcionarioId): void {
        $this->funcionarioId = $funcionarioId;
    }

    // --- DATA DO AGENDAMENTO ---
    public function getDataAgendamento(): string {
        return $this->dataAgendamento;
    }

    public function setDataAgendamento(string $dataAgendamento): void {
        $this->dataAgendamento = $dataAgendamento;
    }
}