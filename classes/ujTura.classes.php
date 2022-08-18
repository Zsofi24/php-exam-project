<?php

class ujTura extends DB
{
    public function selectTipusok()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, tura_tipus FROM tura_tipusok";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $tipus);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'tipus' => $tipus];
            }
            return $result;
        }
    }

    public function selectSzintek()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, tura_szintek FROM tura_szintek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $szint);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'szint' => $szint];
            }
            return $result;
        }
    }

    public function selectLokaciok()
    {
        $conn = $this->getConnect();
        $sql = "SELECT id, lokacio FROM tura_helyszinek";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($id, $lokacio);
            while ($stmt->fetch()) {
                $result[] = ['id'=> $id, 'lokacio' => $lokacio];
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
}
