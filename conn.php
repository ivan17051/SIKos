<?php
    $user = 'root';
    $pass = '';
    try{
        $db = new PDO('mysql:host=localhost;dbname=sikos', $user, $pass);
    }
    catch(PDOException $e){
        print "Error:" . $e->getMessage() . "\n";
        die();
    }
    
?>
