<?php

class NewTour extends DB
{
    public function selectTypes()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, tura_tipus FROM tura_tipusok";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $type);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'tipus' => $type];
            }
            return $result;
        }
    }

    public function selectLevels()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, tura_szintek FROM tura_szintek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $level);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'szint' => $level];
            }
            return $result;
        }
    }

    public function selectLocations()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, lokacio FROM tura_helyszinek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $location);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'lokacio' => $location];
            }
            return $result;
        }
    }

    public function selectLabels()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, cimke_nev FROM tura_cimkek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $label);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'cimke' => $label];
            }
            return $result;
        }
    }

    public function insertNewTour($text, $kepNev, $imgName, $name, $hours, $length, $location, $level, $type, $label  )
    {
        $conn = $this->getConnect();
        
        $types1 = "s";
        $params1 = $text;
        $insert1 = "INSERT INTO tura_leirasok (leiras) VALUES (?)";
        $statement1 = $this->prepareOne($insert1, $types1, $params1);
        $statement1->execute();
        $id1 =  $statement1->insert_id;

         $types2 = "ss";
         $params2 =[$kepNev, $imgName];
         $insert2 = "INSERT INTO tura_kepek (kep_nev, kep_cim) VALUES (?, ?)";
         $statement2 = $this->prepare($insert2, $types2 , $params2);
         $statement2->execute();
         $id2 = $statement2->insert_id;

        $types3 = "siiiiiii";
        $params3 = [$name, $hours, $length, $location, $id2 , $level, $type, $id1];
        $insert3 = "INSERT INTO turak (nev, teljesitesi_ido, tura_hossz, tura_helyszinek_id, tura_kepek_id,  tura_szintek_id, tura_tipusok_id, tura_leirasok_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $statement3 = $this->prepare($insert3, $types3, $params3);
        $statement3->execute();

        $types4 = "ii";
        foreach ($label as $value) {
            $params4 = [$value, $id1];
            $insert4 = "INSERT INTO cimke_has_leiras (cimkek_id, tura_leirasok_id) VALUES (?, ?)";
            $statement4 = $this->prepare($insert4, $types4, $params4);
            $statement4->execute();
        }
    }
}
