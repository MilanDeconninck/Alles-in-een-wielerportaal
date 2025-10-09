<?php

declare(strict_types=1);

require_once("bootstrap.php");

$host = "localhost";
$user = "cursusgebruiker";
$password = "cursuspwd";
$dbname = "wielrennen";

$con = mysqli_connect($host, $user, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Failed to connect to MYSQL: " . mysqli_connect_error());
}