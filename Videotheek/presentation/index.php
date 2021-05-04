<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Videotheek - Hoofdmenu</title>
    <link rel="stylesheet" href="css/videotheek.css" type="text/css">
</head>

<body>
    <h1>
        Hoofdmenu
    </h1>
    <?php
    if (isset($uitgevoerd)) {
    ?>
        <div>
            <?php print($uitgevoerd); ?>
        </div>
    <?php
    }
    ?>
    <?php
    if (isset($error)) {
    ?>
        <div>
            <?php print($error); ?>
        </div>
    <?php
    }
    ?>
    <table>
        <ul>
            <li>
                <a href="index.php?actie=overzicht">Overzicht</a>
            </li>
            <li>
                <a href="index.php?actie=zoekdvdopnummer">DVD zoeken op nr.</a>
            </li>
            <li>
                <a href="index.php?actie=invoegentitel">Nieuwe titel Toevoegen</a>
            </li>

            <li>
                <a href="index.php?actie=invoegendvd">Nieuwe DVD toevoegen</a>
            </li>
            <li>
                <a href="index.php?actie=verwijdertitel">Titel verwijderen</a>
            </li>
            <li>
                <a href="index.php?actie=verwijderdvd">DVD verwijderen</a>
            </li>
            <li>
                <a href="index.php?actie=huurdvd">DVD huren</a>
            </li>
            <li>
                <a href="index.php?actie=brengterugdvd">DVD terugbrengen</a>
            </li>
        </ul>
    </table>
</body>

</html>