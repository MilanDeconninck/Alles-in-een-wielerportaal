<?php

declare(strict_types=1);

require_once("header.php");
?>
<table class="rennerInfo">
    <tbody>
        <tr>
            <td>
                <img src="Img/profielfoto.jpg" alt="profielfoto <?php print ($naam); ?>">
            </td>
            <td>
                <h1><?php print ($naam); ?></h1>
            </td>
        </tr>
        <tr>
            <td>
                <h2>Specialiteit: <?php print ($type); ?></h2>
                <h3>(<?php print ($leeftijd . " jaar, " . $geboortedatum); ?>) - <?php print ($plaats); ?></h3>
            </td>
            <td>
                <h2>Carrière (<?php if ($_SESSION["gebruiker"] == "admin") {
                    ?>
                        <a href="wielrennerZoeken.php?action=pensioen">Pensioen</a> )
                        <?php
                }
                ?>
                </h2>
                <div>
                    <ul>
                        <?php foreach ($carriere as $jaar) {
                            ?>
                            <li>
                                <?php print ($jaar); ?>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if ($_SESSION["gebruiker"] == "admin") {
                            ?>
                            <li>
                                <a href="transfer.php">Transfer</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <ul>
                    <?php foreach ($deelnamesRenner as $deelname) {
                        ?>
                        <li>
                            <?php print ($deelname); ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
</body>

</html>