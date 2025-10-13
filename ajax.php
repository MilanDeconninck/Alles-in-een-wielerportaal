<?php

declare(strict_types=1);

session_start();

include("db.php");

if (isset($_POST["search"])) {
    $term = $_POST["search"];

    $query = "select id, voornaam, familienaam from wielrenners where CONCAT(voornaam, ' ', familienaam) like '%" . mysqli_real_escape_string($con, $term) . "%' LIMIT 5";
    $result = mysqli_query($con, $query);

    echo "<ul>";
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = htmlspecialchars($row["voornaam"] . ' ' . $row["familienaam"]);
                echo "<li onclick=\"fill('{$name}')\">" . $name . "</li>";
            }
        } else {
            echo "<li><em>No results found</em></li>";
        }
    }
    echo "</ul>";
}
exit(0);