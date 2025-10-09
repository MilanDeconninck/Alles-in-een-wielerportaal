<?php

declare(strict_types=1);

namespace Business;

use Data\GebruikerDAO;
use Entities\Gebruiker;
use Exceptions\GebruikerBestaatNietException;
use Exceptions\GebruikerBestaatAlException;

class GebruikerService
{
    private $gebruikerDAO;

    public function __construct()
    {
        $this->gebruikerDAO = new GebruikerDAO();
    }

    public function getGebruikers()
    {
        $gebruikers = array();
        $gebruikersInfo = $this->gebruikerDAO->getAll();
        foreach ($gebruikersInfo as $rij) {
            $gebruiker = new Gebruiker((int) $rij["id"], $rij["emailadres"], $rij["wachtwoord"], $rij["rechten"]);
            array_push($gebruikers, $gebruiker);
        }
        return $gebruikers;
    }

    public function controleLogin(string $email, string $wachtwoord)
    {
        $gebruiker = $this->gebruikerDAO->getGebruikerByEmail($email);
        if (empty($gebruiker)) {
            throw new GebruikerBestaatNietException();
        }
        $gebruikerInfo = new Gebruiker((int) $gebruiker["id"], $gebruiker["emailadres"], $gebruiker["wachtwoord"], $gebruiker["rechten"]);
        $wachtwoordCheck = $gebruikerInfo->getWachtwoord();
        $check = password_verify($wachtwoord, $wachtwoordCheck);
        return $check;
    }

    public function getId(string $email)
    {
        $gebruiker = $this->gebruikerDAO->getGebruikerByEmail($email);
        $gebruikerInfo = new Gebruiker((int) $gebruiker["id"], $gebruiker["emailadres"], $gebruiker["wachtwoord"], $gebruiker["rechten"]);
        return $gebruikerInfo->getId();
    }

    public function voegGebruikerToe(string $email, string $wachtwoord, string $rechten)
    {
        $gebruiker = $this->gebruikerDAO->getGebruikerByEmail($email);
        if (!empty($gebruiker)) {
            throw new GebruikerBestaatAlException();
        }
        $wachtwoordhash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $this->gebruikerDAO->create($email, $wachtwoordhash, $rechten);
    }

    public function getRechten(string $email)
    {
        $gebruiker = $this->gebruikerDAO->getGebruikerByEmail($email);
        $rechten = $gebruiker["rechten"];
        return $rechten;
    }
}