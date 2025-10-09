<?php

declare(strict_types=1);

require_once("header.php");

?>

<h1>Transfer</h1>
<form action="wielrennerZoeken.php?action=transfer" method="post">
    <table>
        <tbody>
            <tr>
                <td>Renner</td>
                <td>
                    <?php print($wielrenner->getVoornaam() . " " . $wielrenner->getFamilienaam()); ?>
                </td>
            </tr>
            <tr>
                <td>Contractjaar:</td>
                <td>
                    <?php print($jaar);?>
                </td>
            </tr>
            <tr>
                <td>Ploeg:</td>
                <td>
                    <select name="ploeg" required>
                        <?php
                        foreach($ploegen as $ploeg) {
                            ?>
                            <option value="<?php print($ploeg->getId()) ?>"><?php print($ploeg->getNaam()); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Transfer uitvoeren" name="transfer">
                </td>
            </tr>
        </tbody>
    </table>
</form>

</body>

</html>