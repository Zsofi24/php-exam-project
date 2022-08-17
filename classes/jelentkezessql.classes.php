<?php

class JelentkezesSql extends DB 
{
    public function selectNev() 
    {
        $conn = $this->getConnect();
        $sql = "SELECT nev FROM turak";
        $stmt = $this->prepareOne($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($nev);
            while ($stmt->fetch()) {
                $result[]= $nev;
            }
            return $result;
        }
    }
}