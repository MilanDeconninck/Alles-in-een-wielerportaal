<?php

declare(strict_types=1);

namespace Entities;

class Wedstrijd
{
    private int $id;
    private string $naam;
    private int $plaatsId;
    private float $afstand;
    private int $typeId;
    private string $startdatum;
    private string $einddatum;

    public function __construct(int $id, string $naam, int $plaatsId, float $afstand, int $typeId, string $startdatum, string $einddatum)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->plaatsId = $plaatsId;
        $this->afstand = $afstand;
        $this->typeId = $typeId;
        $this->startdatum = $startdatum;
        $this->einddatum = $einddatum;
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

    public function getAfstand(): float
    {
        return $this->afstand;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function getStartdatum(): string
    {
        return $this->startdatum;
    }

    public function getEinddatum(): string
    {
        return $this->einddatum;
    }

    public function setNaam(string $naam)
    {
        $this->naam = $naam;
    }

    public function setPlaatsId(int $plaatsId)
    {
        $this->plaatsId = $plaatsId;
    }

    public function setAfstand(float $afstand)
    {
        $this->afstand = $afstand;
    }

    public function setTypeId(int $typeId)
    {
        $this->typeId = $typeId;
    }

    public function setStartdatum(string $startdatum)
    {
        $this->startdatum = $startdatum;
    }

    public function setEinddatum(string $einddatum)
    {
        $this->einddatum = $einddatum;
    }
}