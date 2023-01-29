<?php

require_once('conn.php');
session_start();
date_default_timezone_set("Asia/Kolkata");

if(!isset($_SESSION['email']))
{
    header('Location:index.php');
}



if(isset($_POST['question']))
{
    $question = htmlentities($_POST['question']);  // Main question here got through ajax post.
    $questionDesc = $_POST['questiondesc'];
    $tagsField = $_POST['tagsField'];
    $tags = explode(',',$tagsField);  // Question Description.
    $time = time(); // getting current timestamp.
    $email = $_SESSION['email']; //getting session email.

    $uidQuery = "SELECT uid from users where email='$email'"; //fetching user id using session email.
    $uidQuery2 = mysqli_query($con,$uidQuery) or die(mysqli_error($con));
    $uidQuery3 = mysqli_num_rows($uidQuery2) or die(mysqli_error($con));
    $uidQuery4 = mysqli_fetch_assoc($uidQuery2) or die(mysqli_error($con));

    $uid = $uidQuery4['uid']; //here i got the user id.

    $ip = $_SERVER['REMOTE_ADDR']; //getting user ip here. In case of localhost host it will be localhost.
}
else
{
    header('Location:question.php');
}


?>
<!Doctype HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cmr Asks</title>
<link href="https://fonts.googleapis.com/css?family=Pacifico|Bangers|Gloria+Hallelujah" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="jquery-1.11.0.min.js"></script>
<script src="https://cdn.rawgit.com/showdownjs/showdown/1.0.1/dist/showdown.min.js"></script>
<script type="text/javascript" src="question.js"></script>
<link rel="stylesheet" href="index.css" />
<style>
    body
    {
        background: whitesmoke;
    }
</style>
</head>

<body>
<!Doctype HTML>
<html>
<head>
<title>Mnnit Asks</title>
<link href="https://fonts.googleapis.com/css?family=Pacifico|Bangers|Gloria+Hallelujah" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="signup.js"></script>
<script type="text/javascript" src="login.js"></script>
<link rel="stylesheet" href="index.css" />
</head>

<body>

<div id="cover" style="color: white;"></div>

<div id="container">

<div id="header" style="z-index: 100000;">

<div class="form-group" id="searchBox" style="position: absolute;width: 50%;left: 30%;top: 15%;">
    <input type="text" class="form-control" id="searchField"  placeholder="Search..." name="searchField" style="width: 70%;float: left;" />&nbsp;
    <button class="btn btn-primary">Search</button>
</div>

<img src="title.png" width="100" id="titleImage"/> <h3 id="title">mnnitAsks</h3>
<div id="logout">
<?php 

if(isset($_SESSION['email']))
{
    echo $_SESSION['email'].'<br><a href="logout.php">Logout</a> | <a href="#">Contact Us</a>';
}
else
{
    echo '<a href="#" id="loginClick" style="margin-right: 10px;margin-top: 10px;">Login/Signup</a>';
}

?>
</div>
</div>

<div id="cover"></div>

<div id="container">


<div id="questionEditor" style="height: auto;min-height: 10vh;" >
<?php
    if(ctype_space($question) || $question == "")
    {
        $message = "Question field must not be empty.";
        echo '<center><h3>'.$message.'</h3>
            <br>
            <a href="question.php"><button class="btn btn-success">Return to previous page.</button></a>
    </center>'; 
    }
    else
    {
        $insertionQuery = "INSERT into questions VALUES('','$uid','$question','$questionDesc','','','','$time','$ip')";
        $insertionQuery2 = mysqli_query($con,$insertionQuery) or die(mysqli_error($con));

        if($insertionQuery2)
        {
            $sendingQ = "SELECT qid from questions where uid='$uid' ORDER BY qid DESC LIMIT 1";
            $sendingQ2 = mysqli_query($con,$sendingQ) or die(mysqli_error($con));
            $sendingQ3 = mysqli_fetch_assoc($sendingQ2) or die(mysqli_error($con));
            $qid = $sendingQ3['qid'];

            for($k=0;$k<sizeof($tags);$k++)
            {
                $insertionQuery3 = "INSERT INTO question_tags VALUES('','$qid','$tags[$k]')";
                $insertionQuery4 = mysqli_query($con,$insertionQuery3) or die(mysqli_error($con));
            }

            header('Location:question_browse.php?qid='.$qid);
        }
    }
    
?>
</div>

</div>
</body>

</html>