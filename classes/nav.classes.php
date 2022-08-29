<?php

class Nav extends DB 
{
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
}
