<?php

declare(strict_types=1);

session_start();

use Business\WielrennerService;
use Business\WedstrijdtypeService;
use Business\PlaatsService;

require_once("bootstrap.php");

$wielrennerSvc = new WielrennerService();
$wedstrijdtypeSvc = new WedstrijdtypeService();
$plaatsSvc = new PlaatsService();

if (isset($_POST["zoeken"])) {
    $id = (int) $_SESSION["id"];
    $wielrenner = $wielrennerSvc->getWielrennerById($id);
    $naam = $wielrenner->getVoornaam() . " " . $wielrenner->getFamilienaam();
    $typeId = (int) $wielrenner->getTypeId();
    $typeInfo = $wedstrijdtypeSvc->getTypeById($typeId);
    $type = $typeInfo->getRennerType();
    $geboortedatumTable = $wielrenner->getGeboortedatum();
    $geboortedatum = date("d-m-Y", strtotime($geboortedatumTable));
    $geboortejaar = date("Y", strtotime($geboortedatumTable));
    $leeftijd = date("Y") - $geboortejaar;
    $plaatsId = (int) $wielrenner->getPlaatsId();
    $plaatsInfo = $plaatsSvc->getPlaatsById($plaatsId);
    $plaats = $plaatsInfo->getStad();
}

include("Presentation/wielrenner.php");