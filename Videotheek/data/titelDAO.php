<?php

require_once 'data/dbConfig.php';
require_once 'entities/titel.php';

class titelDAO
{

    public function getAlleTitels()
    {
        $lijst = array();

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT titelId, titel FROM titel";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $titel = Titel::create($rij["titelId"], $rij["titel"]);
            array_push($lijst, $titel);
        }

        $dbh = null;
        return $lijst;
    }

    public function getById($id)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT titel FROM titel WHERE titelId = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();

        $titel = Titel::create($id, $rij["titel"]);

        $dbh = null;
        return $titel;
    }

    public function insert($titel)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "INSERT INTO titel (titel) VALUES ('$titel')";
        $dbh->exec($sql);
        $titelId = $dbh->lastInsertId();
        $dbh = null;
        if ($titelId <> 0) {
            $titelent = Titel::create($titelId, $titel);
            return $titelent;
        } else {
            return null;
        }
    }

    public function delete($titelId)
    {
        $sql = "DELETE FROM titel WHERE titelId = " . $titelId;
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}
