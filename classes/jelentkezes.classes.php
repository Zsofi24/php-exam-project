<?php

class JelentkezesValidator {

    private $data;
    private $errors = [];
    private static $fields = ['vezeteknev', 'keresztnev', 'email', 'telefon', 'fo'];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validateForm()
    {
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
              trigger_error("'$field' is not present in the data");
              return;
            }
          }

        $this->validateVezeteknev();
        $this->validateKeresztnev();
        $this->validateEmail();
        $this->validateTelefon();
        $this->validateFo();
        return $this->errors;
    }

    private function validateVezeteknev()
    {
        $val = trim($this->data['vezeteknev']);

        if(empty($val)){
        $this->addError('vezeteknev', 'Vezetéknév mező nem lehet üres!');
        } else {
        if(!preg_match('/^[a-zA-Z]+$/', $val)){
            $this->addError('vezeteknev','Vezetéknév csak betűket tartalmazhat!');
        }
        }
    }

    private function validateKeresztnev()
    {
        $val = trim($this->data['keresztnev']);

        if(empty($val)){
        $this->addError('keresztnev', 'Kersztnév mező nem lehet üres!');
        } else {
        if(!preg_match('/^[a-zA-Z]+$/', $val)){
            $this->addError('keresztnev','Keresztnév csak betűket tartalmazhat!');
        }
        }
    }

    private function validateEmail()
    {

        $val = trim($this->data['email']);
    
        if(empty($val)){
          $this->addError('email', 'Email mező nem lehet üres!');
        } else {
          if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
            $this->addError('email', 'Valós email címet adjon meg!');
        }
        }
    }

    private function validateTelefon()
    {

        $val = trim($this->data['telefon']);
    
        if(empty($val)){
          $this->addError('telefon', 'Telefon mező nem lehet üres!');
        } else {
            if(!preg_match('/((?:\+?3|0)6)(?:-|\()?(\d{1,2})(?:-|\))?(\d{3})-?(\d{3,4})/', $val)){
            $this->addError('telefon', 'Helyes formátumban adja meg!');
        }
        }
    }

    private function validateFo()
    {

        $val = trim($this->data['fo']);
    
        if(empty($val)){
          $this->addError('fo', 'Fő mező nem lehet üres!');
        } else {
            if(!preg_match('/^[1-9][0-9]{0,40}$/', $val)){
            $this->addError('fo', 'Helyes formátumban adja meg!');
        }
        }
    }

    private function addError($key, $val){
        $this->errors[$key] = $val;
    }
}
