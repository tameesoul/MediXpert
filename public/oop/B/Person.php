<?php
namespace B; 
use A\B\Person as PersonAB;
//define("welcome",'ahmed');
const name = 'ahmed';

function hello()
{
    echo "hello,B";
}
class Person extends PersonAB implements Human
{

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

    use \Info;
    public static function country($country)
    {
       parent::country($country); /// to call a function from the parent class and avoid recursion that the 
        /// function to call itself
       //return  self::$country = $country;  // you can also use static 
       return static::$country = $country;
    }

}


// $person->country('eg');
// $person->country('eg');