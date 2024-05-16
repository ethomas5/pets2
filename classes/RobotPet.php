<?php

class RobotPet extends Pet
{
    private $accessories = array();

    public function getAccessories(): array
    {
        return $this->accessories;
    }

    public function setAccessories(array $accessories): void
    {
        $this->accessories = $accessories;
    }


}