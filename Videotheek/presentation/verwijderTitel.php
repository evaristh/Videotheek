<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Videotheek - </title>
</head>

<body>
    <h1>
        Verwijder titel
    </h1>
    <form action="index.php?actie=verwijdertitel" method="post">
        <label id="verwijdertitel">Titel:</label>
        <select name="titelId">
            <?php
            foreach ($titellijst as $titel) {
            ?>
                <option value="<?php print($titel->getTitelId()); ?>">
                    <?php print($titel->getTitel()); ?>
                </option>
            <?php
            }
            ?>
        </select><br>
        <input type="submit" value="Verwijder titel">
    </form>
    <p>
        <a href="index.php">Hoofdmenu</a>
    </p>
</body>

</html>