<?php

class SignupContr extends Signup
{
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;
    public $errors = [];

    public function __construct($uid, $pwd, $pwdRepeat, $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    public function errors()
    {
        if($this->emptyInput() == false) {
            //echo "Empty input"
            $this->addError('empty', 'Kérem, töltsön ki minden mezőt!');
            //header("Location: ../index.php?error=emptyinput");
            //exit();
            //return $this->errors;

        }
        if($this->invalidUid() == false) {
            //echo "invalid username"
            $this->addError('username', 'nem megfelelő felhasználónév');
            //header("Location: ../index.php?error=username");
            //exit();
            //return $this->errors;

        }
        if($this->invalidEmail() == false) {
            //echo "invalid email"
            $this->addError('email', 'nem megfelelő email');

            //header("Location: ../index.php?error=email");
            //exit();
            //return $this->errors;

        }
        if($this->pwdMatch() == false) {
            //echo "Passwords don't match!"
            $this->addError('pwdmatch', 'jelszó nem egyezik');

            // header("Location: ../index.php?error=passwordmatch");
            // exit();
            //return $this->errors;

        }
        if($this->uidTakenCheck() == false) {
            //echo "Username or email taken"
            $this->addError('taken', 'létező email vagy felhasználónév');

            // header("Location: ../index.php?error=useroremailtaken");
            // exit();
            //return $this->errors;

        }

        return $this->errors;
    }

    public function signupUser() {
        if(empty($this->errors)) {
            $this->setUser($this->uid, $this->pwd, $this->email);

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
