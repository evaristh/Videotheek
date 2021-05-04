<?php

class DVD
{

    private static $idMap = array();

    private $nummerId;
    private $titel;
    private $aanwezigheid;

    private function __construct($nummerId, $titel, $aanwezigheid)
    {
        $this->nummerId = $nummerId;
        $this->titel = $titel;
        $this->aanwezigheid = $aanwezigheid;
    }

    public static function create($nummerId, $titel, $aanwezigheid)
    {
        if (!isset(self::$idMap[$nummerId])) {
            self::$idMap[$nummerId] = new DVD($nummerId, $titel, $aanwezigheid);
        }
        return self::$idMap[$nummerId];
    }

    public function getNummerId()
    {
        return $this->nummerId;
    }

    public function getTitel()
    {
        return $this->titel;
    }

    public function getAanwezigheid()
    {
        return $this->aanwezigheid;
    }

    public function setNummerId($nummerId)
    {
        $this->nummerId = $nummerId;
    }

    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    public function setAanwezigheid($aanwezigheid)
    {
        $this->aanwezigheid = $aanwezigheid;
    }
}
