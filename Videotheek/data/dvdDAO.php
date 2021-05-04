<?php

require_once 'data/dbConfig.php';
require_once 'entities/titel.php';
require_once 'entities/dvd.php';
require_once 'entities/titelDvd.php';

class dvdDAO
{

    public function getAlleDVD()
    {
        $dvdlijst = array();

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT nummerId, dvd.titelId as titelId, titel, aanwezig FROM dvd, titel WHERE titel.titelId = dvd.titelId ORDER BY titel.titelId";

        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $titel = Titel::create($rij["titelId"], $rij["titel"]);
            $dvd = DVD::create($rij["nummerId"], $titel, $rij["aanwezig"]);
            array_push($dvdlijst, $dvd);
        }

        $dbh = null;
        return $dvdlijst;
    }

    public function getOverzicht()
    {
        $overzichtlijst = array();
        $dvdlijst = array();

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT titel.titelId, titel, nummerId, aanwezig FROM dvd, titel WHERE titel.titelId = dvd.titelId GROUP BY nummerId ORDER BY titel.titelId, dvd.nummerId";

        $eerste = $dbh->query($sql);
        $eersterij = $eerste->fetch();
        $vorigetitelId = $eersterij["titelId"];
        $vorigetitel = $eersterij["titel"];
        $resultSet = $dbh->query($sql);
        $aantalaanwezig = 0;
        foreach ($resultSet as $rij) {
            $huidigetitelId = $rij["titelId"];
            if ($vorigetitelId <> $huidigetitelId) {
                $titels = TitelDVD::create($vorigetitelId, $vorigetitel, $dvdlijst, $aantalaanwezig);
                array_push($overzichtlijst, $titels);
                $dvdlijst = array();
                $aantalaanwezig = 0;
            }
            $titel = Titel::create($rij["titelId"], $rij["titel"]);
            $dvd = DVD::create($rij["nummerId"], $titel, $rij["aanwezig"]);
            array_push($dvdlijst, $dvd);
            if ($rij["aanwezig"] == 1) {
                $aantalaanwezig++;
            }
            $vorigetitelId = $huidigetitelId;
            $vorigetitel = $rij["titel"];
        }

        $dbh = null;
        return $overzichtlijst;
    }

    public function getOverzichtByDVD($dvd)
    {
        $overzichtlijst = array();
        $dvdlijst = array();
        $titelId = $dvd->getTitel()->getTitelId();

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT titel.titelId, titel, nummerId, aanwezig FROM dvd, titel WHERE titel.titelId = dvd.titelId AND titel.titelId = $titelId GROUP BY nummerId ORDER BY titel.titelId, dvd.nummerId";

        $resultSet = $dbh->prepare($sql);
        $resultSet->execute();
        $aantalrijen = $resultSet->rowCount();
        $aantalaanwezig = 0;
        if ($aantalrijen > 0) {
            foreach ($resultSet as $rij) {
                $titelId = $rij["titelId"];
                $titelnaam = $rij["titel"];
                $titel = Titel::create($rij["titelId"], $rij["titel"]);
                $dvd = DVD::create($rij["nummerId"], $titel, $rij["aanwezig"]);
                array_push($dvdlijst, $dvd);
                if ($rij["aanwezig"] == 1) {
                    $aantalaanwezig++;
                }
            }
            $titels = TitelDVD::create($titelId, $titelnaam, $dvdlijst, $aantalaanwezig);
            array_push($overzichtlijst, $titels);
            $dbh = null;
            return $overzichtlijst;
        } else {
            $dbh = null;
            return null;
        }
    }

    public function getDVDsByTitel($titel)
    {
        $dvdlijst = array();

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT nummerId, aanwezig FROM dvd WHERE titelId = '" . $titel->getTitelId() . "'";

        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $dvd = DVD::create($rij["nummerId"], $titel, $rij["aanwezig"]);
            array_push($dvdlijst, $dvd);
        }

        $dbh = null;
        return $dvdlijst;
    }

    public function getAanwezigeDVDs()
    {
        $dvdlijst = array();

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT nummerId, dvd.titelId as titelId, titel, aanwezig FROM dvd, titel WHERE titel.titelId = dvd.titelId AND aanwezig = 1 ORDER BY titel.titelId";

        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $titel = Titel::create($rij["titelId"], $rij["titel"]);
            $dvd = DVD::create($rij["nummerId"], $titel, $rij["aanwezig"]);
            array_push($dvdlijst, $dvd);
        }

        $dbh = null;
        return $dvdlijst;
    }

    public function getNietAanwezigeDVDs()
    {
        $dvdlijst = array();

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT nummerId, dvd.titelId as titelId, titel, aanwezig FROM dvd, titel WHERE titel.titelId = dvd.titelId AND aanwezig = 0 ORDER BY titel.titelId";

        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $titel = Titel::create($rij["titelId"], $rij["titel"]);
            $dvd = DVD::create($rij["nummerId"], $titel, $rij["aanwezig"]);
            array_push($dvdlijst, $dvd);
        }

        $dbh = null;
        return $dvdlijst;
    }


    public function getById($nummerId)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT titel.titelId as titelId, titel, aanwezig FROM titel, dvd WHERE titel.titelId = dvd.titelId AND nummerId = " . $nummerId;

        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();

        $titel = Titel::create($rij["titelId"], $rij["titel"]);
        $dvd = DVD::create($nummerId, $titel, $rij["aanwezig"]);

        $dbh = null;
        return $dvd;
    }

    public function insert($nummerId, $titelId, $aanwezig)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "INSERT INTO dvd (nummerId, titelId, aanwezig) VALUES ($nummerId, $titelId, $aanwezig)";
        $count = $dbh->exec($sql);
        $dbh = null;
        if ($count <> 0) {
            $titeldao = new titelDAO();
            $titel = $titeldao->getById($titelId);
            $dvd = DVD::create($nummerId, $titel, $aanwezig);

            return $dvd;
        } else {
            return null;
        }
    }

    public function delete($dvd)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "DELETE FROM dvd WHERE nummerId = '" . $dvd->getNummerId() . "'";

        $dbh->exec($sql);

        $dbh = null;
    }

    public function updateAanwezigheid($dvd)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "UPDATE dvd SET aanwezig = b'" . $dvd->getAanwezigheid() . "' WHERE nummerId = " . $dvd->getNummerId();

        $dbh->exec($sql);

        $dbh = null;
    }
}
