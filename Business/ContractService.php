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

    public function transferRenner(int $ploegId, int $rennerId, string $startdatum)
    {
        $this->contractDAO->update($rennerId, $ploegId, $startdatum);
    }

    public function pensioen(int $rennerId, string $startdatum)
    {
        $this->contractDAO->delete($rennerId, $startdatum);
    }

    public function contractCheck(int $rennerId, string $startdatum)
    {
        $reedsContract = $this->contractDAO->getContractByRennerAndYear($rennerId, $startdatum);
        return $reedsContract;
    }

    public function contractToevoegen(int $rennerId, int $ploegId, string $startdatum, string $einddatum)
    {
        $this->contractDAO->create($rennerId, $ploegId, $startdatum, $einddatum);
    }

    public function getContractenByPloegAndYear(int $ploegId, string $startdatum)
    {
        $contractenHuidig = array();
        $contractenInfoHuidig = $this->contractDAO->getContractByPloegAndYear($ploegId, $startdatum);
        foreach ($contractenInfoHuidig as $rij) {
            $contract = new Contract((int) $rij["rennerId"], (int) $rij["ploegId"], $rij["startdatum"], $rij["einddatum"]);
            array_push($contractenHuidig, $contract);
        }
        return $contractenHuidig;
    }
}