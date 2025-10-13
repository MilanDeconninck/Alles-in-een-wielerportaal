<?php

declare(strict_types=1);

session_start();

spl_autoload_register();

require_once("bootstrap.php");
require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);

unset($_SESSION["gebruiker"]);

$error = "";
$_SESSION["gebruiker"] = "bezoeker";
$logout = "U bent succesvol uitgelogd.";

print $twig->render("loginForm.twig", array(
    "error" => $error,
    "gebruikersession" => $_SESSION["gebruiker"]
));