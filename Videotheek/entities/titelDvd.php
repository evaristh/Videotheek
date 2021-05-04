<?php

class TitelDVD
{

    private static $idMap = array();

    private $titelId;
    private $titel;
    private $dvd;
    private $aantalaanwezig;

    private function __construct($titelId, $titel, $dvd, $aantalaanwezig)
    {
        $this->titelId = $titelId;
        $this->titel = $titel;
        $this->dvd = $dvd;
        $this->aantalaanwezig = $aantalaanwezig;
    }

    public static function create($titelId, $titel, $dvd, $aantalaanwezig)
    {
        if (!isset(self::$idMap[$titelId])) {
            self::$idMap[$titelId] = new TitelDVD($titelId, $titel, $dvd, $aantalaanwezig);
        }
        return self::$idMap[$titelId];
    }

    public function getTitelId()
    {
        return $this->titelId;
    }

    public function getTitel()
    {
        return $this->titel;
    }

    public function getDVDs()
    {
        return $this->dvd;
    }

    public function getAantalAanwezig()
    {
        return $this->aantalaanwezig;
    }

    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    public function setDVD($dvd)
    {
        $this->dvd = $dvd;
    }

    public function setAantalAanwezig($aantalaanwezig)
    {
        $this->aantalaanwezig = $aantalaanwezig;
    }
}
