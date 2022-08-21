<?php

class Login extends Dbh
{
    public $errors = [];

    protected function getUser($uid, $pwd)
    {

        $stmt = $this->connect()->prepare('SELECT admin_pwd FROM admin WHERE admin_uid = ? OR admin_email = ?;');

        if(!$stmt->execute(array($uid, $pwd))) {
            $stmt = null;
            $this->addError('db', '*adatbázis hiba!');
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            $this->addError('wrong', '*nem megfelelő jelszó vagy felhasználónév');
            return $this->errors;
        } else {
            $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $checkPwd = password_verify($pwd, $pwdHashed[0]['admin_pwd']);
        

            if($checkPwd == false) {
                $stmt = null;
                $this->addError('wrong', '*nem megfelelő jelszó vagy felhasználónév');
                return $this->errors;

            } elseif ($checkPwd == true) {
                $stmt = $this->connect()->prepare('SELECT * FROM admin WHERE admin_uid = ? OR admin_email = ? AND admin_pwd = ?;');

                if(!$stmt->execute(array($uid, $uid, $pwd))) {
                    $stmt = null;
                    $this->addError('db', '*adatbázis hiba');
                    return $this->errors;
                }

                if($stmt->rowCount() == 0) {
                    $stmt = null;
                    $this->addError('wrong', '*nem megfelelő jelszó vagy felhasználónév');
                    return $this->errors;
                }
            }           
        }

        $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        session_start();
        $_SESSION["userid"] = $admin[0]["admin_id"];
        $_SESSION["useruid"] =  $admin[0]["admin_uid"];

        $stmt = null;
    }
    
    protected function addError($key, $val){
        $this->errors[$key] = $val;
    }
}
