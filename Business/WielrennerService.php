<?php

declare(strict_types=1);

namespace Business;

use Data\WielrennerDAO;
use Entities\Wielrenner;

class WielrennerService
{
    private $wielrennerDAO;

    public function __construct()
    {
        $this->wielrennerDAO = new WielrennerDAO();
    }

    public function getWielrennerById(int $id)
    {
        $wielrennerInfo = $this->wielrennerDAO->getWielrennerById($id);
        $wielrenner = new Wielrenner((int) $wielrennerInfo["id"], $wielrennerInfo["voornaam"], $wielrennerInfo["familienaam"], $wielrennerInfo["geboortedatum"], (int) $wielrennerInfo["typeId"], $wielrennerInfo["plaatsId"]);
        return $wielrenner;
    }
}