<?php 




spl_autoload_register(function($classname) {
    include __DIR__ . '/oop/' . $classname . '.php';
});