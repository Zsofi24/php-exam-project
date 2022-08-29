<?php

class ApplyValidator {

    private $data;
    private $errors = [];
    private static $fields = ['lastname', 'firstname', 'email', 'phone', 'people'];

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

        $this->validateFirstname();
        $this->validateLastname();
        $this->validateEmail();
        $this->validatePhone();
        $this->validatePeople();
        return $this->errors;
    }

    private function validateLastname()
    {
        $val = trim($this->data['lastname']);

        if(empty($val)){
        $this->addError('lastname', 'Kérem, adja meg a vezetéknevét!');
        } else {
        if(!preg_match("/^\p{L}+$/ui", $val)){
            $this->addError('lastname','Vezetéknév csak betűket tartalmazhat!');
        }
        }
    }

    private function validateFirstname()
    {
        $val = trim($this->data['firstname']);

        if(empty($val)){
        $this->addError('firstname', 'Kérem, adja meg a keresztnevét!');
        } else {
        if(!preg_match('/^\p{L}+$/ui', $val)){
            $this->addError('firstname','Keresztnév csak betűket tartalmazhat!');
        }
        }
    }

    private function validateEmail()
    {

        $val = trim($this->data['email']);
    
        if(empty($val)){
          $this->addError('email', 'Kérem, adja meg az e-mail címét!');
        } else {
          if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
            $this->addError('email', 'Valós e-mail címet adjon meg!');
        }
        }
    }

    private function validatePhone()
    {

        $val = trim($this->data['phone']);
    
        if(empty($val)){
          $this->addError('phone', 'Kékrem, adja meg a telefonszámát!');
        } else {
            if(!preg_match('/((?:\+?3|0)6)(?:-|\()?(\d{1,2})(?:-|\))?(\d{3})-?(\d{3,4})/', $val)){
            $this->addError('phone', 'Helyes formátumban adja meg a telefonszámot!');
        }
        }
    }

    private function validatePeople()
    {

        $val = trim($this->data['people']);
    
        if(empty($val)){
          $this->addError('people', 'Kérem, adja meg a jelentkezők létszámát!');
        } else {
            if(!preg_match('/^[1-9][0-9]{0,40}$/', $val)){
            $this->addError('people', 'Helyes formátumban adja meg!');
        }
        }
    }

    private function addError($key, $val){
        $this->errors[$key] = $val;
    }
}
