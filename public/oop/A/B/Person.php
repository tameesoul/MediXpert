<?php

namespace A\B; 
use B\Human;
use Info;
define("welcome",'ahmed');
const name = 'ahmed';

function hello()
{
    echo "hello,A";
}
class Person implements Human
{

    use Info;

    const MAlE = 'M';
    const FEMAlE = 'F';

    public function __construct()
    {
     echo __CLASS__ ;
    }
    public $name;
    protected $gender; 
    private $age; 

    public static $country;


    public static function country($country)
    {
        self::$country = $country; 
    }


}