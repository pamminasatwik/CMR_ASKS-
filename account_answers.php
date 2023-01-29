<?php 

session_start();
date_default_timezone_set("Asia/Kolkata"); 
require_once('conn.php');

if(isset($_SESSION['email']))
{
    if($_GET['username'])
    {
        $username = $_GET['username'];
    }
    else
    {
        header('Location:index.php');
    }
}
else
{
    header('Location:index.php');
}

?>
<!Doctype HTML>
<html>
<head>
<title>Cmr Asks</title>
<meta name="google-signin-client_id" content="511164054521-iim6ian4hjve1bg2gacsh10k79nl5kik.apps.googleusercontent.com">
<link href="https://fonts.googleapis.com/css?family=Pacifico|Bangers|Gloria+Hallelujah" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="jquery-1.11.0.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript">

      
$(function()
{
    
    
    $("#loginClick").click(function()
    {
        $("#cover").show();
        $("#signupForm").fadeOut();
        $("#loginForm").fadeIn("slow");
    });
    
     $("#cover").click(function()
     {
          $("#loginForm").fadeOut();
          $("#signupForm").fadeOut();
          $("#cover").fadeOut();
     });
     
     $("#loginSignup").click(function()
     {
        
        $("#cover").show();
        $("#signupForm").fadeIn("slow");
        $("#loginForm").fadeOut();
     });
     
     $("#forgot").click(function()
     {
        event.preventDefault();

     });

     $("#add").click(function()
     {
         window.location = "question.php";
     });
     
     $("#searchField").keyup(function()
     {
         search();
     });

    $("#top").click(function()
     {
         window.location="index.php";
     });

    $("#maxup").click(function()
     {
         window.location="maxupvoted.php";
     });
    

     $("#search").click(function()
     {
        var x = $("#searchField").val();

        if(x.length == 0)
        {
            $("#searchContainer").hide();
            alert("Please enter something in search box.");
        }
        else
        {
            $("#searchContainer").show();

            $.post('search.php',{search:x},function(data)
            {
                if(data == 0)
                {
                    $("#searchContainer").css("text-align","center");
                    $("searchContainer").css("color","grey");
                    $("#searchContainer").html("<h4>No Results Found.</h4>");
                    alert("No Results Found.");
                }
                else if(data == 2)
                {
                    $("#searchContainer").css("text-align","center");
                    $("searchContainer").css("color","grey");
                    $("#searchContainer").html("<h4>No Results Found.</h4>");
                    alert("Please enter something in search box.");
                }
                else
                {
                    $("#searchContainer").css("text-align","left");
                    $("#searchContainer").css("height","auto","max-height","");
                    $("#searchContainer").html(data);
                }
            });

        }
     });

    
     function search()
     {
        var x = $("#searchField").val();

        if(x.length == 0)
        {
            $("#searchContainer").hide();
        }
        else
        {
            $("#searchContainer").show();

            $.post('search.php',{search:x},function(data)
            {
                if(data == 0)
                {
                    $("#searchContainer").css("text-align","center");
                    $("searchContainer").css("color","grey");
                    $("#searchContainer").html("<h4>No Results Found.</h4>");
                }
                else if(data == 2)
                {
                    $("#searchContainer").css("text-align","center");
                    $("searchContainer").css("color","grey");
                    $("#searchContainer").html("<h4>No Results Found.</h4>");
                }
                else
                {
                    $("#searchContainer").css("text-align","left");
                    $("#searchContainer").css("height","auto","max-height","");
                    $("#searchContainer").html(data);
                }
            });
        
        }
    }
});

</script>
<link rel="stylesheet" href="index.css" />
<style>
    body
    {
        background: whitesmoke;
    }
</style>
</head>

<body>

<div id="cover"></div>

<div id="searchContainer">
</div>

<div id="container">

<div id="header">

<div class="form-group" id="searchBox" style="position: absolute;width: 50%;left: 30%;top: 15%;">
    <input type="text" class="form-control" id="searchField"  placeholder="Search..." name="searchField" style="width: 70%;float: left;" />&nbsp;
    <button class="btn btn-primary" id="search">Search</button>
</div>

<img src="title.png" width="100" id="titleImage"/> <h3 id="title">Ask,Answer,Acquire</h3>
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

<div id="midBody">

<div id="menuHolder">
<ul>
<li id="top"><img src="top.png" alt="Top" width="17" /> &nbsp;&nbsp;Top Question
<li id="maxup"><img src="feature.png" alt="Featured" width="20" /> &nbsp;&nbsp;Max Upvoted

<?php

if(isset($_SESSION['email']))
{
    echo '<li><img src="user.png" alt="Account" width="19" /> &nbsp;&nbsp;Account';
}

?>

<ul>
</div>

<div id="questionContainer">

<?php

