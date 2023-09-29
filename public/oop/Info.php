<?php
trait Info 
{

    public function setname($name)
    {
        $this->name = $name; 
        return $this; 
    }

    public function setage($age)
    {
        $this->age = $age;
        return $this;
    }
} 