<?php

class Tura extends DB
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
            $stmt->bind_result($id, $name, $img, $imgName, $leiras);
            while ($stmt->fetch()) {
                $box[] =['turaId'=> $id, 'turaNev'=>$name, 'kepNev'=>$img, 'kepCim'=>$imgName, 'leiras'=>$leiras];
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
