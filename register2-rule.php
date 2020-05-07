<?php 
    $err='';

    if(isset($_SESSION['err'])){
        $err=$_SESSION['err'];
        unset($_SESSION['err']);
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require 'conn.php';

        $result = $db->query("SELECT p.p_email FROM pemilik p WHERE p.p_email='{$_POST['email']}'")->fetch();

        if(empty($result)){
           $db->query("INSERT INTO `pemilik` (`p_username`, `p_namakos`, `p_email`, `p_password`) VALUES ('{$_POST['nama']}','{$_POST['namakos']}', '{$_POST['email']}', MD5('{$_POST['pass']}'))");
           //$db->query("INSERT INTO `detail_orang` (`mail`, `depan`, `belakang`) VALUES ('{$_POST['mail']}', '{$_POST['front']}', '{$_POST['back']}')");

           header("Location: login2.php");
        }
        else{
            $_SESSION['err']= 1;
        }

    } 
?>