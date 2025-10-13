<?php

declare(strict_types=1);

namespace Business;

use Data\FietsmerkDAO;
use Entities\Fietsmerk;

class FietsmerkService {
    private $fietsmerkDAO;

    public function __construct(){
        $this->fietsmerkDAO = new FietsmerkDAO();
    }

    public function getMerkById(int $id) {
        $merkInfo = $this->fietsmerkDAO->getMerkById($id);
        $merk = new Fietsmerk((int) $merkInfo["id"], $merkInfo["naam"]);
        return $merk;
    }

    public function getMerken() {
        $merken = array();
        $merkenInfo = $this->fietsmerkDAO->getAll();
        foreach($merkenInfo as $rij) {
            $merk = New Fietsmerk((int) $rij["id"], $rij["naam"]);
            array_push($merken, $merk);
        }
        return $merken;
    }
}