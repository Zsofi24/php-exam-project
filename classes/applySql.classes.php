<?php

class ApplySql extends DB 
{
    public function selectName() 
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, nev FROM turak ORDER BY nev";
        $stmt = $this->prepareOne($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $nev);
            while ($stmt->fetch()) {
                $result[]= [$id, $nev];
            }
            return $result;
        }
    }

    public function insertApply($postArray, $date)
    {
        $fieldArray = ['vezeteknev', 'keresztnev', 'email', 'telefonszam', 'tura_neve', 'fo', 'jelentkezes', 'jelentkezes_datuma'];
        $mysql = $this->getConnect();
        $types = "sssssiss";
        foreach ($postArray as $key => $value) {
            $params[] = $value;
        }
        $params[] = $date;
        $insert = "INSERT INTO tura_jelentkezes ($fieldArray[0], $fieldArray[1], $fieldArray[2], $fieldArray[3], $fieldArray[4], $fieldArray[5], $fieldArray[6], $fieldArray[7]) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->prepare($insert, $types, $params);
        $statement->execute();
        
        $this->close();
    }
}
