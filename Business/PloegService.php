<?php

declare(strict_types=1);

namespace Business;

use Data\PloegDAO;
use Entities\Ploeg;
use Exceptions\PloegBestaatNietException;

class PloegService
{
    private $ploegDAO;

    public function __construct()
    {
        $this->ploegDAO = new PloegDAO();
    }

    public function getPloegById(int $id)
    {
        $ploegInfo = $this->ploegDAO->getPloegById($id);
        if (empty($ploegInfo)) {
            throw new PloegBestaatNietException();
        }
        $ploeg = new Ploeg((int) $ploegInfo["id"], $ploegInfo["naam"], (int) $ploegInfo["plaatsId"], (int) $ploegInfo["fietsmerkId"]);
        return $ploeg;
    }

    public function getPloegen()
    {
        $ploegen = array();
        $ploegenInfo = $this->ploegDAO->getAll();
        foreach ($ploegenInfo as $ploeg) {
            $ploegInfo = new Ploeg((int) $ploeg["id"], $ploeg["naam"], (int) $ploeg["plaatsId"], (int) $ploeg["fietsmerkId"]);
            array_push($ploegen, $ploegInfo);
        }
        return $ploegen;
    }

    public function getPloegByNaam(string $naam) {
                $ploegInfo = $this->ploegDAO->getPloegByNaam($naam);
        if (empty($ploegInfo)) {
            throw new PloegBestaatNietException();
        }
        $ploeg = new Ploeg((int) $ploegInfo["id"], $ploegInfo["naam"], (int) $ploegInfo["plaatsId"], (int) $ploegInfo["fietsmerkId"]);
        return $ploeg;
    }
}