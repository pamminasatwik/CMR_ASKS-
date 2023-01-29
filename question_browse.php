<?php

require_once('conn.php');
session_start();
date_default_timezone_set("Asia/Kolkata");

if(isset($_GET['qid']) && is_numeric($_GET['qid']))
{
    $qid = $_GET['qid'];

    if($qid < 1)
        header('Location:index.php');

    $qQuery = "SELECT * from questions where qid='$qid'";
    $qQuery2 = mysqli_query($con,$qQuery) or die(mysqli_error($con));
    $qQuery3 = mysqli_num_rows($qQuery2) or die(mysqli_error($con));
    $qQuery4 = mysqli_fetch_assoc($qQuery2) or die(mysqli_error($con));

    $uid = $qQuery4['uid']; //here i got the user id of the asker.
    $question = $qQuery4['question'];
    $questionDesc = $qQuery4['quesdesc'];
    $views = $qQuery4['views'];
    $time = $qQuery4['ques_timestamp'];
    $upvotes = $qQuery4['upvotes'];
    $downvotes = $qQuery4['downvotes'];

    $ip = $_SERVER['REMOTE_ADDR']; //getting user ip here. In case of localhost host it will be localhost.

    $new = $views + 1;

    $updateviews = "UPDATE questions SET views='$new' WHERE qid='$qid'";
    $updateviews2 = mysqli_query($con,$updateviews) or die(mysqli_error($con));

}
else
{
    header('Location:index.php');
}


?>
<!Doctype HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ask,Answer,Acquire</title>
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
<meta name="theme-color" content="#000000" />
<title>Ask,Answer,Acquire</title>
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

<div id="cover"></div>

<div id="container">


<div id="questionEditor" style="height: auto;min-height: 10vh;text-align: center;width: 90%;left:5%;" >

<?php

echo '<h2>'.$question.'</h2><hr color="whitesmoke">';

