<?php


if(isset($_POST['login'])){
    if(empty($_POST['email']) || empty($_POST['pass'])){
        header("location: login.php");
    }
    else{
        $query= "select * from pencari where u_email='".$_POST['email']."' and u_password='".$_POST['pass']."'";
        $result= mysqli_query($con, $query);
        if(mysqli_fetch_assoc($result)){
            $_SESSION['User']=$_POST['u_username'];
            header("location:index.php");
        }
        else{
            header("location:login.php");
        }
    }
}
else {
    echo 'Tidak Bekerja';
}
?>
