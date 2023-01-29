<?php

/**
 * @author Rajan Jha, Ritu Parnu Biswas, Amrit Joshi
 * @copyright 2018
 */
    session_start();
    date_default_timezone_set("Asia/Kolkata");
    require_once("conn.php");
    
    if(isset($_POST['email']))
    {
        //Taking all the value from signup using Ajax post method.
         $name = htmlentities($_POST['fullname']);
         $email = htmlentities($_POST['email']);
         $username = htmlentities($_POST['username']);
         $yearofcourse = htmlentities($_POST['year']);
         $branch = htmlentities($_POST['branch']);
         $password = htmlentities($_POST['password']);
         $password2 = htmlentities($_POST['retypepassword']);
         $contact = htmlentities($_POST['contact']);
         $p = md5($password);
         $ip = $_SERVER['REMOTE_ADDR'];
         
         //Generating the activation key.
         $r = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
         shuffle($r);
         $activation_id = "";
         for($i=0;$i<5;$i++)
         {
            $activation_id .= $r[$i];
         }
                  
         //Getting today's date for date of creation field.
         $date_of_creation = date('Y-m-d');

         //Checking if email already exists.
         $check_email = "select count(*) from users where email='$email'";
         $r = mysqli_query($con,$check_email) or die(mysqli_error($con));
         $yuu = mysqli_fetch_row($r) or die(mysqli_errno($con));
         $e = $yuu[0];
         
         //Checking if contact number already exists.
         $check_contact = "select count(*) from users where contact='$contact'";
         $dg = mysqli_query($con,$check_contact) or die(mysqli_error($con));
         $pp = mysqli_fetch_row($dg) or die(mysqli_errno($con));
         $f = $pp[0];

         //Checking if username exists.
         $check_username = "select count(*) from users where username='$username'";
         $dgd = mysqli_query($con,$check_username) or die(mysqli_error($con));
         $ppp = mysqli_fetch_row($dgd) or die(mysqli_errno($con));
         $m = $ppp[0];

         //Current Time

         $time = time();
         
         
         $sql = "";
         if($name=="" || $email=="" || $password =="" || $password2 == "")
         {
            echo 'PLEASE COMPLETE THE FIELDS BEFORE SUBMISSION.';
         }
         else if(ctype_space($name) || ctype_space($email) || ctype_space($password) || ctype_space($password2))
         {
            echo 'PLEASE COMPLETE THE FIELDS BEFORE SUBMISSION.';
         }
         else if($m > 1)
         {
             echo 'USERNAME HAS ALREADY BEEN TAKEN. PLEASE CHOOSE ANOTHER.';
         }
         else if($e > 1)
         {
            echo 'EMAIL-ID ALREADY IN USE.';
         }
         else if($f > 1)
         {
            echo 'CONTACT NUMBER ALREADY IN USE.';
         }
         else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
         {
           echo 'ENTER A VALID EMAIL.';
         }
         else if(strlen($password) < 6 || strlen($password) > 25)
         {
            echo 'PASSWORD MUST CONTAIN 6-25 CHARACTERS';
         }
         else if($password != $password2)
         {
         echo 'ENTER SAME PASSWORD IN BOTH FIELD';
         }
        else
        {
            $query_insertion = mysqli_query($con,"INSERT INTO users VALUES('', '$name','$username','$email','$p','$yearofcourse','$branch','$contact','$ip','$time','$date_of_creation')") or die(mysqli_error($con));
            
            if($query_insertion)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        
        }
    }


if(isset($_POST['code']))
{
    session_start();
    $code = $_POST['code'];
    $eme = $_SESSION['email'];
    $ro = "select activation_id from users where email='$eme'";
    $hg = mysqli_query($con,$ro) or die(mysqli_error($con));
    $gkl = mysqli_fetch_assoc($hg) or die(mysqli_error($con));
    
    if($gkl['activation_id'] == $code)
    {
        $bn = "update registered_users set activated='1' where email='$eme'";
        if(mysqli_query($con,$bn))
        {
            $_SESSION['activate'] = 1;
            echo 1;
        }
        else
        {
            echo 2;
        }
    }
    else
    {
        echo 0;
    }
}



if(isset($_POST['search']))
{
    $search = htmlentities($_GET['search']);
    $zas = "Select * from queue_relatime where queuename like '%$search%' ORDER BY hits DESC limit 0,10";
    $ert = mysqli_query($con,$zas) or die(mysqli_error($con));
     $n = mysqli_num_rows($ert);
     
     for($i=0;$i<$n;$i++)
     {
        $xwq = mysqli_fetch_assoc($ert) or die(mysqli_error($con));
        echo $xwq['queuename'].'<br>Started @ '.date('h:i A-d-m-y',$xwq['start_time']).' and will end @ '.date('h:i A-d-m-y',$xwq['end_time']).'<hr>';
     }
    
}


?>