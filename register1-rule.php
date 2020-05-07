<?php 
    $err='';

    if(isset($_SESSION['err'])){
        $err=$_SESSION['err'];
        unset($_SESSION['err']);
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require 'conn.php';

        $result = $db->query("SELECT p.u_email FROM pencari p WHERE p.u_email='{$_POST['email']}'")->fetch();

        if(empty($result)){
           $db->query("INSERT INTO `pencari` (`u_username`, `u_email`, `u_password`) VALUES ('{$_POST['nama']}', '{$_POST['email']}', MD5('{$_POST['pass']}'))");
           //$db->query("INSERT INTO `detail_orang` (`mail`, `depan`, `belakang`) VALUES ('{$_POST['mail']}', '{$_POST['front']}', '{$_POST['back']}')");

           header("Location: login.php");
        }
        else{
            $_SESSION['err']= 1;
        }

    } 
?>