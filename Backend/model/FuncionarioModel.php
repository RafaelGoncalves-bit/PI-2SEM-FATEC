<?php

//namespace Model; // Opcional: Se você for usar namespaces para organizar melhor

class FuncionarioModel {
    // 1. Atributos (Espelho das colunas do Banco de Dados)
    // Usamos 'private' para garantir que só sejam alterados pelos métodos Setters
    
    private ?int $id = null; // O '?' significa que pode ser nulo (antes de salvar no banco)
    private string $nome;
    private string $email; // Pode ser nulo se não tiver descrição
    private ?string $cpf = null;
    
    private float $telefone;


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

    // --- EMAIL ---
    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

     // --- CPF (OPCIONAL) ---
    public function getCpf(): ?string {
        return $this->cpf;
    }
    
    public function setCpf(?string $cpf): void {
        // Se vier algo, limpa. Se não, fica null.
        $this->cpf = $cpf ? preg_replace('/[^0-9]/', '', $cpf) : null;
    }

     // --- TELEFONE ---
    public function getTelefone(): float {
        return $this->telefone;
    }

    public function setTelefone(float $telefone): void {
        $this->telefone = $telefone;
    }
}