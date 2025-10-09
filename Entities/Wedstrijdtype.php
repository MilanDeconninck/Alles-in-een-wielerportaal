<?php

declare(strict_types=1);

namespace Entities;

class Wedstrijdtype
{
    private int $id;
    private string $type;
    private string $rennerType;

    public function __construct(int $id, string $type, string $rennerType)
    {
        $this->id = $id;
        $this->type = $type;
        $this->rennerType = $rennerType;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getRennerType(): string
    {
        return $this->rennerType;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function setRennerType(string $rennerType)
    {
        $this->rennerType = $rennerType;
    }
}