<?php

declare(strict_types=1);

require_once("header.php");
?>
<h1>Login</h1>
<?php
if ($error != "") {
    ?>
    <div class="fout"><?php print ($error); ?></div>
    <?php
}
if ($_SESSION["gebruiker"] == "bezoeker") {
    ?>
    <form action="login.php" method="post">
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
                    <td>
                        <input type="submit" value="Inloggen" name="login">
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