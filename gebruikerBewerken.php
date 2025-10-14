<?php

declare(strict_types=1);

session_start();

spl_autoload_register();

require_once("bootstrap.php");
require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Business\GebruikerService;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);

if ($_SESSION["gebruiker"] == "admin") {
    $gebruikerSvc = new GebruikerService();
    $email = $_POST["emailZoek"];
    $rechten = $_POST["rechten"];
    $gebruiker = $gebruikerSvc->getGebruikerByEmail($email);
    $id = (int) $gebruiker->getId();
    $wachtwoord = $gebruiker->getWachtwoord();
    if (isset($_GET["action"]) && $_GET["action"] == "change") {
        $gebruikerSvc->changeRechten($id, $email, $wachtwoord, $rechten);
        header("Location: main.php");
    }
}


