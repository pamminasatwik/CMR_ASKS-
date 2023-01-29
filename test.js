$(function()
{
    makeBold();
    makeItalic();
});

function makeBold()
{
    var x = $("#a").html();
    var start = new Array();
    var end = new Array();
    var z = 0;
    for(i=0;i<x.length;i++)
    {
        if(x.charAt(i) == '*')
        {
           if(z == 0)
           {
                start.push(i);
                z = 1;
           }
           else
           {
                end.push(i);
                z = 0;
           }
        }
    }

    textLength = i;

    k = 0;

    if((start.length + end.length) % 2 == 0)
    {

    for(i=0;i<start.length;i++)
    {
        $("#b").append(x.substring(k,start[i]));
        $("#b").append("<b>" + x.substring(start[i]+1,end[i]) + "</b>");
        k = end[i]+1;
    }

    $("#b").append(x.substring(k,textLength-1));
 
    }
    else
    {
        $("#b").append(x.substring(0,textLength-1));
    }

}

function makeItalic()
{
    var x = $("#a").html();
    var start = new Array();
    var end = new Array();
    var z = 0;
    for(i=0;i<x.length;i++)
    {
        if(x.charAt(i) == '_')
        {
           if(z == 0)
           {
                start.push(i);
                z = 1;
           }
           else
           {
                end.push(i);
                z = 0;
           }
        }
    }

    textLength = i;

    k = 0;

    if((start.length + end.length) % 2 == 0)
    {

    for(i=0;i<start.length;i++)
    {
        $("#b").append(x.substring(k,start[i]));
        $("#b").append("<i>" + x.substring(start[i]+1,end[i]) + "</i>");
        k = end[i]+1;
    }

    $("#b").append(x.substring(k,textLength-1));
 
    }
    else
    {
        $("#b").append(x.substring(0,textLength-1));
    }

}