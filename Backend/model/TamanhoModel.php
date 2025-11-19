<?php
// Backend/model/TamanhoModel.php

class TamanhoModel {
    private ?int $id = null;
    private string $dimensao;
    private float $multiplicadorPreco;

    // --- ID ---
    public function getId(): ?int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    // --- DIMENSÃO (Nome do tamanho, ex: "2 Lugares") ---
    public function getDimensao(): string {
        return $this->dimensao;
    }
    public function setDimensao(string $dimensao): void {
        $this->dimensao = $dimensao;
    }

    // --- MULTIPLICADOR (Ex: 1.5 para aumentar 50%) ---
    public function getMultiplicadorPreco(): float {
        return $this->multiplicadorPreco;
    }
    public function setMultiplicadorPreco(float $multiplicadorPreco): void {
        $this->multiplicadorPreco = $multiplicadorPreco;
    }
}