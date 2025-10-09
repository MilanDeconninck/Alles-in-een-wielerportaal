<?php

declare(strict_types=1);

namespace Entities;

class Deelnemer
{
    private int $id;
    private int $wedstrijdId;
    private int $rennerId;
    private int $ploegId;

    public function __construct(int $id, int $wedstrijdId, int $rennerId, int $ploegId)
    {
        $this->id = $id;
        $this->wedstrijdId = $wedstrijdId;
        $this->rennerId = $rennerId;
        $this->ploegId = $ploegId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getWedstrijdId(): int
    {
        return $this->wedstrijdId;
    }

    public function getRennerId(): int
    {
        return $this->rennerId;
    }

    public function getPloegId(): int
    {
        return $this->ploegId;
    }

    public function setWedstrijdId(int $wedstrijdId)
    {
        $this->wedstrijdId = $wedstrijdId;
    }

    public function setRennerId(int $rennerId)
    {
        $this->rennerId = $rennerId;
    }

    public function setPloegId(int $ploegId)
    {
        $this->ploegId = $ploegId;
    }
}