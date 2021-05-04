<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Videotheek - <?php print("$koptekst"); ?></title>
</head>

<body>
    <h1>
        <?php print("$koptekst"); ?>
    </h1>
    <form action="index.php?actie=<?php print("$formnaam"); ?>" method="post">
        <label id="dvd">Nummer:</label>
        <select name="nummerId">
            <?php
            foreach ($dvdlijst as $dvd) {
            ?>
                <option value="<?php print($dvd->getNummerId()); ?>">
                    <?php print($dvd->getNummerId()); ?>
                </option>
            <?php
            }
            ?>
        </select><br>
        <input type="submit" value="<?php print("$submitwaarde"); ?>">
    </form>
    <p>
        <a href="index.php">Hoofdmenu</a>
    </p>
</body>

</html>