if(isset($_SESSION['email']))
{
    $email = $_SESSION['email'];

    $againQ = "SELECT name from users where uid='$uid'";
    $againQ2 = mysqli_query($con,$againQ) or die(mysqli_error($con));
    $againQ3 = mysqli_fetch_assoc($againQ2) or die(mysqli_error($con));
    $againname = $againQ3['name'];
    
    $againuid = $_SESSION['uid'];

        echo ' <span style="color: grey;font-size: 90%;">Asked by: </span><span style="font-size: 90%;">'.$againname.' | </span>
                <span style="color: grey;font-size: 90%;">Asked on: </span><span style="font-size: 90%;">'.date('m/d/Y H:m:s',(int)$time).' | </span>
                <span style="color: grey;font-size: 90%;">Views: </span><span style="font-size: 90%;">'.($views+1).' | </span>
                <span style="color: grey;font-size: 90%;">Upvotes: </span><span style="font-size: 90%;">'.$upvotes.' | </span>
                <span style="color: grey;font-size: 90%;">Downvotes: </span><span style="font-size: 90%;">'.$downvotes.'</span><hr>';

                $checkQ = "SELECT count(*) from question_upvotes WHERE uid='$uid' and qid='$qid'";
                $checkQ2 = mysqli_query($con,$checkQ) or die(mysqli_error($con));
                $checkQ3 = mysqli_fetch_row($checkQ2) or die(mysqli_error($con));
        
                if($checkQ3[0] == 0)
                {
                    echo '<a href="upvote.php?qid='.$qid.'&uid='.$uid.'&upvote=1&from=1"><span style="float: left;"><img src="upvote.png" width="20" /> Upvote</span></a>';
                }
                else
                {
                    echo '<a href="upvote.php?qid='.$qid.'&uid='.$uid.'&upvote=0&from=1"><span style="float: left; color: grey;"><img src="upvote.png" width="20" />Upvoted</span></a>';
                }
                
                $checkQ = "SELECT count(*) from questions_followers WHERE uid='$againuid' AND qid='$qid'";
                $checkQ2 = mysqli_query($con,$checkQ) or die(mysqli_error($con));
                $checkQ3 = mysqli_fetch_row($checkQ2) or die(mysqli_error($con));
        
                if($checkQ3[0] == 0)
                {
                    echo '<a href="follow.php?qid='.$qid.'&uid='.$uid.'&follow=1&from=1"><span><img src="follow.png" width="20" /> Follow</span></a>';
                }
                else
                {
                    echo '<a href="follow.php?qid='.$qid.'&uid='.$uid.'&follow=0&from=1"><span style="color: grey;"><img src="unfollow.png" width="20" /> Unfollow</span></a>';           
                }

                $checkQ = "SELECT count(*) from answers WHERE uid='$againuid' AND qid='$qid'";
                $checkQ2 = mysqli_query($con,$checkQ) or die(mysqli_error($con));
                $checkQ3 = mysqli_fetch_row($checkQ2) or die(mysqli_error($con));
                
                if($checkQ3[0] == 0)
                {
                    echo '<a href="answer.php?qid='.$qid.'&uid='.$uid.'" style="margin-left: 220px;"><span><img src="answer.png" width="20" /> Answer</span></a>';
                }
                else
                {
                    echo '<a href="#" onclick="return false;" style="margin-left: 220px;"><span style="color: grey;">Answered</span></a>';
                }
        
                $checkQ = "SELECT count(*) from question_downvotes WHERE uid='$uid' and qid='$qid'";
                $checkQ2 = mysqli_query($con,$checkQ) or die(mysqli_error($con));
                $checkQ3 = mysqli_fetch_row($checkQ2) or die(mysqli_error($con));
        
                if($checkQ3[0] == 0)
                {
                    echo '<a href="downvote.php?qid='.$qid.'&uid='.$uid.'&upvote=1&from=1"><span style="float: right;"><img src="downvote.png" width="20" /> Downvote</span></a>';
                }
                else
                {
                    echo '<a href="downvote.php?qid='.$qid.'&uid='.$uid.'&upvote=0&from=1"><span style="float: right;color: grey;">Downvoted</span></a>';
                } 

              echo  '<hr><span style="color: grey;font-size: 90%;">Tags: </span>';

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
                        echo '<span class="tag" style="float:none;padding: 5px;"><a href="tag.php?tagid='.$tagid.'">'.$tag.'</a></span>';
                    }
                    echo '<hr>';
                }
        echo '<div id="quesdesc"><h6 style="text-decoration: underline;position: relative;top: 10px;font-size: 120%;color: blue;">Description</h6><hr>'.$questionDesc.'</div><hr>';

        $answerQuery = "SELECT count(*) FROM answers where qid='$qid'";
        $answerQuery2 = mysqli_query($con,$answerQuery) or die(mysqli_error($con));
        $answerQuery3 = mysqli_fetch_row($answerQuery2) or die(mysqli_error($con));

        echo '<h6 style="text-decoration: underline;position: relative;top: 10px;font-size: 120%;color: blue;">Answers</h6>';
        if($answerQuery3[0] == 0)
        {   
            echo '<hr><div style="background: #DCDCDC;">No Answers.</div><hr>';
        }
        else
        {
            $answerQuery = "SELECT * FROM answers WHERE qid='$qid'";
            $answerQuery2 = mysqli_query($con,$answerQuery) or die(mysqli_error($con));
            
            for($c=0;$c<$answerQuery3[0];$c++)
            {
                $answerQuery4 = mysqli_fetch_assoc($answerQuery2) or die(mysqli_error($con));
                $answer = $answerQuery4['answer'];
                $answerid = $answerQuery4['sno'];
                $answeruid = $answerQuery4['uid'];
                $answertime = $answerQuery4['timestamp'];
                $answertime2 = date('m/d/Y H:m:s',(int)$answertime);
                $aupvotes = $answerQuery4['upvotes'];
                $adownvotes = $answerQuery4['downvotes'];

                $answerQuery5 = "SELECT * FROM users WHERE uid='$answeruid'";
                $answerQuery6 = mysqli_query($con,$answerQuery5) or die(mysqli_error($con));
                $answerQuery7 = mysqli_fetch_assoc($answerQuery6) or die(mysqli_error($con));

                $answername = $answerQuery7['name'];
                $answerusername = $answerQuery7['username'];

                echo '<hr><div style="background: #DCDCDC;padding:10px;">'.$answer.'<br>
                
                <span style="color: grey;font-size: 90%;">Asked by: </span><span style="font-size: 90%;">
                <a href="account.php?username='.$answerusername.'"> '.$answername.' </a> | </span>
                <span style="color: grey;font-size: 90%;">Asked on: </span><span style="font-size: 90%;">'.date('m/d/Y H:m:s',(int)$answertime).' | </span>
                <span style="color: grey;font-size: 90%;">Upvotes: </span><span style="font-size: 90%;">'.$aupvotes.' | </span>
                <span style="color: grey;font-size: 90%;">Downvotes: </span><span style="font-size: 90%;">'.$adownvotes.'</span><hr>';

                $checkQ = "SELECT count(*) from answer_upvotes WHERE uid='$againuid' and aid='$answerid'";
                $checkQ2 = mysqli_query($con,$checkQ) or die(mysqli_error($con));
                $checkQ3 = mysqli_fetch_row($checkQ2) or die(mysqli_error($con));
        
                if($checkQ3[0] == 0)
                {
                    echo '<a href="answer_upvote.php?aid='.$answerid.'&uid='.$uid.'&upvote=1"><span style="float: left;"><img src="upvote.png" width="20" /> Upvote</span></a>';
                }
                else
                {
                    echo '<a href="answer_upvote.php?aid='.$answerid.'&uid='.$uid.'&upvote=0"><span style="float: left; color: grey;"><img src="upvote.png" width="20" />Upvoted</span></a>';
                }
                
                $checkQ = "SELECT count(*) from answer_downvotes WHERE uid='$againuid' AND aid='$answerid'";
                $checkQ2 = mysqli_query($con,$checkQ) or die(mysqli_error($con));
                $checkQ3 = mysqli_fetch_row($checkQ2) or die(mysqli_error($con));

                if($checkQ3[0] == 0)
                {
                    echo '<a href="answer_downvote.php?aid='.$answerid.'&uid='.$uid.'&upvote=1"><span style="float: right;"><img src="downvote.png" width="20" /> Downvote</span></a>';
                }
                else
                {
                    echo '<a href="answer_downvote.php?aid='.$answerid.'&uid='.$uid.'&upvote=0"><span style="float: right;color: grey;">Downvoted</span></a>';
                }
                
                echo '<br></div><hr>';
            }
        }

    }
