<?php

declare(strict_types=1);

namespace Business;

use Data\WedstrijdDAO;
use Entities\Wedstrijd;

class WedstrijdService{
    private $wedstrijdDAO;

    public function __construct() {
        $this->wedstrijdDAO = new WedstrijdDAO();
    }

    public function getWedstrijdById(int $id) {
        $wedstrijdInfo = $this->wedstrijdDAO->getWedstrijdById($id);
        $wedstrijd = new Wedstrijd((int) $wedstrijdInfo["id"], $wedstrijdInfo["naam"], (int) $wedstrijdInfo["plaatsId"], (float) $wedstrijdInfo["afstand"], (int) $wedstrijdInfo["typeId"], $wedstrijdInfo["startdatum"], $wedstrijdInfo["einddatum"]);
        return $wedstrijd;
    }
}