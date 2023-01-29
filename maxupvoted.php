<?php 

session_start();
date_default_timezone_set("Asia/Kolkata"); 
require_once('conn.php');

?>
<!Doctype HTML>
<html>
<head>
<title>Ask,Answer,Acquire</title>
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
<script type="text/javascript" src="signup.js"></script>
<script type="text/javascript" src="login.js"></script>
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

<div id="loginForm">
<form onsubmit="return false;" name="loginFormH">
<div class="form-group" id="emailHolder">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email"  placeholder="Enter email" name="email" />
  </div>
  <div class="form-group" id="passwordHolder">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password" />
  </div>
  <div class="g-signin2" data-onsuccess="onSignIn"></div>
  <input type="submit" class="btn btn-warning" name="login" id="login" style="float: right;margin-right: 3%;margin-bottom: 2%;" value="Submit" /><br /><br />
  <button class="btn btn-success" name="loginSignup" id="loginSignup" style="float: left;">New User? Create An Account</button>
  <button class="btn btn-success" name="forgot" id="forgot" style="float: right;">Forgot Password</button>

</form>
</div>

<div id="signupForm">
<form onsubmit="return false;" name="signupformH">
<div class="form-group" id="fullnameHolder">
    <label for="fullname">Fullname</label>
    <input type="text" class="form-control" id="fullname"  placeholder="Enter your fullname here" name="fullname" required />
</div>
<div class="form-group" id="signupUsernameHolder">
    <label for="signupUsername">Username</label>
    <input type="text" class="form-control" id="signupUsername" placeholder="Choose a unique username for yourself" name="signupUsername" required />
</div>
<div class="form-group" id="signupEmailHolder">
    <label for="signupEmail">Email</label>
    <input type="email" class="form-control" id="signupEmail" placeholder="Enter your email address here" name="signupEmail" required />
</div>
<div class="form-group" id="passwordHolder">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="signuppassword" placeholder="Enter password here" name="signupEmail" required />
</div>
<div class="form-group" id="retypepasswordHolder">
    <label for="retypepassword">Retype Password</label>
    <input type="password" class="form-control" id="retypepassword" placeholder="Retype Password here" name="signupEmail" required />
</div>
<div class="form-group" id="yearofcourseHolder">
    <label for="yearofcourse">Year of Course</label>
    <select id="yearofcourse" class="form-control">
    <option value="1" selected>First</option>
    <option value="2">Second</option>
    <option value="3">Third</option>
    <option value="4">Final</option>
    </select>
</div>
<div class="form-group" id="branchHolder">
    <label for="branch">Branch</label>
    <select id="branch" class="form-control">
    <option value="CSE" selected>Computer Science and Engineering</option>
    <option value="ECE">Electronics and Communication Engineering</option>
    <option value="IT">Infomartion Technology</option>
    <option value="MECH">Mechanical Engineering</option>
    <option value="EE">Electrical Engineering</option>
    <option value="PD">Production Engineering</option>
    <option value="CE">Civil Engineering</option>
    </select>
</div>
<div class="form-group" id="hostelHolder">
    <label for="branch">Hostel</label>
    <select id="hostel" class="form-control">
    <option value="Tagore" selected>Tagore</option>
    <option value="Tilak">Tilak</option>
    <option value="SVBH">SVBH</option>
    <option value="Malaviya">Malaviya</option>
    <option value="Tandon">Tandon</option>
    <option value="KNGH">KNGH</option>
    <option value="Raman">Raman</option>
    </select>
</div>
<div class="form-group" id="contactHolder">
    <label for="dob">Contact Number</label>
    <input type="number" class="form-control" id="contactNumber" aria-describedby="contactHelp" min="1000000000" placeholder="Enter your contact number here" name="contactNumber" required />
<small style="color: white;" id="contactHelp" class="form-text">Enter your number with country code. For Ex - 00977-987XXXXXXX</small>
</div>
<input type="submit" class="btn btn-warning" name="signup" id="signup" value="Sign Up" style="float: right; margin-top: 2%;margin-right: 3%;margin-bottom: 2%;" />
<button class="btn btn-success" name="signupLogin" id="signupLogin" style="float: left; margin-top: 2%;">Already Have an Account</button><br />
<button class="btn btn-success" name="forgot" id="forgotSignup" style="float: right;position: relative;top: -14px;margin: 0px 7px 0px 2px;">Forgot Password?</button>
</form>
</div>



<div id="midBody">

<div id="menuHolder">
<ul>
<li id="top"><img src="top.png" alt="Top" width="17" /> &nbsp;&nbsp;Top Question
<li id="maxup" class="selectedMenu"><img src="feature.png" alt="Featured" width="20" /> &nbsp;&nbsp;Max Upvoted

<?php

if(isset($_SESSION['email']))
{
    echo '<a style="color: grey;" id="not" href="account.php?username='.$_SESSION['username'].'">
    <li id="account"><img src="user.png" alt="Account" width="19" /> &nbsp;&nbsp;Account</li></a>';
}

?>

<ul>
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

<div id="questionContainer">

<?php

$questionq = "SELECT count(*) from questions ORDER BY upvotes DESC";
$questionq2 = mysqli_query($con,$questionq) or die(mysqli_error($con));
$questionq3 = mysqli_fetch_row($questionq2) or die(mysqli_error($con));

$questionq = "SELECT * from questions ORDER BY upvotes DESC";
$questionq2 = mysqli_query($con,$questionq) or die(mysqli_error($con));

for($d=0;$d<$questionq3[0];$d++)
{
    $questionq4 = mysqli_fetch_assoc($questionq2) or die(mysqli_error($con));
    $qid = $questionq4['qid'];
    $uid = $questionq4['uid'];
    $question = $questionq4['question'];
    $quesdesc = $questionq4['quesdesc'];
    $time = $questionq4['ques_timestamp'];
    $upvotes = $questionq4['upvotes'];
    $downvotes = $questionq4['downvotes'];
    $views = $questionq4['views'];

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


?>

<br>
<center><button id="loadMore" class="btn btn-primary">Load More</button></center>
<br><br>




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
