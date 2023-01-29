<?php
session_start();
require_once("conn.php");
if(isset($_POST['email']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $md5pass = md5($password);
    
    $query = "SELECT password from users where email='$email'";
    $quer = mysqli_query($con,$query) or die(mysqli_error($con));
    $num = mysqli_affected_rows($con);
    if($num < 1)
    {
        echo 0;
    }
    else
    {
        $data = mysqli_fetch_assoc($quer) or die(mysqli_error($con));
        $got_password = $data['password'];
        
        if($md5pass == $got_password)
        {
                $_SESSION['email'] = $email;
                $query ="SELECT * from users WHERE email='$email'";
                $query2 = mysqli_query($con,$query) or die(mysqli_error($con));
                $query3 = mysqli_fetch_assoc($query2) or die(mysqli_error($con));
                $_SESSION['uid'] = $query3['uid'];
                $_SESSION['username'] = $query3['username'];
             echo 1;
        }
        else
        {
            echo 2;
        }
    }
    
}
?>