<?php

declare(strict_types=1);

require_once("header.php");
?>

<h1>Registeren</h1>
<?php
if ($error != "") {
    ?>
    <div class="fout"><?php print ($error); ?></div>
    <?php
}
if ($_SESSION["gebruiker"] == "bezoeker") {
    ?>
    <form action="register.php" method="post">
        <table>
            <tbody>
                <tr>
                    <td>E-maildres:</td>
                    <td>
                        <input type="email" name="email" required>
                    </td>
                </tr>
                <tr>
                    <td>Wachtwoord:</td>
                    <td>
                        <input type="password" name="wachtwoord" required>
                    </td>
                </tr>
                <tr>
                    <td>Herhaal wachtwoord:</td>
                    <td>
                        <input type="password" name="herhaalWachtwoord" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Registreren" name="register">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <?php
}
?>
</body>

</html>