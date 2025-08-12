<?php

namespace MyApp;
use PDO;

class DB{
    function connect(){
        $db = new PDO("mysql:host=localhost; dbname=inpt_sm","root","");
       return $db;
    }
}