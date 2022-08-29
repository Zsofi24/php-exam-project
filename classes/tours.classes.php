<?php

class Tour extends DB
{
    public function selectBox()
    {
        $conn = $this->getConnect();
        $sql = "SELECT turak.id, turak.nev, tura_kepek.kep_nev, tura_kepek.kep_cim, tura_leirasok.leiras
        FROM turak
        LEFT JOIN tura_kepek ON turak.tura_kepek_id = tura_kepek.id
        LEFT JOIN tura_leirasok ON turak.tura_leirasok_id = tura_leirasok.id;";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $name, $img, $imgName, $descr);
            while ($stmt->fetch()) {
                $box[] =['turaId'=> $id, 'turaNev'=>$name, 'kepNev'=>$img, 'kepCim'=>$imgName, 'leiras'=>$descr];
            }
            return $box;
        }
    }

    public function selectBoxLocation($locationIdd)
    {
        $conn = $this->getConnect();
        $sql = "SELECT turak.id, turak.nev, tura_kepek.kep_nev, tura_kepek.kep_cim, tura_leirasok.leiras,
        tura_helyszinek.id, tura_helyszinek.lokacio
        FROM turak
        LEFT JOIN tura_kepek ON turak.tura_kepek_id = tura_kepek.id
        LEFT JOIN tura_leirasok ON turak.tura_leirasok_id = tura_leirasok.id
        LEFT JOIN tura_helyszinek ON turak.tura_helyszinek_id = tura_helyszinek.id
        WHERE tura_helyszinek.id = '".$locationIdd."'";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $name, $img, $imgName, $descr, $locationId, $locationName);
            while ($stmt->fetch()) {
                $box[] =['turaId'=>$id, 'turaNev'=>$name, 'kepNev'=>$img, 'kepCim'=>$imgName, 'leiras'=>$descr, 'helyszinId'=>$locationId, 'helyszinNev'=>$locationName];
            }
            return $box;
        }
    }

    public function selectLocations()
    {
        $conn = $this->getConnect();
        $sql = "SELECT tura_helyszinek.id, tura_helyszinek.lokacio FROM tura_helyszinek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $name);
            while ($stmt->fetch()) {
                $box[] =['helyszinId'=>$id, 'helyszinNev'=>$name];
            }
            return $box;
        }
    }

    public function cut($string, $num) 
    {
        $cutted_string = mb_substr($string, 0, $num);
        $last_character = mb_substr($cutted_string, -1);

        if(strlen($cutted_string) > $num) {
            if (($last_character !== "!") && ($last_character !== "." ) && ($last_character !=="?")) {
                do {
                    $num++;
                    $cutted_string = (mb_substr($string, 0, $num));
                    $last_character = mb_substr($cutted_string, -1);
                } while (($last_character !== ".") && ($last_character !== "!") && ($last_character !== "?"));               
            }      
        }    
     
        return $cutted_string;
    }
}
