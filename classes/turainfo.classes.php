<?php

class TuraInfo extends DB 
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



    


}