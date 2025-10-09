<?php

namespace Business;

use Data\DeelnemerDAO;
use Entities\Deelnemer;

class DeelnemerService{
    private $deelnemerDAO;
    
    public function __construct(){
        $this->deelnemerDAO = new DeelnemerDAO();
    }

    public function getDeelnamesByRennerId(int $rennerId) {
        $deelnames = array();
        $deelnamesInfo = $this->deelnemerDAO->getDeelnamesByRennerId($rennerId);
        foreach($deelnamesInfo as $rij) {
            $deelname = new Deelnemer((int) $rij["id"], (int) $rij["wedstrijdId"], (int) $rij["rennerId"], (int) $rij["ploegId"]);
            array_push($deelnames, $deelname);
        }
        return $deelnames;
    }
}