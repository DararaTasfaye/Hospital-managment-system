<?php 
$user="";
$pwd ="";
session_start();

$docdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($docdb->connect_error) {
    die("Connection failed: " . $docdb->connect_error);
}

$msg[]="";
if(isset($_POST['Submit'])){
    $Fname =$_POST['Fname'];
    $Email=$_POST['email'];
    $Phone=$_POST['phone'];  
    $sql = "SELECT DIC, Name, MName, Phone,  Email FROM doctorinfo ";
    $result = $docdb->query($sql);
    $found_match = false;

if ($result->num_rows > 0) {    
    while($row = $result->fetch_assoc()) {
        $_SESSION['DIC']= $row['DIC']; 
        $DIC=  $_SESSION['DIC'];
 
           
           if($row['Name'] ==$Fname && $row['Email'] ==$Email && $row['Phone'] ==$Phone){                     
        
                if(is_numeric($DIC)){
                    
                  $msg[] ="<div class='userwcome' style='color:green;'>";
                    $msg[]= "Pending for Athentication";
                    $msg[].= "</div>";
                }
                else{
                  $Mname=  $row['MName'];
                  $userName =$row['DIC'];

                  echo "<div class='userwcome'>";
                  echo " <div class='usercorrect'>";
                  echo "Hello $Fname $Mname Congratulations!<br>";
                  echo "Your Account have been Confirmed!<br> ";
                  echo "Your ID is: $userName <br>";
                  echo "To continue : <button id='continue-btn' onclick='myFunction()'>Continue</button>";
                  echo "</div>";
                  echo "</div>";
                }
        
                $found_match = true;
                break;        
        }

}
if (!$found_match) {
    $msg[]= "<div class='userwcome'>";
    $msg[]= "<div class='userwcomewrong'>";
    $msg[].= "* No user found with the provided Name and Email.";
    $msg[].= "<br>To register: <button><a href='signup.php'>  REGISTER HERE</a></button>";
    $msg[].= "</div>";
    $msg[].= "</div>";
}

}

    }

    if(isset($_POST['Create'])){
        $username = $_POST['username'];
        $pass=md5($_POST['pwd']);
        $C_pass=md5($_POST['c_pwd']);

    
        if($username!=$_SESSION['DIC']){
            $error[]= "* Invalid UserName!";
        }
        else{
    
            if($pass!=$C_pass){
                $error[]= "* Confirm Password must the same with the Password";
            }
            else{
                $mysql= "UPDATE doctorinfo SET Password='$pass' WHERE DIC='$username'";
                if(mysqli_query($docdb,$mysql)){
                    header("location:login.php");
                }
            }
        }
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor confirmation check</title>
    <link rel="stylesheet" href="Admin.css">
    <style>
        body{
            width: 100%;
	display: flex; 
	/* align-items: center; */
	justify-content: center;
    flex-direction: column;
        }
    </style> 
</head>
<body>
<!--  -->
<div class="check container">
<form method="post" id="check-form" action="">
            
    <h1> View Your result by filling the following form</h1>
    <hr style="display: block; color: blue; width:45%;margin-bottom: 5%;"> 
    <input type="text" name="Fname" placeholder="Your first Name..."><br>
    <input type="email" name="email" placeholder="Email..."><br>
    <input type="tel" name="phone" placeholder="Phone..."><br>
   <?php if(isset($msg)){
                foreach($msg as $msg){
                    echo '<span>'.$msg.'</span>';
                };
            };
            ?>
          
    <input type="Submit" name="Submit" value="View">
           
</form>
<form method='post' action='' id="create-pwd" style="display: none;">
    <h1>Create Password Here</h1>
    <hr style="display: block; color: blue; width:45%; margin: auto; margin-bottom: 5%;"> 
    <h2 style="text-align: center; font-size:2rem;">Use the provided ID only</h2>
    <input type='text' name='username' id='username' placeholder='You Id Eg. DOC-*****-24'  required><br>
    <input type='password' name='pwd' id='pwd' placeholder='Password...' autocomplete='off' size="10" required> <br>
    <input type='password' name='c_pwd' id='pwd' placeholder='Confirm Password...' autocomplete='off' size="10" required>
    <?php if(isset($error)){
                foreach($error as $error){
                    echo '<span>'.$error.'</span>';
                };
            };
            ?>
    <br><input type='Submit' name= 'Create'  value='Create Password'>";
       
</form>
</div>


<script>

var continueBtn = document.getElementById("continue-btn");

continueBtn.addEventListener("click", myFunction);

function myFunction(event) {
  event.preventDefault(); 
    var x = document.getElementById("check-form");
    var y = document.getElementById("create-pwd");
     if (x.style.display === "block") {       
       x.style.display = "none";
       y.style.display="block";
    
     } else {       
      x.style.display="block";
      
      }
}

</script>

</body>
</html>