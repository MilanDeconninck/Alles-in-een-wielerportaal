<?php

declare(strict_types=1);

session_start();

spl_autoload_register();

require_once("bootstrap.php");
require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Business\GebruikerService;
use Exceptions\GebruikerBestaatAlException;
use Exceptions\OngeldigEmailadresException;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);

$error = "";
$_SESSION["gebruiker"] = "bezoeker";
if (isset($_POST["register"])) {
    $email = "";
    $wachtwoord = "";
    $herhaalWachtwoord = "";

    if (!empty($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        $error .= "Het e-mailadres moet ingevuld worden.";
    }

    if (!empty($_POST["wachtwoord"]) && !empty($_POST["herhaalWachtwoord"])) {
        if ($_POST["wachtwoord"] == $_POST["herhaalWachtwoord"]) {
            $wachtwoord = $_POST["wachtwoord"];
        } else {
            $error .= "Wachtwoorden komen niet overeen, probeer opnieuw.";
        }
    } elseif (empty($_POST["wachtwoord"])) {
        $error .= "Wachtwoord moet ingevuld worden.";
    } else {
        $error .= "Herhaal wachtwoord ter bevestiging.";
    }

    $rechten = "gebruiker";

    if ($error == "") {
        try {
            $gebruiker = new GebruikerService();
            $gebruiker->voegGebruikerToe($email, $wachtwoord, $rechten);
            $_SESSION["gebruiker"] = $rechten;
        } catch (OngeldigEmailadresException $e) {
            $error .= "Het ingevulde e-mailadres is geen geldig e-mailaders.";
        } catch (GebruikerBestaatAlException) {
            $error .= "Er bestaat al een gebruiker met dit e-mailadres";
        }
    }
}

if ($_SESSION["gebruiker"] == "bezoeker") {
    print $twig->render("registerForm.twig", array(
        "error" => $error,
        "gebruikersession" => $_SESSION["gebruiker"]
    ));
} else {
    header("Location: main.php");
    exit(0);
}