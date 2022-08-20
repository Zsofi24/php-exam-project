<?php

class turaDelete extends DB
{
    public function deleteData($id)
    {
        $conn = $this->getConnect();

         $sql = "DELETE FROM turak WHERE id = $id";
         $stmt = $this->prepare($sql, "", []);
         $turakId = $stmt->insert_id;
         $stmt->execute();

          $sql2 = "DELETE FROM tura_leirasok WHERE id NOT IN 
         (SELECT tura_leirasok_id FROM turak)";
          $stmt2 = $this->prepare($sql2, "", []);
          $stmt2->execute();

        $sql3 = "DELETE FROM tura_kepek WHERE id NOT IN
          (SELECT tura_kepek_id FROM turak)";
          $stmt3 = $this->prepare($sql3, "", []);
          $stmt3->execute();

        $sql4 = "DELETE FROM cimke_has_leiras WHERE tura_leirasok_id NOT IN
         (SELECT tura_leirasok_id FROM turak)";
         $stmt4 = $this->prepare($sql4, "", []);
         $stmt4->execute();


    }
}