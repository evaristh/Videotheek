<?php

require_once 'data/titelDAO.php';

class titelService
{
    public function getTitelById($titelId)
    {
        $titeldao = new titelDAO();
        $titel = $titeldao->getById($titelId);
        return $titel;
    }

    public function LijstTitels()
    {
        $titeldao = new titelDAO();
        $lijst = $titeldao->getAlleTitels();
        return $lijst;
    }

    public function NieuweTitel($titel)
    {
        $titeldao = new titelDAO();
        $nieuwetitel = $titeldao->insert($titel);
        if (isset($nieuwetitel)) {
            return $nieuwetitel;
        } else {
            throw new TitelBestaat;
        }
    }

    public function VerwijderTitel($titelId)
    {
        $titeldao = new titelDAO();
        $titeldao->delete($titelId);
    }
}
