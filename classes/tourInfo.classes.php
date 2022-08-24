<?php

class TourInfo extends DB 
{

    public function selectNev($id) 
    {
        $conn = $this->getConnect();
        $sql = "SELECT nev FROM turak WHERE id = $id";
        $stmt = $this->prepareOne($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($nev);
            while ($stmt->fetch()) {
                $result= $nev;
            }
            return $result;
        }
    }

    public function selectLeiras($id) 
    {
        $conn = $this->getConnect();
        $sql = "SELECT tura_leirasok.leiras
        FROM turak
        LEFT JOIN tura_leirasok ON turak.tura_leirasok_id = tura_leirasok.id
        WHERE turak.id = $id";
        $stmt = $this->prepareOne($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($leiras);
            while ($stmt->fetch()) {
                $result= $leiras;
            }
            return $result;
        }
    }

    public function selectKep($id) 
    {
        $conn = $this->getConnect();
        $sql = "SELECT tura_kepek.kep_nev, tura_kepek.kep_cim
        FROM turak 
        LEFT JOIN tura_kepek ON turak.tura_kepek_id = tura_kepek.id
        where turak.id = $id";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($kepnev, $kepcim);
            while ($stmt->fetch()) {
                $result= [$kepnev, $kepcim];
            }
            return $result;
        }
    }

    public function selectCimke($id) 
    {
        $conn = $this->getConnect();
        $sql = "SELECT tura_cimkek.cimke_nev
        FROM turak
        left JOIN cimke_has_leiras ON turak.tura_leirasok_id = cimke_has_leiras.tura_leirasok_id
        LEFT JOIN tura_cimkek ON cimke_has_leiras.cimkek_id = tura_cimkek.id
        WHERE turak.id = $id";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($cimkek);
            while ($stmt->fetch()) {
                $result[]= $cimkek;
            }
            return $result;
        }
    }

    public function selectLokacio($id) 
    {
        $conn = $this->getConnect();
        $sql = "SELECT tura_helyszinek.lokacio FROM turak
        LEFT JOIN tura_helyszinek ON turak.tura_helyszinek_id = tura_helyszinek.id
        WHERE turak.id = $id";
        $stmt = $this->prepareOne($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($lokacio);
            while ($stmt->fetch()) {
                $result= $lokacio;
            }
            return $result;
        }
    }

    public function selectIdoHossz($id)
    {
        $conn = $this->getConnect();
        $sql = "SELECT turak.teljesitesi_ido, turak.tura_hossz
        FROM turak
        WHERE turak.id = $id";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($ido, $hossz);
            while ($stmt->fetch()) {
                $result= ['ido'=>$ido, 'hossz'=>$hossz];
            }
            return $result;
        }
    }

    public function selectSzintTipus($id)
    {
        $conn = $this->getConnect();
        $sql = "SELECT tura_szintek.tura_szintek, tura_tipusok.tura_tipus
        FROM turak
        left JOIN tura_szintek ON turak.tura_szintek_id = tura_szintek.id
        LEFT JOIN tura_tipusok ON turak.tura_tipusok_id = tura_tipusok.id
        WHERE turak.id = $id";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($szint, $tipus);
            while ($stmt->fetch()) {
                $result= ['szint'=>$szint, 'tipus'=>$tipus];
            }
            return $result;
        }
    }





    


}