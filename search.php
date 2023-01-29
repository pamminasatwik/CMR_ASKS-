<?php
require_once('conn.php');
date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['search']))
{
    $search = htmlentities($_POST['search']);
    if(ctype_space($search))
    {
        echo 2;
    }
    else
    {
        $query = "SELECT count(*) from questions WHERE question LIKE '%$search%'";
        $query2 = mysqli_query($con,$query) or die(mysqli_error($con));
        $n = mysqli_fetch_row($query2) or die(mysqli_error($con));

        if($n[0] == 0)
        {
            echo 0;
        }
        else
        {
            $query3 = "SELECT * FROM questions WHERE question LIKE '%$search%'";
            $query4 = mysqli_query($con,$query3) or die(mysqli_error($con));

            for($i=0;$i<$n[0];$i++)
            {
                $query5 = mysqli_fetch_assoc($query4) or die(mysqli_error($con));
                $question = $query5['question'];
                $qid = $query5['qid'];
                $date = date('m/d/Y H:m:s',(int)$query5['ques_timestamp']);
                $upvotes = $query5['upvotes'];
                $downvotes = $query5['downvotes'];
                
                echo '<a href="question_browse.php?qid='.$qid.'"><div>'.$question.'</a><br>
                <span style="font-size: 85%;color: grey;"> Asked on: </span><span style="font-size:85%;">'.$date.'</span>
                <span style="font-size: 85%;color: grey;"> | Upvotes: </span><span style="font-size:85%;">'.$upvotes.'</span>
                <span style="font-size: 85%;color: grey;"> | Downvotes: </span><span style="font-size:85%;">'.$downvotes.'</span>
                <hr>';
            }
        }
    }
}
else
{
    header('Location:index.php');
}


?>