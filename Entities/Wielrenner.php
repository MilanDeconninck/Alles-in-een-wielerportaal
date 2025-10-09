<?php

declare(strict_types=1);

namespace Entities;

class Wielrenner
{
    private int $id;
    private string $voornaam;
    private string $familienaam;
    private string $geboortedatum;
    private int $typeId;
    private int $plaatsId;

    public function __construct(int $id, string $voornaam, string $familienaam, string $geboortedatum, int $typeId, int $plaatsId)
    {
        $this->id = $id;
        $this->voornaam = $voornaam;
        $this->familienaam = $familienaam;
        $this->geboortedatum = $geboortedatum;
        $this->typeId = $typeId;
        $this->plaatsId = $plaatsId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getVoornaam(): string
    {
        return $this->voornaam;
    }

    public function getFamilienaam(): string
    {
        return $this->familienaam;
    }

    public function getGeboortedatum(): string
    {
        return $this->geboortedatum;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function getPlaatsId(): int
    {
        return $this->plaatsId;
    }

    public function setVoornaam(string $voornaam)
    {
        $this->voornaam = $voornaam;
    }

    public function setFamilienaam(string $familienaam)
    {
        $this->familienaam = $familienaam;
    }

    public function setGeboortedatum(string $geboortedatum)
    {
        $this->geboortedatum = $geboortedatum;
    }

    public function setTypeId(int $typeId)
    {
        $this->typeId = $typeId;
    }

    public function setPlaatsId(int $plaatsId)
    {
        $this->plaatsId = $plaatsId;
    }
}