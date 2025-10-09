<?php

declare(strict_types=1);

namespace Entities;

class Contract {
    private int $rennerId;
    private int $ploegId;
    private string $startdatum;
    private string $einddatum;

    public function __construct(int $rennerId, int $ploegId, string $startdatum, string $einddatum) {
        $this->rennerId = $rennerId;
        $this->ploegId = $ploegId;
        $this->startdatum = $startdatum;
        $this->einddatum = $einddatum;
    }

    public function getRennerId(): int {
        return $this->rennerId;
    }

    public function getPloegId(): int {
        return $this->ploegId;
    }

    public function getStartdatum(): string {
        return $this->startdatum;
    }

    public function getEinddatum(): string {
        return $this->einddatum;
    }

    public function setRennerId(int $rennerId) {
        $this->rennerId = $rennerId;
    }

    public function setPloegId(int $ploegId) {
        $this->ploegId = $ploegId;
    }

    public function setStartdatum(string $startdatum) {
        $this->startdatum = $startdatum;
    }

    public function setEinddatum(string $einddatum) {
        $this->einddatum = $einddatum;
    }
}