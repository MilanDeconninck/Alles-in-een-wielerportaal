<?php

declare(strict_types=1);

session_start();

spl_autoload_register();

require_once("bootstrap.php");
require_once("vendor/composer/autoload_real.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);

unset($_SESSION["id"]);

if (!isset($_SESSION["gebruiker"])) {
    $_SESSION["gebruiker"] = "bezoeker";
    exit();
}

if($_SESSION["gebruiker"] == "bezoeker") {
    header("Location: login.php");
    exit();
}

print $twig->render("zoekpagina.twig", array(
    "gebruikersession" => $_SESSION["gebruiker"]
));