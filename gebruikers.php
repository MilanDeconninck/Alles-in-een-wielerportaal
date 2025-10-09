<?php

declare(strict_types=1);

session_start();

require_once("bootstrap.php");

use Business\GebruikerService;

$gebruikerSvc = new GebruikerService();
$gebruikers = $gebruikerSvc->getGebruikers();

include("Presentation/gebruikersBewerken.php");