$(function()
{

    $("#title").click(function()
    {
        window.location = "index.php";
    });

    $("#questionArea").keyup(function()
    {
        var x = $("#questionArea").val();
        var len = 255 - x.length;
        
        if(len < 50)
        {
            $("#questionWordCount").css("color","red");
        }
        else if(len < 100)
        {
            $("#questionWordCount").css("color","orange");
        }
        else
        {
            $("#questionWordCount").css("color","grey");
        }

        $("#questionWordCount").html(len);
    });

    $("#ask,#answer").click(function()
    {

        var question = $("#questionArea").val();
        var qd = $("#questionDescription").val();
        var questiondesc = markDown(qd);

        if(question.length > 250)
        {
            alert("Question's length cannot be more than 255 words. You can describe more in question description.");
        }
        else
        {
            $("#questionDescription").val(questiondesc);
         }
        
    });

    $("#bold").click(function()
    {
        qD = document.getElementById("questionDescription");
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
        qD = document.getElementById("questionDescription");
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
        qD = document.getElementById("questionDescription");
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
        qD = document.getElementById("questionDescription");
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

            qD = document.getElementById("questionDescription");
            qD.value = qD.value + "<br>" + data + "<br>";
        }
    });

    $("#mention").click(function()
    {
        var l = "user.php?u=";
        var d = prompt("Enter Username here");
        qD = document.getElementById("questionDescription");
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
        var text = document.getElementById('questionDescription').value,
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