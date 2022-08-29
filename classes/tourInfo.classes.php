<?php

class TourInfo extends DB 
{

    public function selectName($id) 
    {
        $conn = $this->getConnect();
        $sql = "SELECT nev FROM turak WHERE id = $id";
        $stmt = $this->prepareOne($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($name);
            while ($stmt->fetch()) {
                $result= $name;
            }
            return $result;
        }
    }

    public function selectDescr($id) 
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
            $stmt->bind_result($descr);
            while ($stmt->fetch()) {
                $result= $descr;
            }
            return $result;
        }
    }

    public function selectImg($id) 
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
            $stmt->bind_result($name, $title);
            while ($stmt->fetch()) {
                $result= [$name, $title];
            }
            return $result;
        }
    }

    public function selectLabel($id) 
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
            $stmt->bind_result($label);
            while ($stmt->fetch()) {
                $result[]= $label;
            }
            return $result;
        }
    }

    public function selectLocation($id) 
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
            $stmt->bind_result($location);
            while ($stmt->fetch()) {
                $result= $location;
            }
            return $result;
        }
    }

    public function selectTimeLength($id)
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
            $stmt->bind_result($time, $length);
            while ($stmt->fetch()) {
                $result= ['ido'=>$time, 'hossz'=>$length];
            }
            return $result;
        }
    }

    public function selectLevelType($id)
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
            $stmt->bind_result($level, $type);
            while ($stmt->fetch()) {
                $result= ['szint'=>$level, 'tipus'=>$type];
            }
            return $result;
        }
    }





    


}