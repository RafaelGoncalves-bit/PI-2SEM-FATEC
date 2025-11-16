<?php

//namespace Model; // Opcional: Se você for usar namespaces para organizar melhor

class ServicoModel {
    // 1. Atributos (Espelho das colunas do Banco de Dados)
    // Usamos 'private' para garantir que só sejam alterados pelos métodos Setters
    
    private ?int $id = null; // O '?' significa que pode ser nulo (antes de salvar no banco)
    private string $nome;
    private ?string $descricao; // Pode ser nulo se não tiver descrição
    private float $precoBase;

    // 2. Getters e Setters (A forma de acessar e modificar os dados)

    // --- ID ---
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // --- NOME ---
    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    // --- DESCRIÇÃO ---
    public function getDescricao(): ?string {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void {
        $this->descricao = $descricao;
    }

    // --- PREÇO BASE ---
    public function getPrecoBase(): float {
        return $this->precoBase;
    }

    public function setPrecoBase(float $precoBase): void {
        $this->precoBase = $precoBase;
    }
}