<?php

declare(strict_types=1);

session_start();

require_once("bootstrap.php");

unset($_SESSION["gebruiker"]);

$error = "";
$_SESSION["gebruiker"] = "bezoeker";
$logout = "U bent succesvol uitgelogd.";

include("Presentation/loginForm.php");