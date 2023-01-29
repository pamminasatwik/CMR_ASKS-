<?php 
session_start();
date_default_timezone_set("Asia/Kolkata"); 
require_once('conn.php');


if(isset($_SESSION['email']) == 0)
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

      
$(function()
{
    var z = 0;

     $("#questionArea").focus(function()
     {
        
        var x =  "?";
        var y = document.getElementById("questionArea").selectionStart;

        
        if(z == 0)
        {
            $("#questionArea").val(x);
            document.getElementById("questionArea").setSelectionRange(y,y);
            z++;
        }
     });
     
});
</script>

<link rel="stylesheet" href="index.css" />
<style>
    body
    {
        background: whitesmoke;
    }

    #addTag
    {
        position: relative;
        top: -160px;
        float: right;
    }
</style>
</head>

<body>
<!Doctype HTML>
<html>
<head>
<title>Cmr Asks</title>
<link href="https://fonts.googleapis.com/css?family=Pacifico|Bangers|Gloria+Hallelujah" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="jquery-1.11.0.min.js"></script>
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
     
     $("#locationBar").click(function()
     {
        initMap();
     });
     
     $("#signupLocation").click(function()
     {
          event.preventDefault();
          initMap();
     });
     
     $("#forgot").click(function()
     {
        event.preventDefault();

     });

     $("#add").click(function()
     {
         window.location = "question.php";
     });

     tags = new Array();
     
     $("#addTag").click(function()
     {
          var tagid = $("#tags").val();
          var tag = $("#tags option:selected").html();
          var tagField = $("#tagsField").val();

          if(tags.includes(tagid))
          {
              alert("Tag Already Added.");
          }
          else
          {
              tags.push(tagid);

              if(tagField == "")
                {
                    $("#tagsField").val(tagid);
                    $("#tagsDiv").append('<span class="tag" style="float:none;padding: 5px;">' + tag + '</span>');
                }
                else
                {
                    $("#tagsField").val(tagField + "," + tagid);
                    $("#tagsDiv").append('<span class="tag" style="float:none;padding: 5px;">' + tag + '</span>');
                }

          }
     });
});
</script>
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


<div id="questionEditor">

<form method="post" name="questionForm" action="question_back.php">
<div class="form-group shadow-textarea" id="questionLinkHolder">
    <textarea name="question" style="position: relative;height: 30%;width: 100%;resize: none;text-align: center;" placeholder="Your Question Here..." id="questionArea"></textarea>
     <small style="color: grey;float: right;" id="questionWordCount" class="form-text">250</small>  
</div>
    <div class="form-group" id="questionLinkHolder">
    <small style="color: grey;" id="questionLinkHelp" class="form-text">Describe Your Question</small>
    <div id="textTools">
        <img id="bold" src="bold.png" alt="Bold" title="Bold" />
        <img id="italic" src="italic.png" alt="Italics" title="Italics" />
        <img id="code" src="code.png" alt="Insert Code" title="Insert Code" />
        <img id="link" src="link.png" alt="Insert Link" title="Insert Link" />
        <img id="image" src="image.png" alt="Insert image" title="Insert Image" />
        <img id="mention" src="mention.png" alt="Mention User" title="Mention User" />
    </div>
    <textarea name="questiondesc" style="position: relative;height: 250px;width: 100%;resize: none;font-size: 100%;font-family: Times New Roman;" id="questionDescription"></textarea>

    <hr><div>
       <span style="font-size:80%;color:grey;"> Add Tags: </span>
       <input type="text" id="tagsField" name="tagsField" style="display: none;" />
       <select style="width: 80%;" id="tags">
           <?php
            $tagsQuery = "SELECT * from tags";
            $tagsQuery2 = mysqli_query($con,$tagsQuery) or die(mysqli_error($con));
            $tagsQuery3 = mysqli_num_rows($tagsQuery2) or die(mysqli_error($con));
            
            for($p=0;$p<$tagsQuery3;$p++)
            {
                $tagsQuery4 = mysqli_fetch_assoc($tagsQuery2) or die(mysqli_error($con));
                $tag = $tagsQuery4['tag'];
                $tagid = $tagsQuery4['tagid'];

                echo '<option value="'.$tagid.'">'.$tag.'</option>';
            }
           ?>
       </select><br><br>
        <div id="tagsDiv" style="overflow-x: scroll;overflow-y:hidden;">
    </div><hr>
                
    </div>
</div>

 <input id="ask" class="btn btn-primary" name="ask" type="submit" value="Ask">

</form>
<a href="#" id="addTag" onclick="return false;">Add</a>
</div>

</div>
</body>

</html>