<?php

declare(strict_types=1);

session_start();

spl_autoload_register();

require_once("bootstrap.php");
require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Business\WielrennerService;
use Business\PloegService;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);

$wielrennerSvc = new WielrennerService();
$ploegSvc = new PloegService();

$rennerId = (int) $_SESSION["id"];
$wielrenner = $wielrennerSvc->getWielrennerById($rennerId);
$jaar = date("Y") + 1;
$ploegen = $ploegSvc->getPloegen();

print $twig->render("transferForm.twig", array(
    "wielrenner" => $wielrenner,
    "jaar" => $jaar,
    "ploegen" => $ploegen
));
