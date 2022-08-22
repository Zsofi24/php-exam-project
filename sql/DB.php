<?php
require_once 'config.php';

class DB {
    protected $mysql;

    public function __construct()
    {
        if(file_exists('config.php')) {
            require_once('config.php');
        } 
    }

    public function getConnect() 
    {
        if($this->mysql !== NULL) {
            return $this->mysql;
        } else {
            $this->mysql = new mysqli('localhost', 'root','', 'tura');
            return $this->mysql;
        }
    }
    
    protected function close()
    {
        if($this->mysql !== NULL) {
            $this->mysql->close();
        }
    }

    protected function prepare($sql, $types, $data)
    {
        $stmt = $this->mysql->prepare($sql);
        if($types !== "") {
            $stmt->bind_param($types, ...$data);
        }
        return $stmt;
    }

    protected function prepareOne($sql, $types, $data)
    {
        $stmt = $this->mysql->prepare($sql);
        if($types !== "") {
            $stmt->bind_param($types, $data);
        }
        return $stmt;
    }
    // public function selectImg()
    // {
    //     $conn = $this->getConnect();
    //     $sql = "SELECT kep_nev FROM tura_kepek";
    //     $stmt = $this->prepare($sql, "", []);
    //     $stmt->execute();
    //     if ($stmt->error !== "") {
    //         return $stmt->error;
    //     } else {
    //         $stmt->bind_result($name);
    //         while ($stmt->fetch()) {
    //             $img[] = $name;
    //         }
    //         return $img;
    //     }
    // }

    // public function insertJelentkezes($postArray, $date)
    // {
    //     $fieldArray = ['vezeteknev', 'keresztnev', 'email', 'telefonszam', 'tura_neve', 'fo', 'jelentkezes', 'jelentkezes_datuma'];
    //     $mysql = $this->getConnect();
    //     $types = "sssiiiss";
    //     foreach ($postArray as $key => $value) {
    //         $params[] = $value;
    //     }
    //         $params[] = $date;
    //          $insert = "INSERT INTO tura_jelentkezes ($fieldArray[0], $fieldArray[1], $fieldArray[2], $fieldArray[3], $fieldArray[4], $fieldArray[5], $fieldArray[6], $fieldArray[7] ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
    //          $statement = $this->prepare($insert, $types, $params);
    //          $statement->execute();
        
    //     $this->close();
    // }

    // public function selectTuraNev()
    // {
    //     $conn = $this->getConnect();
    //     $sql = "SELECT nev FROM turak";
    //     $stmt = $this->prepare($sql, "", []);
    //     $stmt->execute();
    //     if ($stmt->error !== "") {
    //         return $stmt->error;
    //     } else {
    //         $stmt->bind_result($name);
    //         while ($stmt->fetch()) {
    //             $nev[] = $name;
    //         }
    //         return $nev;
    //     }
    // }

    // public function selectBox()
    // {
    //     $conn = $this->getConnect();
    //     $sql = "SELECT turak.id, turak.nev, tura_kepek.kep_nev, tura_kepek.kep_cim, tura_leirasok.leiras
    //     FROM turak
    //     LEFT JOIN tura_kepek ON turak.tura_kepek_id = tura_kepek.id
    //     LEFT JOIN tura_leirasok ON turak.tura_leirasok_id = tura_leirasok.id;";
    //     $stmt = $this->prepare($sql, "", []);
    //     $stmt->execute();
    //     if ($stmt->error !== "") {
    //         return $stmt->error;
    //     } else {
    //         $stmt->bind_result($id, $name, $img, $imgName, $leiras);
    //         while ($stmt->fetch()) {
    //             $box[] =['turaId'=> $id, 'turaNev'=>$name, 'kepNev'=>$img, 'kepCim'=>$imgName, 'leiras'=>$leiras];
    //         }
    //         return $box;
    //     }
    // }

    

    // public function cut($string, $num) 
    // {
    //     $cutted_string = mb_substr($string, 0, $num);
    //     $last_character = mb_substr($cutted_string, -1);

    //     if(strlen($cutted_string) > $num) {
    //         if (($last_character !== "!") && ($last_character !== "." ) && ($last_character !=="?")) {
    //             do {
    //                 $num++;
    //                 $cutted_string = (mb_substr($string, 0, $num));
    //                 $last_character = mb_substr($cutted_string, -1);
    //             } while (($last_character !== ".") && ($last_character !== "!") && ($last_character !== "?"));               
    //         }      
    //     }    
     
    //     return $cutted_string;
    // }
    
}
