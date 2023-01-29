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
    if(isset($_GET['aid']) && isset($_GET['uid']) && isset($_GET['upvote']))
    {
        if(is_numeric($_GET['aid']) && is_numeric($_GET['uid']) && is_numeric($_GET['upvote']))
        {
            $aid = $_GET['aid'];
            $uid = $_GET['uid'];
            $upvote = $_GET['upvote'];

            if($upvote)
            {
                $checkQuery = "SELECT count(*) FROM answer_downvotes WHERE aid='$aid' AND uid='$uid'";
                $checkQuery2 = mysqli_query($con,$checkQuery) or die(mysqli_error($con));
                $checkQuery3 = mysqli_fetch_row($checkQuery2) or die(mysqli_error($con));

                if($checkQuery3[0] == 0)
                {
                   $downQuery = "INSERT INTO answer_downvotes VALUES('','$uid','$aid','$time')"; // Following.
                   $downQuery2 = mysqli_query($con,$downQuery) or die(mysqli_error($con));

                   $downQuery3 = "SELECT downvotes FROM answers WHERE sno='$aid'";
                   $downQuery4 = mysqli_query($con,$downQuery3) or die(mysqli_error($con));
                   $downQuery5 = mysqli_fetch_assoc($downQuery4) or die(mysqli_error($con));
                   $downvotes = $downQuery5['downvotes'];
                   $n = $downvotes + 1;

                   $downQuery6 = "UPDATE answers SET downvotes='$n' WHERE sno='$aid'";
                   $downQuery6 = mysqli_query($con,$downQuery6) or die(mysqli_error($con));


                   $upvote = "SELECT count(*) FROM answer_upvotes WHERE aid='$aid' AND uid='$uid'";
                   $upvote2 = mysqli_query($con,$upvote) or die(mysqli_error($con));
                   $upvote3 = mysqli_fetch_row($upvote2) or die(mysqli_error($con));

                   if($upvote3[0] > 0)
                   {
                        $upvotequery = "DELETE FROM answer_upvotes WHERE aid='$aid' AND uid='$uid'";
                        $upvotequery2 = mysqli_query($con,$upvotequery) or die(mysqli_error($con));

                        $downvoteQuery7 = "SELECT upvotes FROM answers WHERE sno='$aid'";
                        $downvoteQuery8 = mysqli_query($con,$downvoteQuery7) or die(mysqli_error($con));
                        $downvoteQuery9 = mysqli_fetch_assoc($downvoteQuery8) or die(mysqli_error($con));
                        $downvotess = $downvoteQuery9['upvotes'];
                        $m = $downvotess - 1;
     
                        $downvoteQuery10 = "UPDATE answers SET upvotes='$m' WHERE sno='$aid'";
                        $downvotevoteQuery11 = mysqli_query($con,$downvoteQuery10) or die(mysqli_error($con));
                   }
                        header('Location:question_browse.php?qid='.$qid); // redirecting to question page if from is 1 and to index if from is 0
                }
                else
                {
                     header('Location:question_browse.php?qid='.$qid);
                }
            }
            else
            {
                $checkQuery = "SELECT count(*) FROM answer_downvotes WHERE aid='$aid' AND uid='$uid'";
                $checkQuery2 = mysqli_query($con,$checkQuery) or die(mysqli_error($con));
                $checkQuery3 = mysqli_fetch_row($checkQuery2) or die(mysqli_error($con));

                if($checkQuery3[0] > 0)
                {
                        $undodownvotequery = "DELETE FROM answer_downvotes WHERE aid='$aid' AND uid='$uid'";
                        $undodownvotequery2 = mysqli_query($con,$undodownvotequery) or die(mysqli_error($con));

                        $downvoteQuery3 = "SELECT downvotes FROM answers WHERE sno='$aid'";
                        $downvoteQuery4 = mysqli_query($con,$downvoteQuery3) or die(mysqli_error($con));
                        $downvoteQuery5 = mysqli_fetch_assoc($downvoteQuery4) or die(mysqli_error($con));
                        $downvotes = $downvoteQuery5['downvotes'];
                        $n = $downvotes - 1;
     
                        $downvoteQuery6 = "UPDATE answers SET downvotes='$n' WHERE sno='$aid'";
                        $downvoteQuery6 = mysqli_query($con,$downvoteQuery6) or die(mysqli_error($con));

                        header('Location:question_browse.php?qid='.$qid); // redirecting to question page if from is 1 and to index if from is 0
                }
                else
                {
                     header('Location:question_browse.php?qid='.$qid);
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