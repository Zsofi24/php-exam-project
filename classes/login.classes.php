<?php

class Login extends Dbh
{
    public $errors = [];

    protected function getUser($uid, $pwd)
    {

        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;');

        if(!$stmt->execute(array($uid, $pwd))) {
            $stmt = null;
            $this->addError('db', 'adatbázis hiba!');
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            $this->addError('notfound', 'jelszó vagy felhasználónév hiba!');
            return $this->errors;
        } else {
            $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $checkPwd = password_verify($pwd, $pwdHashed[0]['users_pwd']);
        

            if($checkPwd == false) {
                $stmt = null;
                $this->addError('wrong', 'nem megfelelő jelszó vagy felhasználónév');
                return $this->errors;

            } elseif ($checkPwd == true) {
                $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;');

                if(!$stmt->execute(array($uid, $uid, $pwd))) {
                    $stmt = null;
                    $this->addError('db', 'adatbázis hiba');
                    return $this->errors;
                }

                if($stmt->rowCount() == 0) {
                    $stmt = null;
                    $this->addError('wrong', 'nem megfelelő jelszó vagy felhasználónév');
                    return $this->errors;
                }
            }           
        }

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        session_start();
        $_SESSION["userid"] = $user[0]["users_id"];
        $_SESSION["useruid"] =  $user[0]["users_uid"];

        $stmt = null;
    }
    
    protected function addError($key, $val){
        $this->errors[$key] = $val;
    }
}
