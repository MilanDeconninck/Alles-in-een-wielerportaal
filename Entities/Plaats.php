<?php

declare(strict_types=1);

namespace Entities;

class Plaats
{
    private int $id;
    private string $stad;
    private string $land;

    public function __construct(int $id, string $stad, string $land)
    {
        $this->id = $id;
        $this->stad = $stad;
        $this->land = $land;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStad(): string
    {
        return $this->stad;
    }

    public function getLand(): string
    {
        return $this->land;
    }

    public function setStad(string $stad)
    {
        $this->stad = $stad;
    }

    public function setLand(string $land)
    {
        $this->land = $land;
    }
}