<?php
class Pet {
    private $_animal;
    private $_color;

    function __construct($animal = "Dog", $color = "Brown")
    {
        $this->_animal = $animal;
        $this->_color = $color;
    }
}