else
{
    echo  '<span style="color: grey;font-size: 90%;">Tags: </span>';

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
            echo '<span class="tag" style="float:none;padding: 5px;"><a href="tag.php?tagid='.$tagid.'">'.$tag.'</a></span>';
        }
        echo '<hr>';
    }
echo '<div id="quesdesc"><h6 style="text-decoration: underline;position: relative;top: 10px;font-size: 120%;color: blue;">Description</h6><hr>'.$questionDesc.'</div><hr>';

    $answerQuery = "SELECT count(*) FROM answers where qid='$qid'";
    $answerQuery2 = mysqli_query($con,$answerQuery) or die(mysqli_error($con));
    $answerQuery3 = mysqli_fetch_row($answerQuery2) or die(mysqli_error($con));
   
    $answerQuery = "SELECT * FROM answers WHERE qid='$qid'";
    $answerQuery2 = mysqli_query($con,$answerQuery) or die(mysqli_error($con));
    
    echo '<h6 style="text-decoration: underline;position: relative;top: 10px;font-size: 120%;color: blue;">Answers</h6>';

    if($answerQuery3[0] == 0)
    {   
        echo '<hr><div style="background: #DCDCDC;">No Answers.</div><hr>';
    }
else{
    for($c=0;$c<$answerQuery3[0];$c++)
    {
        $answerQuery4 = mysqli_fetch_assoc($answerQuery2) or die(mysqli_error($con));
        $answer = $answerQuery4['answer'];
        $answerid = $answerQuery4['sno'];
        $answeruid = $answerQuery4['uid'];
        $answertime = $answerQuery4['timestamp'];
        $answertime2 = date('m/d/Y H:m:s',(int)$answertime);
        $aupvotes = $answerQuery4['upvotes'];
        $adownvotes = $answerQuery4['downvotes'];

        $answerQuery5 = "SELECT * FROM users WHERE uid='$answeruid'";
        $answerQuery6 = mysqli_query($con,$answerQuery5) or die(mysqli_error($con));
        $answerQuery7 = mysqli_fetch_assoc($answerQuery6) or die(mysqli_error($con));

        $answername = $answerQuery7['name'];
        $answerusername = $answerQuery7['username'];

        echo '<hr><div style="background: #DCDCDC;padding:10px;">'.$answer.'<br>
        
        <span style="color: grey;font-size: 90%;">Asked by: </span><span style="font-size: 90%;">
        <a href="account.php?username='.$answerusername.'"> '.$answername.' </a> | </span>
        <span style="color: grey;font-size: 90%;">Asked on: </span><span style="font-size: 90%;">'.date('m/d/Y H:m:s',(int)$answertime).' | </span>
        <span style="color: grey;font-size: 90%;">Upvotes: </span><span style="font-size: 90%;">'.$aupvotes.' | </span>
        <span style="color: grey;font-size: 90%;">Downvotes: </span><span style="font-size: 90%;">'.$adownvotes.'</span></div><hr>';
    }
}
}

?>

</div>

</div>
</body>

</html>





        