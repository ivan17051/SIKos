<?php
    require 'conn.php';
//    unset($_SESSION['logged-in']);
    $err='';

    if(isset($_SESSION['err'])){
        $err = $_SESSION['err'];
        unset($_SESSION['err']);   
    }

    if(isset($_SESSION['logged-in'])){
        header('Location: index.php');
    }
    else if(isset($_POST['submit'])){
        echo "TEST";
        // checkLogin(['anjay@gmail.com', '202cb962ac59075b964b07152d234b70']);
        // checkLogin([$_POST['email'], $db->query("SELECT MD5('{$_POST['pass']}')")->fetch()[0]], $db);
        $hasil = $db->query("SELECT p.* FROM pencari p WHERE p.u_email='{$_POST['email']}' AND p.u_password=MD5('{$_POST['pass']}')")->fetch();
        header('Location: index.php');
        if(!empty($hasil)){
            $_SESSION['logged-in'] = array();
            $_SESSION['logged-in']["user"]= $hasil['u_username'];
            $_SESSION['logged-in']["mail"]= $hasil['u_email'];
            $_SESSION['logged-in']["rights"]= $hasil['u_rights'];
            
            header('Location: index.php');
        }
        else{
            $_SESSION['err'] = 1;
            header('Location: login.php');    
        }
    }
?>
