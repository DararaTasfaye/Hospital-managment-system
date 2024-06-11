<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="Admin.css">
</head>
<body>
    <div class="adminlogin container">
        <form action="Adminpage.php" method="post" id="loginform" onsubmit="return adminlogin()">
        <h1>Admin Login Form</h1>  
      
        <hr style="display: block; color: blue; width:45%;margin-bottom: 5%;">   
        <input type="text" placeholder="Enter User Name" name="UserName" id="username" required>
        <input type="password" placeholder="Enter Ur password" name="Passwordd" id="password" required> 
            <p class="error-msg" id="error-msg" style="display: none;"></p>
                <input type="submit" value="Log In" class="Submit">
        </form>
    </div>
    <script>
            function adminlogin(){
           var us=document.getElementById("username").value;
            var pw=document.getElementById("password").value;
            var expectedUserName= "HMSAdmin";
            var expectedpassword= "Admin123";
            var message;  
            if(us !== expectedUserName || pw !==expectedpassword){
                message= "Incorrect User name or Password!";
                document.getElementById("error-msg").style.display="block";
                document.getElementById("error-msg").innerHTML=message; 
                return false;
            }
            else{
                
                return true;
             
            }
        }

    </script>
</body>
</html>