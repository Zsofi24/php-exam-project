<?php
class Crud extends DB
{
    private $header = ['ID', 'túranév', 'országrész', 'képnév', 'leírás'];

    public function getHeader()
    {
        return $this->header;
    }

    public function selectCrudData($from, $count) 
    {
        $conn = $this->getConnect();
        $sql = "SELECT turak.id AS id, turak.nev as turanev, tura_helyszinek.lokacio, tura_kepek.kep_nev as kepnev, tura_leirasok.leiras as leiras
        FROM turak
        LEFT JOIN tura_helyszinek ON turak.tura_helyszinek_id = tura_helyszinek.id
        LEFT JOIN tura_kepek ON turak.tura_kepek_id = tura_kepek.id
        LEFT JOIN tura_leirasok ON turak.tura_leirasok_id = tura_leirasok.id
        LIMIT $from, $count";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $name, $lokacio, $img, $leiras);
            while ($stmt->fetch()) {
                $result[] =['id' =>$id, 'turaNev'=>$name, 'lokacio' => $lokacio, 'kepNev'=>$img,  'leiras'=>$leiras];
            }
            return $result;
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

    public function dataCount()
    {
        $conn = $this->getConnect();
        $sql = "SELECT COUNT(*)
        FROM turak ";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($result);
            $stmt->fetch();
                
            return $result;
        }
        
    }
   
    //átírni, ne itt legyen a html
    public function pager($page, $datacount, $countperpage=10){
        $pagerString = '';
        $pagecount = ceil($datacount/$countperpage);
        for($i = 1; $i<=$pagecount; $i++){
            if($i == $page){
                //jelöli az aktuális oldalt
                $pagerString .= '<a href="#"> _ ' . $i . ' _ </a>';
            }else{
                $pagerString .= '<a href="admin.php?p=' . $i . '">' . $i . '</a>';
            }
        }
        return $pagerString;
    }
    
    public function pageData(int $page, int $count = 8){
        $from = (($page)-1)*$count;
        $data = $this->selectCrudData($from, $count);
        return $data;
    }

}
