<?php

declare(strict_types=1);

namespace Entities;

class Ploeg
{
    private int $id;
    private string $naam;
    private int $plaatsId;
    private int $fietsmerkId;

    public function __construct(int $id, string $naam, int $plaatsId, int $fietsmerkId)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->plaatsId = $plaatsId;
        $this->fietsmerkId = $fietsmerkId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getPlaatsId(): int
    {
        return $this->plaatsId;
    }

    public function getFietsmerkId(): int
    {
        return $this->fietsmerkId;
    }

    public function setNaam(string $naam)
    {
        $this->naam = $naam;
    }

    public function setPlaatsId(int $plaatsId)
    {
        $this->plaatsId = $plaatsId;
    }

    public function setFietsmerkId(int $fietsmerkId)
    {
        $this->fietsmerkId = $fietsmerkId;
    }
}