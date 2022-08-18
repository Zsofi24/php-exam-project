<?php
class Crud extends DB
{
    private $header = ['ID', 'Túranév', 'képnév', 'képcím', 'leírás'];

    public function getHeader()
    {
        return $this->header;
    }

    public function selectCrudData() 
    {
        $conn = $this->getConnect();
        $sql = "SELECT turak.id AS id, turak.nev as turanev, tura_kepek.kep_nev as kepnev, tura_kepek.kep_cim as kepcim, tura_leirasok.leiras as leiras
        FROM turak
        LEFT JOIN tura_kepek ON turak.tura_kepek_id = tura_kepek.id
        LEFT JOIN tura_leirasok ON turak.tura_leirasok_id = tura_leirasok.id";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $name, $img, $imgName, $leiras);
            while ($stmt->fetch()) {
                $result[] =['id' =>$id, 'turaNev'=>$name, 'kepNev'=>$img, 'kepCim'=>$imgName, 'leiras'=>$leiras];
            }
            return $result;
        }
    } 

    public function insertUjTura(array $postArray)
    {
        $fieldArray = ['nev', 'tura_tipus', 'tura_szintek', 'leiras', 'kep_nev', 'kep_cim', 'lokacio', 'cimke_nev', 'teljesitesi_ido', 'tura_hossz'];
        $conn = $this->getConnect();
        
        $types1 = "s";
        $params1 = $postArray["leiras"];
        $insert1 = "INSERT INTO tura_leirasok ($fieldArray[3]) VALUES (?)";
        $statement1 = $this->prepareOne($insert1, $types1, $params1);
        $statement1->execute();
        $id1 =  $statement1->insert_id;

         $types2 = "ss";
         $params2 = [$postArray["kepNev"], $postArray["kepCim"]] ;
         $insert2 = "INSERT INTO tura_kepek ($fieldArray[4], $fieldArray[5]) VALUES (?, ?)";
         $statement2 = $this->prepare($insert2, $types2 , $params2);
         $statement2->execute();
         $id2 = $statement2->insert_id;

        $types3 = "siiiiiii";
        $params3 = [$postArray["turaNev"], $postArray["teljesitesIdo"], $postArray["turaHossz"], $postArray["lokacio"], $id2 , $postArray["turaSzint"], $postArray["turaTipus"], $id1];
        $insert3 = "INSERT INTO turak (nev, teljesitesi_ido, tura_hossz, tura_helyszinek_id, tura_kepek_id,  tura_szintek_id, tura_tipusok_id, tura_leirasok_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $statement3 = $this->prepare($insert3, $types3, $params3);
        $statement3->execute();

        $types4 = "ii";
        foreach ($postArray["cimke"] as $value) {
            $params4 = [$value, $id1];
            $insert4 = "INSERT INTO cimke_has_leiras (cimkek_id, tura_leirasok_id) VALUES (?, ?)";
            $statement4 = $this->prepare($insert4, $types4, $params4);
            $statement4->execute();
        }
    }

    public function cut($string, $num) 
    {
        $cutted_string = mb_substr($string, 0, $num);
        if(!(strlen($cutted_string) === strlen($string))) {
            $cutted_string .= "...";
        }
        
        return $cutted_string;
    }

    public function selectEditData1($id) 
    {
        $conn = $this->getConnect();
        $sql = "SELECT turak.id, turak.nev, tura_kepek.kep_nev, tura_kepek.kep_cim, tura_leirasok.leiras,
        turak.teljesitesi_ido, turak.tura_hossz, tura_tipusok.tura_tipus, tura_szintek.tura_szintek, tura_helyszinek.lokacio       
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
        $sql = "SELECT tura_tipusok.tura_tipus FROM tura_tipusok";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($tipus);
            while ($stmt->fetch()) {
                $result[] = $tipus;
            }
            return $result;
        }
    }

    public function selectSzintek()
    {
        $conn = $this->getConnect();
        $sql = "SELECT tura_szintek FROM tura_szintek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($szint);
            while ($stmt->fetch()) {
                $result[] = $szint;
            }
            return $result;
        }
    }

    public function selectLokaciok()
    {
        $conn = $this->getConnect();
        $sql = "SELECT lokacio FROM tura_helyszinek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($lokacio);
            while ($stmt->fetch()) {
                $result[] = $lokacio;
            }
            return $result;
        }
    }

  



       
    /* óraiból */

    public function getData($conn, int $from, int $count)
    {
        $returnData = [];
        $sql = "SELECT nev FROM tura LIMIT ".$from." , ".$count;
        $result = mysqli_query($conn, $sql);
        if ($result) {
        while($row = mysqli_fetch_assoc($result)){
            $returnData[] = $row;
        }
        } else {
            return false;
        }
        return $returnData;
    }

    function pager($page, $datacount, $countperpage=10){
        $pagerString = '';
        $pagecount = ceil($datacount/$countperpage);
        for($i = 1; $i<=$pagecount; $i++){
            if($i == $page){
                //jelöli az aktuális oldalt
                $pagerString .= '<a href="#"> _ ' . $i . ' _ </a>';
            }else{
                $pagerString .= '<a href="index.php?p=' . $i . '">' . $i . '</a>';
            }
        }
        return $pagerString;
    }
    
    function pageData(int $page, int $count = 10){
        $from = (($page)-1)*$count;
        require_once 'sql/config.php';
        $conn = mysqli_connect($server, $user, $password, $db);
        if (!$conn) {
             die("Connection failed: " . mysqli_connect_error());
        }
        $data = getData($conn, $from, $count);
        mysqli_close($conn);
        return $data;
    }

   /* eddig */
}
