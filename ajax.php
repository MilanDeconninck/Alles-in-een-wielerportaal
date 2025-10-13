<?php

declare(strict_types=1);

session_start();

include("db.php");

if (isset($_POST["search"])) {
    $term = $_POST["search"];

    $queryWielrenners = "select CONCAT(voornaam, ' ', familienaam) AS naam from wielrenners where CONCAT(voornaam, ' ', familienaam) like '%" . mysqli_real_escape_string($con, $term) . "%' LIMIT 5";
    $queryPloegen = "select naam from ploegen where naam like '%" . mysqli_real_escape_string($con, $term) . "%' LIMIT 5";
    $queryCombined = "($queryWielrenners) UNION ($queryPloegen) LIMIT 10";
    $result = mysqli_query($con, $queryCombined);

    echo "<ul>";
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = htmlspecialchars($row["naam"]);
                echo "<li onclick=\"fill('{$name}')\">" . $name . "</li>";
            }
        } else {
            echo "<li><em>No results found</em></li>";
        }
    }
    echo "</ul>";
}
exit(0);