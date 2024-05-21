<?php
class Pet {
    private $_animal;
    private $_color;

    function __construct($animal = "Dog", $color = "Brown")
    {
        $this->_animal = $animal;
        $this->_color = $color;
    }

    public function getAnimal(): string
    {
        return $this->_animal;
    }

    public function getColor(): string
    {
        return $this->_color;
    }
}
