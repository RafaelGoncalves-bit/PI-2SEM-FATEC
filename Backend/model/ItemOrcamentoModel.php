<?php
// Backend/model/ItemOrcamentoModel.php

class ItemOrcamentoModel {
    private ?int $id = null;
    private int $orcamentoId; // FK
    private int $servicoId;   // FK
    private int $tamanhoId;   // FK
    private int $quantidade;
    private float $valorCalculado; // Preço final deste item (Unitário * Qtd * Tamanho)
    private ?string $nomeServico = null;
    private ?string $nomeTamanho = null;
    private $multiplicadorPreco;

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
        // --- NOME DO SERVICO ---
    public function setNomeServico($nome) { 
        $this->nomeServico = $nome; 
    }
    public function getNomeServico() {
         return $this->nomeServico; 
    }

    // --- NOME DO TAMANHO ---
    public function setNomeTamanho($nome) { 
        $this->nomeTamanho = $nome; 
    }
    public function getNomeTamanho() { 
        return $this->nomeTamanho; 
    }

    public function getMultiplicadorPreco() {
        return $this->multiplicadorPreco;
    }

    public function setMultiplicadorPreco($multiplicadorPreco) {
        $this->multiplicadorPreco = $multiplicadorPreco;
    }
}