$questionq = "SELECT * FROM users WHERE username='$username'";
$questionq2 = mysqli_query($con,$questionq) or die(mysqli_error($con));
$questionq3 = mysqli_num_rows($questionq2) or die(mysqli_error($con));
$questionq4 = mysqli_fetch_assoc($questionq2) or die(mysqli_error($con));
$accountuid = $questionq4['uid'];
$accountname = $questionq4['name'];
$accountemail = $questionq4['email'];
$year = $questionq4['year'];
$branch = $questionq4['branch'];

switch($year)
{
    case 1: $y = "First";
    break;
    case 2: $y = "Second";
    break;
    case 3: $y = "Third";
    break;
    case 4: $y = "Fourth";
    break;
}


echo '<div style="border:1px dashed #000000;text-align: center;padding: 10px;background: #b10f2e;color: white;">
        <h3>'.$accountname.'</h3>
        <h6 style="color:white;">@'.$username.'</h6>
        <h6><span style="color: white;">Email:</span><span> '.$accountemail.'</span></h6>
        <h5>
            <span style="color: white;">Year: </span><span> '.$y.' | </span>
            <span style="color: white;">Branch: </span><span> '.$branch.' | </span>
        </h5>
     </div>';

     echo '<hr>
     <div id="f">
         <ul style="list-style: none;">
         <li id="following"><img src="follow.png" alt="Top" width="17" /><a href="account.php?username='.$username.'" style="color: grey;" class="none"> Following</a>
         <li id="answers" class="selectedMenu"><img src="answer.png" alt="Featured" width="20" /><a href="account_answers.php?username='.$username.'" style="color: grey;" class="none">Answers</a>
         <li id="questions"><img src="question.png" alt="Featured" width="20" /><a href="account_questions.php?username='.$username.'" style="color: grey;" class="none">Questions</a>
          </ul>
     </div>
 <hr>';
 

$questionq = "SELECT count(*) FROM answers WHERE uid='$accountuid'";
$questionq2 = mysqli_query($con,$questionq) or die(mysqli_error($con));
$questionq3 = mysqli_fetch_row($questionq2) or die(mysqli_error($con));

