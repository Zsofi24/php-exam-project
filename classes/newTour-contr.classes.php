<?php

class NewTourContr extends NewTour
{
    private $name;
    private $type;
    private $level;
    private $text;
    private $imgName;
    private $location;
    private $label;
    private $hours;
    private $length;
    public $errors = [];

    public function __construct($name, $text, $imgName, $hours, $length, $label, $type, $level, $location)
    {
        $this->name = $name;
        $this->text = $text;
        $this->imgName = $imgName;
        $this->hours = $hours;
        $this->length = $length;
        $this->label = $label;
        $this->type = $type;
        $this->level = $level;
        $this->location = $location;
    }

    public function insertNewTours() {
        if(empty($this->errors)) {
            $this->insertNewTour($this->text, $this->kepNev, $this->imgName, $this->name, $this->hours, $this->length, $this->location, $this->level, $this->type, $this->label);
        }
    }

    public function errors()
    {
        if($this->emptyInput() === false) {
            $this->addError('empty', '*kérem, töltsön ki minden mezőt!');
        } else {
            if($this->invalidName() === false) {
                $this->addError('name', '*a túra neve csak betűket és számokat tartalmazhat');
            }
            if($this->invalidImgName() === false) {
                $this->addError('imgName', '*a kép címe csak betűket és számokat tartalmazhat');
            }
            if($this->invalidHours() === false) {
                $this->addError('hours', '*a teljeítési idő számokat tartalmazhat');
            }
            if($this->invalidLength() === false) {
                $this->addError('length', '*a teljeítési idő számokat tartalmazhat');
            }
        }

        return $this->errors;
    }

    private function emptyInput()
    {
        if(empty($this->name) || empty($this->text) || empty($this->imgName) || empty($this->hours) || empty($this->length) || empty($this->label)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidName()
    {
        if(!preg_match(("/[a-zA-Z0-9\-\ \,]*/"), $this->name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidImgName()
    {
        if(!preg_match(("/[a-zA-Z0-9\-\ \,]*/"), $this->imgName)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidHours()
    {
        if(!preg_match(("/^[0-9]*$/"), $this->hours)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidLength()
    {
        if(!preg_match(("/^[0-9]*$/"), $this->length)) {
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