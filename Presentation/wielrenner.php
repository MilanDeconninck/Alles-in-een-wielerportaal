<?php

declare(strict_types=1);

require_once("header.php");
?>
<table class="rennerInfo">
    <tbody>
        <tr>
            <td>
                <img src="Img/profielfoto.jpg" alt="profielfoto <?php print($naam); ?>">
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
                <h2>Carrière</h2>
                <div>
                    <ul>
                        <?php foreach($carriere as $jaar) {
                            ?>
                            <li>
                               <?php print($jaar); ?>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</body>

</html>