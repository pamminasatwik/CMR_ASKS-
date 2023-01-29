<?php
/*
@author Amrit Joshi
@copyright 2018
*/

require_once('conn.php');
session_start();
date_default_timezone_set('Asia/Kolkata');

$time = time(); //getting current timestamp

if(isset($_SESSION['email']))
{
    if(isset($_GET['qid']) && isset($_GET['uid']) && isset($_GET['upvote']) && isset($_GET['from']))
    {
        if(is_numeric($_GET['qid']) && is_numeric($_GET['uid']) && is_numeric($_GET['upvote']) && isset($_GET['from']))
        {
            $qid = $_GET['qid'];
            $uid = $_GET['uid'];
            $upvote = $_GET['upvote'];
            $from = $_GET['from'];

            if($upvote)
            {
                $checkQuery = "SELECT count(*) FROM question_downvotes WHERE qid='$qid' AND uid='$uid'";
                $checkQuery2 = mysqli_query($con,$checkQuery) or die(mysqli_error($con));
                $checkQuery3 = mysqli_fetch_row($checkQuery2) or die(mysqli_error($con));

                if($checkQuery3[0] == 0)
                {
                   $downQuery = "INSERT INTO question_downvotes VALUES('','$uid','$qid','$time')"; // Following.
                   $downQuery2 = mysqli_query($con,$downQuery) or die(mysqli_error($con));

                   $downQuery3 = "SELECT downvotes FROM questions WHERE qid='$qid'";
                   $downQuery4 = mysqli_query($con,$downQuery3) or die(mysqli_error($con));
                   $downQuery5 = mysqli_fetch_assoc($downQuery4) or die(mysqli_error($con));
                   $downvotes = $downQuery5['downvotes'];
                   $n = $downvotes + 1;

                   $downQuery6 = "UPDATE questions SET downvotes='$n' WHERE qid='$qid'";
                   $downQuery6 = mysqli_query($con,$downQuery6) or die(mysqli_error($con));


                   $upvote = "SELECT count(*) FROM question_upvotes WHERE qid='$qid' AND uid='$uid'";
                   $upvote2 = mysqli_query($con,$upvote) or die(mysqli_error($con));
                   $upvote3 = mysqli_fetch_row($upvote2) or die(mysqli_error($con));

                   if($upvote3[0] > 0)
                   {
                        $upvotequery = "DELETE FROM question_upvotes WHERE qid='$qid' AND uid='$uid'";
                        $upvotequery2 = mysqli_query($con,$upvotequery) or die(mysqli_error($con));

                        $downvoteQuery7 = "SELECT upvotes FROM questions WHERE qid='$qid'";
                        $downvoteQuery8 = mysqli_query($con,$downvoteQuery7) or die(mysqli_error($con));
                        $downvoteQuery9 = mysqli_fetch_assoc($downvoteQuery8) or die(mysqli_error($con));
                        $downvotess = $downvoteQuery9['upvotes'];
                        $m = $downvotess - 1;
     
                        $downvoteQuery10 = "UPDATE questions SET upvotes='$m' WHERE qid='$qid'";
                        $downvotevoteQuery11 = mysqli_query($con,$downvoteQuery10) or die(mysqli_error($con));
                   }

                       if($from)
                       {
                        header('Location:question_browse.php?qid='.$qid); // redirecting to question page if from is 1 and to index if from is 0
                       }
                       else
                       {
                        header('Location:index.php');
                       }
                }
                else
                {
                    if($from)
                    {
                     header('Location:question_browse.php?qid='.$qid);
                    }
                    else
                    {
                     header('Location:index.php');
                    }
                }
            }
            else
            {
                $checkQuery = "SELECT count(*) FROM question_downvotes WHERE qid='$qid' AND uid='$uid'";
                $checkQuery2 = mysqli_query($con,$checkQuery) or die(mysqli_error($con));
                $checkQuery3 = mysqli_fetch_row($checkQuery2) or die(mysqli_error($con));

                if($checkQuery3[0] > 0)
                {
                        $undodownvotequery = "DELETE FROM question_downvotes WHERE qid='$qid' AND uid='$uid'";
                        $undodownvotequery2 = mysqli_query($con,$undodownvotequery) or die(mysqli_error($con));

                        $downvoteQuery3 = "SELECT downvotes FROM questions WHERE qid='$qid'";
                        $downvoteQuery4 = mysqli_query($con,$downvoteQuery3) or die(mysqli_error($con));
                        $downvoteQuery5 = mysqli_fetch_assoc($downvoteQuery4) or die(mysqli_error($con));
                        $downvotes = $downvoteQuery5['downvotes'];
                        $n = $downvotes - 1;
     
                        $downvoteQuery6 = "UPDATE questions SET downvotes='$n' WHERE qid='$qid'";
                        $downvoteQuery6 = mysqli_query($con,$downvoteQuery6) or die(mysqli_error($con));

                      if($from)
                       {
                        header('Location:question_browse.php?qid='.$qid); // redirecting to question page if from is 1 and to index if from is 0
                       }
                       else
                       {
                        header('Location:index.php');
                       }
                }
                else
                {
                    if($from)
                    {
                     header('Location:question_browse.php?qid='.$qid);
                    }
                    else
                    {
                     header('Location:index.php');
                    }
                }               
            }
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
}
else
{
    header('Location:index.php');
}



?>