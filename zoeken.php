<?php

declare(strict_types=1);
use Business\FietsmerkService;

session_start();

spl_autoload_register();

require_once("bootstrap.php");
require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Business\WielrennerService;
use Business\WedstrijdtypeService;
use Business\PlaatsService;
use Business\ContractService;
use Business\PloegService;
use Business\DeelnemerService;
use Business\WedstrijdService;
use Exceptions\PlaatsBestaatNietException;
use Exceptions\PloegBestaatNietException;
use Exceptions\RennerBestaatNietException;
use Exceptions\TypeBestaatNietException;
use Exceptions\WedstrijdBestaatNietException;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);

$wielrennerSvc = new WielrennerService();
$wedstrijdtypeSvc = new WedstrijdtypeService();
$plaatsSvc = new PlaatsService();
$contractSvc = new ContractService();
$ploegSvc = new PloegService();
$deelnemerSvc = new DeelnemerService();
$wedstrijdSvc = new WedstrijdService();
$fietsmerkSvc = new FietsmerkService();

$error = "";

if (isset($_POST["input"])) {
    $zoekterm = $_POST["input"];
    $rennerForId = $wielrennerSvc->getIdFromFullName($zoekterm);
    if (!$rennerForId) {
        $zoekenSoort = "ploeg";
    } else {
        $zoekenSoort = "renner";
        $id = $rennerForId->getId();
        $_SESSION["id"] = $id;
    }
}

if ($zoekenSoort == "renner") {
    if (isset($_SESSION["id"])) {
        $sessionId = $_SESSION["id"];
        if (!isset($_SESSION["gebruiker"]) || $_SESSION["gebruiker"] == "bezoeker") {
            header("Location: login.php");
        } elseif ($_SESSION["gebruiker"] == "gebruiker" || $_SESSION["gebruiker"] == "admin") {
            if (isset($_POST["input"])) {
                $startdatum = date("Y") + 1 . "-01-01";
                $einddatum = date("Y") + 1 . "12-31";
                $reedsContract = $contractSvc->contractCheck($sessionId, $startdatum);
                if (isset($_GET["action"]) && $_GET["action"] == "transfer") {
                    $nieuwePloeg = (int) $_POST["ploeg"];
                    if ($reedsContract) {
                        $contractSvc->transferRenner($nieuwePloeg, $sessionId, $startdatum);
                    } else {
                        $contractSvc->contractToevoegen($sessionId, $nieuwePloeg, $startdatum, $einddatum);
                    }
                }
                if (isset($_GET["action"]) && $_GET["action"] == "pensioen") {
                    $contractSvc->pensioen($sessionId, $startdatum);
                }

                if ($error == "") {
                    try {
                        $wielrenner = $wielrennerSvc->getWielrennerById($sessionId);
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
                        $land = $plaatsInfo->getLand();
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
                    } catch (RennerBestaatNietException $e) {
                        $error .= "Deze renner bestaat niet!";
                    } catch (TypeBestaatNietException $e) {
                        $error .= "Type bestaat niet!";
                    } catch (WedstrijdBestaatNietException $e) {
                        $error .= "Wedstrijd bestaat niet!";
                    } catch (PloegBestaatNietException $e) {
                        $error .= "Ploeg bestaat niet!";
                    } catch (PlaatsBestaatNietException $e) {
                        $error .= "Plaats bestaat niet!";
                    }
                }
            }
        }
    } else {
        header("Location: main.php");
    }

    print $twig->render("wielrenner.twig", array(
        "error" => $error,
        "naam" => $naam,
        "leeftijd" => $leeftijd,
        "geboortedatum" => $geboortedatum,
        "plaats" => $plaats,
        "gebruikersession" => $_SESSION["gebruiker"],
        "deelnamesRenner" => $deelnamesRenner,
        "carriere" => $carriere,
        "type" => $type,
        "land" => $land
    ));
}

if ($zoekenSoort == "ploeg") {
    $ploegInfo = $ploegSvc->getPloegByNaam($zoekterm);
    $naam = $ploegInfo->getNaam();
    $plaatsId = $ploegInfo->getPlaatsId();
    $plaatsInfo = $plaatsSvc->getPlaatsById($plaatsId);
    $plaats = $plaatsInfo->getStad();
    $land = $plaatsInfo->getLand();
    $fietsmerkId = $ploegInfo->getFietsmerkId();
    $fietsmerkInfo = $fietsmerkSvc->getMerkById($fietsmerkId);
    $fietsmerk = $fietsmerkInfo->getNaam();
    $ploegId = $ploegInfo->getId();
    $huidigeStartdatum = date("Y") + 1 . "-01-01";
    $contractenHuidig = $contractSvc->getContractenByPloegAndYear($ploegId, $huidigeStartdatum);
    $renners = array();
    foreach ($contractenHuidig as $contract) {
        $rennerId = $contract->getRennerId();
        $rennerInfo = $wielrennerSvc->getWielrennerById($rennerId);
        $voornaam = $rennerInfo->getVoornaam();
        $familienaam = $rennerInfo->getFamilienaam();
        $typeId = $rennerInfo->getTypeId();
        $typeInfo = $wedstrijdtypeSvc->getTypeById($typeId);
        $type = $typeInfo->getRennerType();
        $renner = $voornaam . " " . $familienaam . " (" . $type . ")";
        array_push($renners, $renner);
    }
    $deelnames = $deelnemerSvc->getDeelnamesByPloegId($ploegId);
    $wedstrijden = array();
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
        array_push($wedstrijden, $wedstrijd);
    }


    print $twig->render("ploeg.twig", array(
        "naam" => $naam,
        "plaats" => $plaats,
        "land" => $land,
        "merk" => $fietsmerk,
        "renners" => $renners,
        "wedstrijden" => $wedstrijden,
        "gebruikersession" => $_SESSION["gebruiker"]
    ));
}