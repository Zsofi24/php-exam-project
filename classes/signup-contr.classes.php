<?php

class SignupContr extends Signup
{
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;
    public $errors = [];
    private $date;

    public function __construct($uid, $pwd, $pwdRepeat, $email, $date)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
        $this->date = $date;
    }

    public function errors()
    {
        if($this->emptyInput() == false) {
            $this->addError('empty', '*kérem, töltsön ki minden mezőt!');
        } else {
            if($this->invalidUid() == false) {
                $this->addError('uid', '*a felhasználónév csak betűket és számokat tartalmazhat');
            }

            if($this->invalidEmail() == false) {
                $this->addError('email', '*helytelen e-mail cím');
            }

            if($this->pwdMatch() == false) {
                $this->addError('pwdmatch', '*nem egyező jelszó');
            }

            if($this->uidTakenCheck() == false) {
                $this->addError('taken', '*létező e-mail cím vagy felhasználónév');
            }
        }

        return $this->errors;
    }

    public function signupUser() {
        if(empty($this->errors)) {
            $this->setUser($this->uid, $this->pwd, $this->email, $this->date);
        }
    }

    private function emptyInput()
    {
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUid()
    {
        if(!preg_match(("/^[a-zA-Z0-9]*$/"), $this->uid)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;

    }

    private function invalidEmail()
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;

    }

    private function pwdMatch()
    {
        if($this->pwd !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck()
    {
        if(!$this->checkUser($this->uid, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

     private function addError($key, $val){
         $this->errors[$key] = $val;
     }

}
