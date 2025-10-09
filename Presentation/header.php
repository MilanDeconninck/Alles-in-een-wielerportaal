<?php

declare(strict_types=1);
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Milan's wielerhoekje</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="Presentation/wielrennen.css">
    <link rel="icon" href="Img/fietsIcoon.png">
</head>

<body>
    <?php if ($_SESSION["gebruiker"] == "bezoeker") {
        ?>
        <a href="login.php">Login</a>
        <a href="register.php">Registreren</a>
        <?php
    } else {
        ?>
        <a href="main.php">Opzoeken</a>
        <a href="logout.php">Logout</a>
        <?php
    }
    if (isset($_SESSION["gebruiker"]) && $_SESSION["gebruiker"] == "admin") {
        ?>
        <a href="gebruiker.php">Gebruikers</a>
        <?php
    }
    ?>