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
                $checkQuery = "SELECT count(*) FROM question_upvotes WHERE qid='$qid' AND uid='$uid'";
                $checkQuery2 = mysqli_query($con,$checkQuery) or die(mysqli_error($con));
                $checkQuery3 = mysqli_fetch_row($checkQuery2) or die(mysqli_error($con));

                if($checkQuery3[0] == 0)
                {
                   $upvoteQuery = "INSERT INTO question_upvotes VALUES('','$uid','$qid','$time')"; // Following.
                   $upvoteQuery2 = mysqli_query($con,$upvoteQuery) or die(mysqli_error($con));

                   $upvoteQuery3 = "SELECT upvotes FROM questions WHERE qid='$qid'";
                   $upvoteQuery4 = mysqli_query($con,$upvoteQuery3) or die(mysqli_error($con));
                   $upvoteQuery5 = mysqli_fetch_assoc($upvoteQuery4) or die(mysqli_error($con));
                   $upvotes = $upvoteQuery5['upvotes'];
                   $n = $upvotes + 1;

                   $upvoteQuery6 = "UPDATE questions SET upvotes='$n' WHERE qid='$qid'";
                   $upvoteQuery6 = mysqli_query($con,$upvoteQuery6) or die(mysqli_error($con));


                   $downvote = "SELECT count(*) FROM question_downvotes WHERE qid='$qid' AND uid='$uid'";
                   $downvote2 = mysqli_query($con,$downvote) or die(mysqli_error($con));
                   $downvote3 = mysqli_fetch_row($downvote2) or die(mysqli_error($con));

                   if($downvote3[0] > 0)
                   {
                        $downvotequery = "DELETE FROM question_downvotes WHERE qid='$qid' AND uid='$uid'";
                        $downvotequery2 = mysqli_query($con,$downvotequery) or die(mysqli_error($con));

                        $upvoteQuery7 = "SELECT downvotes FROM questions WHERE qid='$qid'";
                        $upvoteQuery8 = mysqli_query($con,$upvoteQuery7) or die(mysqli_error($con));
                        $upvoteQuery9 = mysqli_fetch_assoc($upvoteQuery8) or die(mysqli_error($con));
                        $upvotess = $upvoteQuery9['downvotes'];
                        $m = $upvotess - 1;
     
                        $upvoteQuery10 = "UPDATE questions SET downvotes='$m' WHERE qid='$qid'";
                        $upvoteQuery11 = mysqli_query($con,$upvoteQuery10) or die(mysqli_error($con));
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
                $checkQuery = "SELECT count(*) FROM question_upvotes WHERE qid='$qid' AND uid='$uid'";
                $checkQuery2 = mysqli_query($con,$checkQuery) or die(mysqli_error($con));
                $checkQuery3 = mysqli_fetch_row($checkQuery2) or die(mysqli_error($con));

                if($checkQuery3[0] > 0)
                {
                        $undoupvotequery = "DELETE FROM question_upvotes WHERE qid='$qid' AND uid='$uid'";
                        $undoupvotequery2 = mysqli_query($con,$undoupvotequery) or die(mysqli_error($con));

                        $upvoteQuery3 = "SELECT upvotes FROM questions WHERE qid='$qid'";
                        $upvoteQuery4 = mysqli_query($con,$upvoteQuery3) or die(mysqli_error($con));
                        $upvoteQuery5 = mysqli_fetch_assoc($upvoteQuery4) or die(mysqli_error($con));
                        $upvotes = $upvoteQuery5['upvotes'];
                        $n = $upvotes - 1;
     
                        $upvoteQuery6 = "UPDATE questions SET upvotes='$n' WHERE qid='$qid'";
                        $upvoteQuery6 = mysqli_query($con,$upvoteQuery6) or die(mysqli_error($con));

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