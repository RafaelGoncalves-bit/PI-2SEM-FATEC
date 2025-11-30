<?php
// Backend/model/OrcamentoModel.php

class OrcamentoModel {
    private ?int $id = null;
    private int $clienteId;
    private string $dataEmissao;
    private float $valorTotal;
    private string $status; // 'Pendente', 'Aprovado', 'Rejeitado'
    
    // PROPRIEDADE ESPECIAL (Não é coluna no banco, mas ajuda na lógica)
    // Vai guardar uma lista de objetos ItemOrcamentoModel
    private array $itens = []; 

    // --- ID ---
    public function getId(): ?int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    // --- CLIENTE ---
    public function getClienteId(): int {
        return $this->clienteId;
    }
    public function setClienteId(int $clienteId): void {
        $this->clienteId = $clienteId;
    }

    // --- DATA ---
    public function getDataEmissao(): string {
        return $this->dataEmissao;
    }
    public function setDataEmissao(string $dataEmissao): void {
        $this->dataEmissao = $dataEmissao;
    }

    // --- VALOR TOTAL ---
    public function getValorTotal(): float {
        return $this->valorTotal;
    }
    public function setValorTotal(float $valorTotal): void {
        $this->valorTotal = $valorTotal;
    }

    // --- STATUS ---
    public function getStatus(): string {
        return $this->status;
    }
    public function setStatus(string $status): void {
        $this->status = $status;
    }

    // --- MÉTODOS ESPECIAIS PARA OS ITENS ---
    
    public function addItem(ItemOrcamentoModel $item) {
        $this->itens[] = $item;
    }

    public function getItens(): array {
        return $this->itens;
    }
}