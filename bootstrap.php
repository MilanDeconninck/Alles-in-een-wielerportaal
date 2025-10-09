<?php

declare(strict_types=1);

spl_autoload_register();

require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);