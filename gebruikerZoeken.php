<?php

declare(strict_types=1);

session_start();

spl_autoload_register();

require_once("vendor/autoload.php");
require_once("bootstrap.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Business\GebruikerService;
use Exceptions\GebruikerBestaatNietException;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);

$gebruikerSvc = new GebruikerService();
$gebruiker = "";
$error = "";

if ($error == "") {
    try {
        if (isset($_GET["action"]) && $_GET["action"] == "opzoeken") {
            $email = $_POST["email"];
            $gebruiker = $gebruikerSvc->getGebruikerByEmail($email);
        }
    } catch (GebruikerBestaatNietException $e) {
        $error .= "Dit emailadres bestaat nog niet.";
    }
}

print $twig->render("gebruikerOpzoeken.twig", array(
    "error" => $error,
    "gebruiker" => $gebruiker,
    "gebruikersession" => $_SESSION["gebruiker"]
));