<?php
// Backend/model/ClienteModel.php

class ClienteModel {
    private ?int $id = null;
    private string $nome;
    private string $endereco;
    private string $telefone;
    private string $email;
    private string $tipo; // 'Fisica' ou 'Juridica'
    private string $documento; // CPF ou CNPJ
    private ?string $senha = null;

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

    // --- ENDEREÇO ---
    public function getEndereco(): string {
        return $this->endereco;
    }
    public function setEndereco(string $endereco): void {
        $this->endereco = $endereco;
    }

    // --- TELEFONE ---
    public function getTelefone(): string {
        return $this->telefone;
    }
    public function setTelefone(string $telefone): void {
        $this->telefone = $telefone;
    }

    // --- EMAIL ---
    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    // --- TIPO (Fisica/Juridica) ---
    public function getTipo(): string {
        return $this->tipo;
    }
    public function setTipo(string $tipo): void {
        // Dica: Podemos forçar ser apenas 'Fisica' ou 'Juridica' aqui se quiser
        $this->tipo = $tipo;
    }

    // --- DOCUMENTO (CPF/CNPJ) ---
    public function getDocumento(): string {
        return $this->documento;
    }
    public function setDocumento(string $documento): void {
        // Boa prática: Limpar pontos e traços antes de salvar
        // Ex: 123.456-78 vira 12345678
        $this->documento = preg_replace('/[^0-9]/', '', $documento);
    }

    // --- SENHA (O Futuro) ---
    public function getSenha(): ?string {
        return $this->senha;
    }

    public function setSenha(?string $senha): void {
        // Se vier senha, já podemos aplicar o hash aqui ou no Controller
        // Para hoje, vamos apenas guardar.
        $this->senha = $senha;
    }
}