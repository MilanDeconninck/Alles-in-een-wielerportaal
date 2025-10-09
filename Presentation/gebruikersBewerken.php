<?php

declare(strict_types=1);

require_once("header.php");
?>


<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Rechten</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($gebruikers as $gebruiker) {
            ?>
            <tr>
                <td><?php print ($gebruiker->getId()); ?></td>
                <td><?php print ($gebruiker->getEmailadres()); ?></td>
                <td><?php print ($gebruiker->getRechten()); ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

</body>

</html>