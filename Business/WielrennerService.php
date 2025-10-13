<?php

declare(strict_types=1);

namespace Business;

use Data\WielrennerDAO;
use Entities\Wielrenner;
use Exceptions\RennerBestaatNietException;

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
        if (empty($wielrennerInfo)) {
            throw new RennerBestaatNietException();
        }
        $wielrenner = new Wielrenner((int) $wielrennerInfo["id"], $wielrennerInfo["voornaam"], $wielrennerInfo["familienaam"], $wielrennerInfo["geboortedatum"], (int) $wielrennerInfo["typeId"], $wielrennerInfo["plaatsId"]);
        return $wielrenner;
    }

    public function getIdFromFullName(string $naam) {
        $renner = $this->wielrennerDAO->getWielrennerIdByFullName($naam);
        $rennerInfo = new Wielrenner((int) $renner["id"], $renner["voornaam"], $renner["familienaam"], $renner["geboortedatum"], (int) $renner["typeId"], (int) $renner["plaatsId"]);
        return $rennerInfo;
    }
}