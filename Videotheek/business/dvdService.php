<?php

require_once 'data/dvdDAO.php';

class dvdService
{

    public function getDVD($nummerId)
    {
        $dvddao = new dvdDAO();
        $dvd = $dvddao->getById($nummerId);
        return $dvd;
    }

    public function LijstDVDs()
    {
        $dvddao = new dvdDAO();
        $lijst = $dvddao->getAlleDVD();
        return $lijst;
    }

    public function getOverzicht()
    {
        $dvddao = new dvdDAO();
        $lijst = $dvddao->getOverzicht();
        return $lijst;
    }

    public function getOverzichtByDVD($nummerId)
    {
        $dvdserv = new dvdService();
        $dvd = $dvdserv->getDVD($nummerId);
        $dvddao = new dvdDAO();
        $lijst = $dvddao->getOverzichtByDVD($dvd);
        if (isset($lijst)) {
            return $lijst;
        } else {
            throw new GeenDVDgevonden;
        }
    }

    public function LijstDVDsFilm($titel)
    {
        $dvddao = new dvdDAO();
        $lijst = $dvddao->getDVDsByTitel($titel);
        return $lijst;
    }

    public function LijstAanwezigeDVDs()
    {
        $dvddao = new dvdDAO();
        $lijst = $dvddao->GetAanwezigeDVDs();
        return $lijst;
    }

    public function LijstNietAanwezigeDVDs()
    {
        $dvddao = new dvdDAO();
        $lijst = $dvddao->getNietAanwezigeDVDs();
        return $lijst;
    }

    public function NieuweDVD($nummerId, $titel, $aanwezig)
    {
        $dvddao = new dvdDAO();
        $titelId = $titel->getTitelId();
        $dvd = $dvddao->insert($nummerId, $titelId, $aanwezig);
        if (!isset($dvd)) {
            throw new DvdNummerBestaat;
        }
    }

    public function VerwijderDVD($dvd)
    {
        $dvddao = new dvdDAO();
        $dvddao->delete($dvd);
    }

    public function HuurDVD($nummerId)
    {
        $dvd = $this->getDVD($nummerId);
        $dvd->setAanwezigheid(0);
        $dvddao = new dvdDAO();
        $dvddao->updateAanwezigheid($dvd);
    }

    public function BrengterugDVD($nummerId)
    {
        $dvd = $this->getDVD($nummerId);
        $dvd->setAanwezigheid(1);
        $dvddao = new dvdDAO();
        $dvddao->updateAanwezigheid($dvd);
    }
}
