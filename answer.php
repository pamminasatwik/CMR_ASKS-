<?php 
session_start();
date_default_timezone_set("Asia/Kolkata"); 
require_once('conn.php');

if(isset($_SESSION['email']))
{
    if(isset($_GET['qid']) && isset($_GET['uid']))
    {
        if(is_numeric($_GET['qid']) && is_numeric($_GET['uid']))
        {
            $qid = $_GET['qid'];
            $uid = $_GET['uid'];
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
<!Doctype HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mnnit Asks</title>
<link href="https://fonts.googleapis.com/css?family=Pacifico|Bangers|Gloria+Hallelujah" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="jquery-1.11.0.min.js"></script>
<script src="https://cdn.rawgit.com/showdownjs/showdown/1.0.1/dist/showdown.min.js"></script>
<script>
$(function()
{

    $("#title").click(function()
    {
        window.location = "index.php";
    });


    $("#answer").click(function()
    {

        var question = $("#answerArea").val();
        var qd = $("#answerArea").val();
        var questiondesc = markDown(qd);

        if(question.length > 250)
        {
            alert("Question's length cannot be more than 255 words. You can describe more in question description.");
        }
        else
        {
            $("#answerArea").val(questiondesc);
         }
        
    });

    $("#bold").click(function()
    {
        qD = document.getElementById("answerArea");
        qD.focus();
        caretStart = qD.selectionStart;
        console.log(caretStart);
        v = qD.value;
        console.log(v);
        qD.value = v.substring(0,caretStart);
        qD.value = qD.value + "****";
        qD.value = qD.value + v.substring(caretStart,v.length+1);
        
        qD.setSelectionRange(caretStart+2,caretStart+2);
    });

    $("#italic").click(function()
    {
        qD = document.getElementById("answerArea");
        qD.focus();
        caretStart = qD.selectionStart;
        console.log(caretStart);
        v = qD.value;
        console.log(v);
        qD.value = v.substring(0,caretStart);
        qD.value = qD.value + "__";
        qD.value = qD.value + v.substring(caretStart,v.length+1);
        
        qD.setSelectionRange(caretStart+1,caretStart+1);
    });

    $("#link").click(function()
    {
        var l = prompt("Insert your link here");
        var d = prompt("Insert link title here");
        qD = document.getElementById("answerArea");
        qD.focus();
        v = qD.value;
        
        if(l)
        {
            if(d == "")
        {   
            data = "[" + l + "]" + "(" + l + ")";
        }
        else
        {
            data = "[" + d + "]" + "(" + l + ")";
        }

        qD.value = qD.value + data;
        }
    });

    $("#code").click(function()
    {
        qD = document.getElementById("answerArea");
        qD.focus();
        v = qD.value;
        caretStart = qD.selectionStart;
        qD.value = v.substring(0,caretStart);
        qD.value = qD.value + "<br>``````<br>";
        qD.value = qD.value + v.substring(caretStart,v.length+1);
        
        qD.setSelectionRange(caretStart+7,caretStart+7);
    });

    $("#image").click(function()
    {
        var a = "";
        var t = "";
        var l = prompt("Insert the image link here");
        var a = prompt("Insert image alt title here");
        var t = prompt("Enter image title here");
        if(l)
        {

            data =  '![' + a + '](' + l + ' "' + t + '" ' + ')';

            qD = document.getElementById("answerArea");
            qD.value = qD.value + "<br>" + data + "<br>";
        }
    });

    $("#mention").click(function()
    {
        var l = "user.php?u=";
        var d = prompt("Enter Username here");
        qD = document.getElementById("answerArea");
        qD.focus();
        v = qD.value;
        
        if(d)
        {
            data = "[@" + d + "]" + "(" + l + d + ")";
        }

        qD.value = qD.value + data;
    });

    $("#preview").click(function()
    {
        $("#cover").show();
        var text = document.getElementById('answerArea').value,
        //target = document.getElementById('targetDiv'),
        converter = new showdown.Converter(),
        html = converter.makeHtml(text);
     
        $("#cover").html(html);
    });
});


function markDown(qd)
{
    converter = new showdown.Converter(),
    converted = converter.makeHtml(qd);
    return converted;
}
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
<!Doctype HTML>
<html>
<head>
<title>Mnnit Asks</title>
<link href="https://fonts.googleapis.com/css?family=Pacifico|Bangers|Gloria+Hallelujah" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="question.js"></script>
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

<form method="post" name="answerForm" action="answer_back.php">
    <div class="form-group" id="answerLinkHolder">
    <small style="color: grey;" id="answerLinkHelp" class="form-text">Your Answer Here</small>
    <div id="textTools">
        <img id="bold" src="bold.png" alt="Bold" title="Bold" />
        <img id="italic" src="italic.png" alt="Italics" title="Italics" />
        <img id="code" src="code.png" alt="Insert Code" title="Insert Code" />
        <img id="link" src="link.png" alt="Insert Link" title="Insert Link" />
        <img id="image" src="image.png" alt="Insert image" title="Insert Image" />
        <img id="mention" src="mention.png" alt="Mention User" title="Mention User" />
    </div>
    <textarea name="answerArea" style="position: relative;height: 250px;width: 100%;resize: none;font-size: 100%;font-family: Times New Roman;" id="answerArea"></textarea>
<input type="text" style="display: none;" name="ids" id="ids" value="<?php echo $qid.','.$uid; ?>"/> 
</div>
 <input id="answer" class="btn btn-primary" name="answer" type="submit" value="Answer">
</form>
</div>

</div>
</body>

</html>