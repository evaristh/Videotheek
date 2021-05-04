<?php

class Titel
{

    private static $idMap = array();

    private $titelId;
    private $titel;

    private function __construct($titelId, $titel)
    {
        $this->titelId = $titelId;
        $this->titel = $titel;
    }

    public static function create($titelId, $titel)
    {
        if (!isset(self::$idMap[$titelId])) {
            self::$idMap[$titelId] = new Titel($titelId, $titel);
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

    public function setTitel($titel)
    {
        $this->titel = $titel;
    }
}
