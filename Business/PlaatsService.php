<?php
declare(strict_types=1);

namespace Business;

use Data\PlaatsDAO;
use Entities\Plaats;
use Exceptions\PlaatsBestaatNietException;

class PlaatsService
{
    private $plaatsDAO;

    public function __construct()
    {
        $this->plaatsDAO = new PlaatsDAO();
    }

    public function getPlaatsById(int $id)
    {
        $plaatsInfo = $this->plaatsDAO->getPlaatsById($id);
        if (empty($plaatsInfo)) {
            throw new PlaatsBestaatNietException();
        }
        $plaats = new Plaats((int) $plaatsInfo["id"], $plaatsInfo["stad"], $plaatsInfo["land"]);
        return $plaats;
    }
}