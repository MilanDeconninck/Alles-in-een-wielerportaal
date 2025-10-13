<?php

declare(strict_types=1);

session_start();

spl_autoload_register();

require_once("bootstrap.php");
require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Business\GebruikerService;
use Exceptions\GebruikerBestaatNietException;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);

$error = "";
$_SESSION["gebruiker"] = "bezoeker";
if (isset($_POST["login"])) {
    $email = "";
    $wachtwoord = "";

    if (!empty($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        $error .= "Het e-mailadres moet ingevuld worden.";
    }

    if (!empty($_POST["wachtwoord"])) {
        $wachtwoord = $_POST["wachtwoord"];
    } else {
        $error .= "Het wachtwoord moet ingevuld worden.";
    }

    if ($error == "") {
        try {
            $gebruiker = new GebruikerService();
            $controleLogin = $gebruiker->controleLogin($email, $wachtwoord);
            if ($controleLogin) {
                $_SESSION["gebruiker"] = $gebruiker->getRechten($email);
            } else {
                $error .= "Het ingevoerde wachtwoord is onjuist.";
            }
        } catch (GebruikerBestaatNietException $e) {
            $error .= "Ongekend e-mailadres.";
        }
    }
}

if ($_SESSION["gebruiker"] == "bezoeker") {
    print $twig->render("loginForm.twig", array(
        "error"=>$error,
        "gebruikersession"=>$_SESSION["gebruiker"]
    ));
} else {
    header("Location: main.php");
    exit(0);
}