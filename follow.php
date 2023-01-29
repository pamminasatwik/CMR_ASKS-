<?php

/*
@author Rituparno Biswas
@copyright 2018
*/

require_once('conn.php');
session_start();

date_default_timezone_set('Asia/Kolkata');

if(isset($_SESSION['email']))
{
    if(isset($_GET['qid']) && isset($_GET['uid']) && isset($_GET['follow']) && isset($_GET['from']))
    {
        if(is_numeric($_GET['qid']) && is_numeric($_GET['uid']) && is_numeric($_GET['follow']) && isset($_GET['from']))
        {
            $qid = $_GET['qid'];
            $uid = $_GET['uid'];
            $follow = $_GET['follow'];
            $from = $_GET['from'];

            if($follow)
            {
                $checkQuery = "SELECT count(*) FROM questions_followers WHERE qid='$qid' AND uid='$uid'";
                $checkQuery2 = mysqli_query($con,$checkQuery) or die(mysqli_error($con));
                $checkQuery3 = mysqli_fetch_row($checkQuery2) or die(mysqli_error($con));

                $time = time(); //getting current timestamp

                if($checkQuery3[0] == 0)
                {
                   $followQuery = "INSERT INTO questions_followers VALUES('','$qid','$uid','$time')"; // Following.
                   $followQuery2 = mysqli_query($con,$followQuery) or die(mysqli_error($con));

                   if($followQuery2)
                   {
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
                $checkQuery = "SELECT count(*) FROM questions_followers WHERE qid='$qid' AND uid='$uid'";
                $checkQuery2 = mysqli_query($con,$checkQuery) or die(mysqli_error($con));
                $checkQuery3 = mysqli_fetch_row($checkQuery2) or die(mysqli_error($con));

                if($checkQuery3[0] < 1)
                {
                    header('Location:index.php');
                }
                else
                {
                   $unfollowQuery = "DELETE FROM questions_followers WHERE qid='$qid' AND uid='$uid'";  //Unfollowing.
                   $unfollowQuery2 = mysqli_query($con,$unfollowQuery) or die(mysqli_error($con));
                   
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