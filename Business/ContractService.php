<?php

declare(strict_types=1);

namespace Business;

use Data\ContractDAO;
use Entities\Contract;

class ContractService
{
    private $contractDAO;

    public function __construct()
    {
        $this->contractDAO = new ContractDAO();
    }

    public function getContractenByRennerId(int $rennerId)
    {
        $contracten = array();
        $contractenInfo = $this->contractDAO->getContractenByRennerId($rennerId);
        foreach ($contractenInfo as $rij) {
            $contract = new Contract((int) $rij["rennerId"], (int) $rij["ploegId"], $rij["startdatum"], $rij["einddatum"]);
            array_push($contracten, $contract);
        }
        return $contracten;
    }
}