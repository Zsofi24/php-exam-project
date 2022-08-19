<?php

class turaEdit extends DB
{
    public function selectEditData($id) 
    {
        $conn = $this->getConnect();
        $sql = "SELECT turak.id, turak.nev, tura_kepek.kep_nev, tura_kepek.kep_cim, tura_leirasok.leiras,
        turak.teljesitesi_ido, turak.tura_hossz, tura_tipusok.tura_tipus, tura_szintek.tura_szintek, 
        tura_helyszinek.lokacio       
        FROM turak
        LEFT JOIN tura_kepek ON turak.tura_kepek_id = tura_kepek.id
        LEFT JOIN tura_leirasok ON turak.tura_leirasok_id = tura_leirasok.id
        LEFT JOIN tura_tipusok ON turak.tura_tipusok_id = tura_tipusok.id
        LEFT JOIN tura_szintek ON turak.tura_szintek_id = tura_szintek.id
        LEFT JOIN tura_helyszinek ON turak.tura_helyszinek_id = tura_helyszinek.id
        WHERE turak.id = $id";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $name, $img, $imgName, $leiras, $ido, $hossz, $tipus, $szint, $lokacio);
            while ($stmt->fetch()) {
                $result =['id' =>$id, 'turaNev'=>$name, 'kepNev'=>$img, 'kepCim'=>$imgName, 'leiras'=>$leiras, 'ido'=>$ido, 'hossz'=>$hossz, 'tipus'=>$tipus, 'szint'=>$szint, 'lokacio'=>$lokacio];
            }
            return $result;
        }

    }
    public function selectTipusok()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, tura_tipus FROM tura_tipusok";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $tipus);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'tipus' => $tipus];
            }
            return $result;
        }
    }

    public function selectSzintek()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, tura_szintek FROM tura_szintek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $szint);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'szint' => $szint];
            }
            return $result;
        }
    }

    public function selectLokaciok()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, lokacio FROM tura_helyszinek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $lokacio);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'lokacio' => $lokacio];
            }
            return $result;
        }
    }

    public function selectCimkek()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, cimke_nev FROM tura_cimkek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $cimke);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'cimke' => $cimke];
            }
            return $result;
        }
    }
    
    public function selectCimkeID($id) 
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

    public function updateTura(array $postArray, $id)
    {
        $conn = $this->getConnect();
        
        $types1 = "s";
        $params1 = $postArray["leiras"];
        $insert1 = "UPDATE tura_leirasok SET leiras = (?)
        WHERE tura_leirasok.id = 
        (SELECT turak.tura_leirasok_id FROM turak WHERE turak.id = $id)";
        $statement1 = $this->prepareOne($insert1, $types1, $params1);
        $statement1->execute();

        

        if(!empty($_POST['kepNev'])){
            $types2 = "s";
            $params2 = $postArray["kepNev"];
            $insert2 = "UPDATE tura_kepek SET kep_nev = (?) 
            WHERE tura_kepek.id = 
            (SELECT turak.tura_kepek_id from turak where turak.id=$id)";
            $statement2 = $this->prepareOne($insert2, $types2 , $params2);
            $statement2->execute();
        }

        $types5 = "s";
        $params5 = $postArray["kepCim"];
        $insert5 = "UPDATE tura_kepek SET kep_cim =(?) 
        WHERE id = 
        (SELECT turak.tura_kepek_id FROM turak WHERE turak.id=$id)";
        $statement5 = $this->prepareOne($insert5, $types5 , $params5);
        $statement5->execute();


        $types3 = "siiii";
        $params3 = [$postArray["turaNev"], $postArray["teljesitesIdo"], $postArray["turaHossz"], $postArray["turaSzint"], $postArray["turaTipus"]];
        $insert3 = "UPDATE turak  SET nev = (?), teljesitesi_ido = (?), tura_hossz = (?), 
        tura_szintek_id = (?), tura_tipusok_id = (?)
        WHERE id = $id";
        $statement3 = $this->prepare($insert3, $types3, $params3);
        $statement3->execute();

        // $types4 = "ii";
        // foreach ($postArray["cimke"] as $value) {
        //      $params4 = [$value, $id1];
        //      $insert4 = "INSERT INTO cimke_has_leiras (cimkek_id, tura_leirasok_id) VALUES (?, ?)";
        //     $statement4 = $this->prepare($insert4, $types4, $params4);
        //      $statement4->execute();
        //  }
    }
}