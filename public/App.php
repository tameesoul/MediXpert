<?php 
namespace A\B;
// include __DIR__ .'/oop/A/B/Person.php';
// include __DIR__ .'/oop/B/Person.php';
 //use A\B\Person;
include __DIR__ .'/Autoloader.php';
 use B\Person;
//use function B\hello;
$person3 = new Person;
$person = new Person;
$person2 = new Person;
// hello();

$person->setname('ahmed');
$person2->setname('TAMER');
$person3->setname('ELSAYED');
$person3->setage(20);

var_dump($person , $person2 , $person3);
echo Person::$country = 'EG';
