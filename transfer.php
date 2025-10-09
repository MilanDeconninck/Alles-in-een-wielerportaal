<?php

declare(strict_types=1);

session_start();

use Business\WielrennerService;
use Business\PloegService;

require_once("bootstrap.php");

$wielrennerSvc = new WielrennerService();
$ploegSvc = new PloegService();

$rennerId = (int) $_SESSION["id"];
$wielrenner = $wielrennerSvc->getWielrennerById($rennerId);
$jaar = date("Y") + 1;
$ploegen = $ploegSvc->getPloegen();

include("Presentation/transferForm.php");