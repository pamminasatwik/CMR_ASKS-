$(function()
{
    $("#login").click(function()
    {   
        email = $("#email").val();
        password = $("#password").val();
        rememberme = $("#rememberme").val();
        $.post('login.php',{email:email,password:password,rememberme:rememberme},function(data)
        {
            if(data == 0)
            {
                alert("USER DOESN'T EXISTS. PLEASE CHECK THE EMAIL.");
                $("#login").closest('form').find("input[type=password],input[type=email]").val("");
            }
            else if(data == 2)
            {
                alert("PASSWORD IS INCORRECT. PLEASE CHECK AGAIN.");
                $("#login").closest('form').find("input[type=password]").val("");   
            }
            else if(data == 1)
            {
                window.location = "index.php";
            }
        });
    });
});