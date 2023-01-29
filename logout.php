<?php

/**
 * @author Rajan Jha
 * @copyright 2018
 */
 session_start();

if(isset($_SESSION['email']))
{
    session_unset();
    session_destroy();
    header('Location:index.php');
}
else if(isset($_COOKIE['email']))
{
    setcookie("email", "", time() - 3600);
    header('Location:index.php');
}
else
{
    header('Location:question.php');
    echo "Something Went Wrong.";
}

?>
