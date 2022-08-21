<?php

class AdminAut extends DB
{
    public function selectAdmin() {
        $conn = $this->getConnect();
        $sql = "SELECT admin_uid FROM admin";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($adminUid);
            while ($stmt->fetch()) {
                $result[]= $adminUid;
            }
            return $result;
        }
    }

}
