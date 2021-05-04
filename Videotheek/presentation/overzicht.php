<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Videotheek - </title>
    <link rel="stylesheet" href="css/videotheek.css" type="text/css">
</head>

<body>
    <h1>
        <?php print("$titel"); ?>
    </h1>
    <table>
        <tr>
            <th>
                Titel
            </th>
            <th>
                Nummer(s)
            </th>
            <th>
                Ex. aanwezig
            </th>
        </tr>
        <?php
        foreach ($overzichtlijst as $rij) {
        ?>
            <tr>
                <td>
                    <?php print($rij->getTitel()); ?>
                </td>
                <td>
                    <?php
                    foreach ($rij->getDVDs() as $dvd) {
                        if ($dvd->getAanwezigheid() == 1) {
                    ?>
                            <div class="aanwezig"><?php print($dvd->getNummerId()); ?></div>
                        <?php
                        } else {
                        ?>
                            <?php print($dvd->getNummerId()); ?>
                    <?php
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php print($rij->getAantalAanwezig()); ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <p>
        <a href="index.php">Hoofdmenu</a>
    </p>
</body>

</html>