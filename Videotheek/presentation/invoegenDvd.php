<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Videotheek - </title>
</head>

<body>
    <h1>
        Invoegen DVD
    </h1>
    <form action="index.php?actie=invoegendvd" method="post">
        <label id="invoegdvdtitel">Titel:</label>
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
        <label id="invoegdvdnr">Nummer:</label>
        <input type="number" name="nummer"><br>
        <label id="invoegdvdaanwezig">Aanwezig:</label>
        <input type="checkbox" name="aanwezig" checked="checked"><br>
        <input type="submit" value="Voeg DVD toe">
    </form>
    <p>
        <a href="index.php">Hoofdmenu</a>
    </p>
</body>

</html>