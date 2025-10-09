<?php

declare(strict_types=1);

namespace Business;

use Data\PloegDAO;
use Entities\Ploeg;

class PloegService {
    private $ploegDAO;

    public function __construct() {
        $this->ploegDAO = new PloegDAO();
    }

    public function getPloegById(int $id){
        $ploegInfo = $this->ploegDAO->getPloegById($id);
        $ploeg = new Ploeg((int) $ploegInfo["id"], $ploegInfo["naam"], (int) $ploegInfo["plaatsId"], (int) $ploegInfo["fietsmerkId"]);
        return $ploeg;
    }
}