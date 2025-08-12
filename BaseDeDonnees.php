<?php 

try{
    $bd=new PDO ('mysql:host=localhost;dbname=inpt_sm;charset=utf8;','root','');
}
catch(Exception $e){
    die ('La Connexion a la base de donnees a echoue'.$e->GetMessages());
}

?>