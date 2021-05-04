<?php


$overzichtlijst = array();
foreach ($titels as $film) {
    $titel = $film->getTitel();
    $rij["titel"] = $titel;
    $dvdserv = new dvdService();
    $dvdslijst = $dvdserv->LijstDVDsFilm($film);
    $rij["nummers"] = array();
    $aanwezig = 0;
    foreach ($dvdslijst as $dvd) {
        $item = array();
        $nummer = $dvd->getNummerId();
        $item["nummer"] = $nummer;
        $aanwezigheid = $dvd->getAanwezigheid();
        $item["aanwezig"] = $aanwezigheid;
        array_push($rij["nummers"], $item);
        if ($dvd->getAanwezigheid() == 1) {
            $aanwezig++;
        }
    }
    $rij["aanwezig"] = $aanwezig;
    if (count($rij["nummers"]) > 0) {
        array_push($overzichtlijst, $rij);
    }
}
