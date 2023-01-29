$(function()
{   
    $("#signup").click(function()
    {
        //alert("Rajan");
        var letters = /^[A-Za-z\s]+$/;
        var fullname = $("#fullname").val();
        var username = $("#signupUsername").val();
        var email =$("#signupEmail").val();
        var checkname = document.signupformH.fullname;
        var gender = $("#gender").val();
        var password = $("#signuppassword").val();
        var retypepassword = $("#retypepassword").val();
        var contact = $("#contactNumber").val();
        var year = $("#yearofcourse").val();
        var branch = $("#branch").val();
        var hostel = $("#hostel").val();
        
        if(checkname.value.match(letters))
        {
            if(username.length < 3)
            {
                alert("Username should greater than 2 characters.");
            }
            else{
             $.post("signup.php",{fullname:fullname,email:email,username:username,password:password,retypepassword:retypepassword,contact:contact,year:year,branch:branch,hostel:hostel},function(data)
             {
                 if(data == 1)
                 {
                    alert("YOU HAVE SUCCESSFULLY SIGNED UP.");
                    $("#signupForm").fadeOut();
                    $("#cover").fadeOut();
                    window.location="index.php";
                 }
                 else if(data == 0)
                 {
                    alert("SOMETHING WENT WRONG. PLEASE TRY AGAIN LATER.");
                 }
                 else
                 {
                     alert(data)
                 } 
             });
            }
        }
        else
        {
            alert("YOUR NAME MUST CONTAIN LETTERS ONLY.");
        }
     });
 });