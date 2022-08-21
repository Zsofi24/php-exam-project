<?php

class LoginContr extends Login
{
    private $uid;
    private $pwd;


    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    public function errors()
    {
        if($this->emptyInput() == false) {
            
            $this->addError('empty', '*kérem, töltsön ki minden mezőt!');

            return $this->errors;
        } else {
            $this->getUser($this->uid, $this->pwd);
            if(!empty($this->errors)) {

                return $this->errors;
            }       
        }
    }

    private function emptyInput()
    {
        if(empty($this->uid) || empty($this->pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
