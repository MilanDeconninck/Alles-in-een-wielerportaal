<?php

declare(strict_types=1);

namespace Business;

use Data\WedstrijdtypeDAO;
use Entities\Wedstrijdtype;
use Exceptions\TypeBestaatNietException;

class WedstrijdtypeService
{
    private $wedstrijdtypeDAO;
    public function __construct()
    {
        $this->wedstrijdtypeDAO = new WedstrijdtypeDAO();
    }

    public function getTypeById(int $id)
    {
        $typeInfo = $this->wedstrijdtypeDAO->getTypeById($id);
        if (empty($typeInfo)) {
            throw new TypeBestaatNietException();
        }
        $type = new Wedstrijdtype((int) $typeInfo["id"], $typeInfo["type"], $typeInfo["rennerType"]);
        return $type;
    }
}