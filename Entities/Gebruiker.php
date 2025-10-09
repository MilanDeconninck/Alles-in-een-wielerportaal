<?php

declare(strict_types=1);

namespace Entities;

use Exceptions\OngeldigEmailadresException;

class Gebruiker
{
    private int $id;
    private string $emailadres;
    private string $wachtwoord;
    private string $rechten;

    public function __construct(int $id, string $emailadres, string $wachtwoord, string $rechten)
    {
        $this->id = $id;
        $this->emailadres = $emailadres;
        $this->wachtwoord = $wachtwoord;
        $this->rechten = $rechten;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmailadres(): string
    {
        return $this->emailadres;
    }

    public function getWachtwoord(): string
    {
        return $this->wachtwoord;
    }

    public function getRechten(): string
    {
        return $this->rechten;
    }

    public function setEmailadres(string $emailadres)
    {
        if (!filter_var($emailadres, FILTER_VALIDATE_EMAIL)) {
            throw new OngeldigEmailadresException();
        }
        $this->emailadres = $emailadres;
    }

    public function setWachtwoord(string $wachtwoord)
    {
        $this->wachtwoord = $wachtwoord;
    }

    public function setRechten(string $rechten)
    {
        $this->rechten = $rechten;
    }
}