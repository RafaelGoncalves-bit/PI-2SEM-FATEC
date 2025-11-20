<?php
// Backend/model/ItemOrcamentoModel.php

class ItemOrcamentoModel {
    private ?int $id = null;
    private int $orcamentoId; // FK
    private int $servicoId;   // FK
    private int $tamanhoId;   // FK
    private int $quantidade;
    private float $valorCalculado; // Preço final deste item (Unitário * Qtd * Tamanho)

    // Getters e Setters
    public function getId(): ?int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getOrcamentoId(): int {
        return $this->orcamentoId;
    }
    public function setOrcamentoId(int $orcamentoId): void {
        $this->orcamentoId = $orcamentoId;
    }

    public function getServicoId(): int {
        return $this->servicoId;
    }
    public function setServicoId(int $servicoId): void {
        $this->servicoId = $servicoId;
    }

    public function getTamanhoId(): int {
        return $this->tamanhoId;
    }
    public function setTamanhoId(int $tamanhoId): void {
        $this->tamanhoId = $tamanhoId;
    }

    public function getQuantidade(): int {
        return $this->quantidade;
    }
    public function setQuantidade(int $quantidade): void {
        $this->quantidade = $quantidade;
    }

    public function getValorCalculado(): float {
        return $this->valorCalculado;
    }
    public function setValorCalculado(float $valorCalculado): void {
        $this->valorCalculado = $valorCalculado;
    }
}