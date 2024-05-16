<?php

class StuffedPet extends Pet
{
    private $_size;
    private $_stuffingType;
    private $_material;


    function setSize($size){
        $this->_size = $size;
    }
    function setStuffingType($stuffing){
        $this->_stuffingType = $stuffing;
    }

    function setMaterial($material){
        $this->_material = $material;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @return mixed
     */
    public function getStuffingType()
    {
        return $this->_stuffingType;
    }

    /**
     * @return mixed
     */
    public function getMaterial()
    {
        return $this->_material;
    }



}