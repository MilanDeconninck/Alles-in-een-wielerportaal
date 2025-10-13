<?php

declare(strict_types=1);

session_start();

use Business\WielrennerService;
use Business\WedstrijdtypeService;
use Business\PlaatsService;
use Business\ContractService;
use Business\PloegService;
use Business\DeelnemerService;
use Business\WedstrijdService;

require_once("bootstrap.php");

$wielrennerSvc = new WielrennerService();
$wedstrijdtypeSvc = new WedstrijdtypeService();
$plaatsSvc = new PlaatsService();
$contractSvc = new ContractService();
$ploegSvc = new PloegService();
$deelnemerSvc = new DeelnemerService();
$wedstrijdSvc = new WedstrijdService();

if ($_SESSION["gebruiker"] == "gebruiker" || $_SESSION["gebruiker"] == "admin") {

    $reedsContract = "";

    if (isset($_GET["action"]) && $_GET["action"] == "transfer") {
        $nieuwePloeg = (int) $_POST["ploeg"];
        $rennerId = (int) $_SESSION["id"];
        $startdatum = date("Y") + 1 . "-01-01";
        $einddatum = date("Y") + 1 . "12-31";
        //if statement die checkt of er een contract is voor 2026, indien ja: transferRenner, indien nee: toevoegenContract (service nog aanmaken).
        //Daarna toevoegen extra Exceptions!
        //Daarna mogelijkheden tab Gebruikers toevoegen
        //Eventueel daarna functionaliteiten ploegen toevoegen
        $contractSvc->transferRenner($nieuwePloeg, $rennerId, $startdatum);
    }

    if (isset($_GET["action"]) && $_GET["action"] == "pensioen") {
        $rennerId = (int) $_SESSION["id"];
        $datum = date("Y") + 1 . "-01-01";
        $contractSvc->pensioen($rennerId, $datum);
    }

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
    $rennerId = $wielrenner->getId();
    $contracten = $contractSvc->getContractenByRennerId($rennerId);
    $carriere = array();
    foreach ($contracten as $contract) {
        $ploegInfo = $ploegSvc->getPloegById($contract->getPloegId());
        $ploeg = $ploegInfo->getNaam();
        $jaar = date("Y", strtotime($contract->getStartdatum()));
        $contractPerJaar = $jaar . ": " . $ploeg;
        array_push($carriere, $contractPerJaar);
    }
    $deelnames = $deelnemerSvc->getDeelnamesByRennerId($rennerId);
    $deelnamesRenner = array();
    foreach ($deelnames as $deelname) {
        $wedstrijdId = $deelname->getWedstrijdId();
        $wedstrijdInfo = $wedstrijdSvc->getWedstrijdById($wedstrijdId);
        $wedstrijdNaam = $wedstrijdInfo->getNaam();
        $wedstrijdStart = $wedstrijdInfo->getStartdatum();
        $wedstrijdEind = $wedstrijdInfo->getEinddatum();
        if ($wedstrijdStart == $wedstrijdEind) {
            $wedstrijd = $wedstrijdNaam . " (" . date("d-m-Y", strtotime($wedstrijdStart)) . ")";
        } else {
            $wedstrijd = $wedstrijdNaam . " (" . date("d-m-Y", strtotime($wedstrijdStart)) . " - " . date("d-m-Y", strtotime($wedstrijdEind)) . ")";
        }
        array_push($deelnamesRenner, $wedstrijd);
    }
}


include("Presentation/wielrenner.php");