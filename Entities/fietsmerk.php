<?php

declare(strict_types=1);

namespace Entities;

class Fietsmerk
{
    private int $id;
    private string $naam;

    public function __construct(int $id, string $naam)
    {
        $this->id = $id;
        $this->naam = $naam;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function setNaam(string $naam)
    {
        $this->naam = $naam;
    }
}