if($questionq3[0] == 0)
{
    echo '<center><h5>Not Answered Any Questions.</h5></center>';
}
else
{
    $questionq = "SELECT * FROM answers WHERE uid='$accountuid'";
    $questionq2 = mysqli_query($con,$questionq) or die(mysqli_error($con));



    for($d=0;$d<$questionq3[0];$d++)
{
    $questionq4 = mysqli_fetch_assoc($questionq2) or die(mysqli_error($con));
    $qid = $questionq4['qid'];

    $questionq5 = "SELECT * FROM questions WHERE qid='$qid'";
    $questionq6 = mysqli_query($con,$questionq5) or die(mysqli_error($con));
    $questionq10 = mysqli_fetch_assoc($questionq6) or die(mysqli_error($con));

    $uid = $questionq10['uid'];
    $question = $questionq10['question'];
    $quesdesc = $questionq10['quesdesc'];
    $time = $questionq10['ques_timestamp'];
    $upvotes = $questionq10['upvotes'];
    $downvotes = $questionq10['downvotes'];
    $views = $questionq10['views'];

    $secondone = "select name from users where uid='$uid'";
    $secondone2 = mysqli_query($con,$secondone) or die(mysqli_error($con));
    $secondone3 = mysqli_fetch_assoc($secondone2) or die(mysqli_error($con));
    $nameof = $secondone3['name'];

    echo '<div class="q"><a href="question_browse.php?qid='.$qid.'">'.$question.'</a><hr>
    <span style="color: grey;font-size: 90%;">Asked by: </span><span style="font-size: 90%;">'.$nameof.' | </span>
    <span style="color: grey;font-size: 90%;">Total Views: </span><span style="font-size: 90%;">'.$views.' | </span>
    <span style="color: grey;font-size: 90%;">Upvotes: </span><span style="font-size: 90%;">'.$upvotes.' | </span>
    <span style="color: grey;font-size: 90%;">Downvotes: </span><span style="font-size: 90%;">'.$downvotes.' | </span>
    <span style="color: grey;font-size: 90%;">Asked on: </span><span style="font-size: 90%;">'.date('m/d/Y H:m:s',(int)$time).'</span><hr>
    <span style="color: grey;font-size: 90%;">Tags: </span>';

    $tagsQuery = "SELECT count(*) from question_tags WHERE qid='$qid'";
    $tagsQuery2 = mysqli_query($con,$tagsQuery) or die(mysqli_error($con));
    $tagsQuery3 = mysqli_fetch_row($tagsQuery2) or die(mysqli_error($con));

    if($tagsQuery3[0] == 0)
    {
        echo '<span style="font-size: 90%;">No tags.</span><hr>';
    }
    else
    {
        $tagsQuery4 = "SELECT * from question_tags WHERE qid='$qid'";
        $tagsQuery5 = mysqli_query($con,$tagsQuery4) or die(mysqli_error($con));

        for($z=0;$z<$tagsQuery3[0];$z++)
        {
            $tagsQuery6 = mysqli_fetch_assoc($tagsQuery5) or die(mysqli_error($con));
            $tagid = $tagsQuery6['tagid'];
            
            $tagsQuery7 = "SELECT tag FROM tags WHERE tagid='$tagid'";
            $tagsQuery8 = mysqli_query($con,$tagsQuery7) or die(mysqli_error($con));
            $tagsQuery9 = mysqli_fetch_assoc($tagsQuery8) or die(mysqli_error($con));
            $tag = $tagsQuery9['tag'];
            echo '<span class="tag" style="float:none;padding: 5px;"><a href="tag.php?tagid='.$tagid.'&tag='.$tag.'">'.$tag.'</a></span>';
        }
        echo '<hr>';
    }
    
    if(isset($_SESSION['email']))
    {
        $u = $_SESSION['uid'];
        $checkQ = "SELECT count(*) from question_upvotes WHERE uid='$u' and qid='$qid'";
        $checkQ2 = mysqli_query($con,$checkQ) or die(mysqli_error($con));
        $checkQ3 = mysqli_fetch_row($checkQ2) or die(mysqli_error($con));

        if($checkQ3[0] == 0)
        {
            echo '<a href="upvote.php?qid='.$qid.'&uid='.$u.'&upvote=1&from=0"><span style="float: left;"><img src="upvote.png" width="20" /> Upvote</span></a>';
        }
        else
        {
            echo '<a href="upvote.php?qid='.$qid.'&uid='.$u.'&upvote=0&from=0"><span style="float: left;color: grey;"><img src="upvote.png" width="20" color="grey" /> Upvoted</span></a>';
        }
        
        $checkQ = "SELECT count(*) from questions_followers WHERE uid='$u' and qid='$qid'";
        $checkQ2 = mysqli_query($con,$checkQ) or die(mysqli_error($con));
        $checkQ3 = mysqli_fetch_row($checkQ2) or die(mysqli_error($con));

        if($checkQ3[0] == 0)
        {
            echo '<a href="follow.php?qid='.$qid.'&uid='.$u.'&follow=1&from=0"><span><img src="follow.png" width="20" /> Follow</span></a>';
        }
        else
        {
            echo '<a href="follow.php?qid='.$qid.'&uid='.$u.'&follow=0&from=0"><span style="color: grey;"><img src="unfollow.png" width="20" /> Unfollow</span></a>';           
        }

        $checkQ = "SELECT count(*) from question_downvotes WHERE uid='$u' and qid='$qid'";
        $checkQ2 = mysqli_query($con,$checkQ) or die(mysqli_error($con));
        $checkQ3 = mysqli_fetch_row($checkQ2) or die(mysqli_error($con));

        if($checkQ3[0] == 0)
        {
            echo '<a href="downvote.php?qid='.$qid.'&uid='.$u.'&upvote=1&from=0"><span style="float: right;"><img src="downvote.png" width="20" /> Downvote</span></a>';
        }
        else
        {
            echo '<a href="downvote.php?qid='.$qid.'&uid='.$u.'&upvote=0&from=0"><span style="float: right;color: grey;"><img src="downvote.png" width="20" /> Downvoted</span></a>';
        }

        
    }
    echo '</div><br><br>';
}


}
?>
</div>

<div id="tagsContainer">
<p style="position: relative;padding: 5px;background: grey;width: 100%;color: white;text-align: center;">trendingTags</p>

<?php

$trendingtag = "SELECT * FROM tags";
$trendingtag2 = mysqli_query($con,$trendingtag) or die(mysqli_error($con));
$n = mysqli_num_rows($trendingtag2) or die(mysqli_error($con));

for($k=0;$k<$n;$k++)
{
    $trendingtag3 = mysqli_fetch_assoc($trendingtag2) or die(mysqli_error($con));
    $ttag = $trendingtag3['tag'];
    $tid = $trendingtag3['tagid'];

    $trendingtag4 = "SELECT count(*) FROM question_tags WHERE tagid='$tid'";
    $trendingtag5 = mysqli_query($con,$trendingtag4) or die(mysqli_error($con));
    $trendingtag6 = mysqli_fetch_row($trendingtag5) or die(mysqli_error($con));

    if($trendingtag6[0] > 0)
        echo '<span class="tag"><a href="tag.php?tagid='.$tid.'">'.$ttag.'</a></span>';
}

?>

</div>

<button id="add" class="btn-success" title="Ask A Question">+</button>

</div>




</div>

<script type="text/javascript">
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}
</script>
</body>

</html>
