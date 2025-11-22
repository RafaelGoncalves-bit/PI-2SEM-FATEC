<?php
// Backend/model/OrdemServicoModel.php

class OrdemServicoModel {
    private ?int $id = null;
    private int $orcamentoId;
    private string $dataGeracao;
    private string $statusServico; // 'Aguardando', 'Em Andamento', 'Concluido'
    private ?string $dataConclusao = null;

    // --- ID ---
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // --- ORÇAMENTO ID (FK) ---
    public function getOrcamentoId(): int {
        return $this->orcamentoId;
    }

    public function setOrcamentoId(int $orcamentoId): void {
        $this->orcamentoId = $orcamentoId;
    }

    // --- DATA DA GERAÇÃO ---
    public function getDataGeracao(): string {
        return $this->dataGeracao;
    }

    public function setDataGeracao(string $dataGeracao): void {
        $this->dataGeracao = $dataGeracao;
    }

    // --- STATUS DO SERVIÇO ---
    public function getStatusServico(): string {
        return $this->statusServico;
    }

    public function setStatusServico(string $statusServico): void {
        $this->statusServico = $statusServico;
    }

    // --- DATA DE CONCLUSÃO ---
    public function getDataConclusao(): ?string {
        return $this->dataConclusao;
    }

    public function setDataConclusao(?string $dataConclusao): void {
        $this->dataConclusao = $dataConclusao;
    }
}