<?php

require_once 'business/dvdService.php';
require_once 'business/titelService.php';
require_once 'exceptions/exceptions.php';
session_start();

if (isset($_GET["actie"])) {
    $actie = $_GET["actie"];
    switch ($actie) {
        case "overzicht":
            $dvdserv = new dvdService();
            $overzichtlijst = $dvdserv->getOverzicht();
            $titel = "Overzicht";
            include_once 'presentation/overzicht.php';
            break;
        case "zoekdvdopnummer":
            if (isset($_POST["nummer"])) {
                $nummerId = $_POST["nummer"];
                $dvdserv = new dvdService();
                try {
                    $overzichtlijst = $dvdserv->getOverzichtByDVD($nummerId);
                    $titel = "Zoek DVD op nummer";
                    include_once 'presentation/overzicht.php';
                } catch (GeenDVDgevonden $ex) {
                    $error = "Geen DVD's gevonden.";
                    $_SESSION["error"] = $error;
                    header("location: index.php");
                }
            } else {
                include_once 'presentation/zoekdvdopnummer.php';
            }
            break;
        case "invoegentitel":
            if (isset($_POST["titel"])) {
                $titel = $_POST["titel"];
                $titelserv = new titelService();
                try {
                    $titelserv->NieuweTitel($titel);
                    $uitgevoerd = "Titel: $titel succesvol toegevoegd.";
                    $_SESSION["uitgevoerd"] = $uitgevoerd;
                } catch (TitelBestaat $ex) {
                    $error = "Titel bestaat reeds.";
                    $_SESSION["error"] = $error;
                }
                header("location: index.php");
            } else {
                include_once 'presentation/invoegenTitel.php';
            }
            break;
        case "invoegendvd":
            if (isset($_POST["titelId"])) {
                $titelId = $_POST["titelId"];
                $nummerId = $_POST["nummer"];
                $aanwezig = $_POST["aanwezig"];
                if ($aanwezig == "on") {
                    $aanwezig = 1;
                } else {
                    $aanwezig = 0;
                }
                $titelserv = new titelService();
                $titel = $titelserv->getTitelById($titelId);
                $dvdserv = new dvdService();
                try {
                    $dvdserv->NieuweDVD($nummerId, $titel, $aanwezig);
                    $uitgevoerd = "DVD succesvol toegevoegd.";
                    $_SESSION["uitgevoerd"] = $uitgevoerd;
                } catch (DvdNummerBestaat $ex) {
                    $error = "DVD-nummer bestaat reeds.";
                    $_SESSION["error"] = $error;
                }
                header("location: index.php");
            } else {
                $titelserv = new titelService();
                $titellijst = $titelserv->LijstTitels();
                include_once 'presentation/invoegenDvd.php';
            }
            break;
        case "verwijdertitel":
            if (isset($_POST["titelId"])) {
                $titelId = $_POST["titelId"];
                $titelserv = new titelService();
                $titelserv->VerwijderTitel($titelId);
                $uitgevoerd = "Titel is verwijderd uit de database.";
                $_SESSION["uitgevoerd"] = $uitgevoerd;
                header("location: index.php");
            } else {
                $titelserv = new titelService();
                $titellijst = $titelserv->LijstTitels();
                include_once 'presentation/verwijderTitel.php';
            }
            break;
        case "verwijderdvd":
            if (isset($_POST["nummerId"])) {
                $dvdId = $_POST["nummerId"];
                $dvdserv = new dvdService();
                $dvd = $dvdserv->getDVD($dvdId);
                $dvdserv->VerwijderDVD($dvd);
                $uitgevoerd = "DVD $dvdId is verwijderd.";
                $_SESSION["uitgevoerd"] = $uitgevoerd;
                header("location: index.php");
            } else {
                $dvdserv = new dvdService();
                $dvdlijst = $dvdserv->LijstDVDs();
                $koptekst = "Verwijder DVD";
                $submitwaarde = "Verwijder DVD";
                $formnaam = "verwijderdvd";
                include_once 'presentation/dvd.php';
            }
            break;
        case "huurdvd":
            if (isset($_POST["nummerId"])) {
                $nummerId = $_POST["nummerId"];
                $dvdserv = new dvdService();
                $dvdserv->HuurDVD($nummerId);
                $uitgevoerd = "DVD $nummerId is uitgeleend.";
                $_SESSION["uitgevoerd"] = $uitgevoerd;
                header("location: index.php");
            } else {
                $dvdserv = new dvdService();
                $dvdlijst = $dvdserv->LijstAanwezigeDVDs();
                $koptekst = "Huur DVD";
                $submitwaarde = "Huur DVD";
                $formnaam = "huurdvd";
                include_once 'presentation/dvd.php';
            }
            break;
        case "brengterugdvd":
            if (isset($_POST["nummerId"])) {
                $nummerId = $_POST["nummerId"];
                $dvdserv = new dvdService();
                $dvdserv->BrengterugDVD($nummerId);
                $uitgevoerd = "DVD $nummerId is terug gebracht.";
                $_SESSION["uitgevoerd"] = $uitgevoerd;
                header("location: index.php");
            } else {
                $dvdserv = new dvdService();
                $dvdlijst = $dvdserv->LijstNietAanwezigeDVDs();
                $koptekst = "Terugbrengen DVD";
                $submitwaarde = "Terugbrengen DVD";
                $formnaam = "brengterugdvd";
                include_once 'presentation/dvd.php';
            }
            break;
        default:
            header("location: index.php");
            break;
    }
} else {
    if (isset($_SESSION["uitgevoerd"])) {
        $uitgevoerd = $_SESSION["uitgevoerd"];
        unset($_SESSION["uitgevoerd"]);
    }
    if (isset($_SESSION["error"])) {
        $error = $_SESSION["error"];
        unset($_SESSION["error"]);
    }
    include_once 'presentation/index.php';
}
