<?php
$user="";
$pwd ="";
$conn= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$msg =array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginType = $_POST['login_type'];
    $credential = $_POST["credential"];
    $password = md5($_POST['password']);
   

    if ($loginType == "username") {       
        $sql = "SELECT *FROM doctorinfo WHERE DIC = '$credential'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['DID']=$row['DIC'];
            $_SESSION['docName']=$row['Name'];
            $_SESSION['docFName']=$row['MName'];
            $_SESSION['image']= $row['Image'];
            if ($password === $row['Password']) {
                header("Location: DoctorDashboard.php");
                exit();
            }
            else{
                $msg[]= "Invalid Password";
                exit();
            }
    }
    else{
        $msg[]= "No User Found";
        exit();
    }
    } 
    else {
        $sqlpatient = "SELECT *FROM patient WHERE Email ='$credential'";        
        $resultpatient = $conn->query($sqlpatient);
        if ($resultpatient->num_rows > 0) {
            $row = $resultpatient->fetch_assoc();
            session_start();
            $_SESSION['PID']=$row['PIC'];
            $_SESSION['PatName']=$row['Name'];
            $_SESSION['PatFName']=$row['FathName'];


            if ($password === $row['Password']) {
                header("Location: Patientdashboard.php");
                exit();
            }
            else{
                $msg[]= "Invalid Password";
                exit();
            }
        }
        $msg[]= "No Patient with provided Email. Please Retry";
        exit();
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="./home.css">
</head>
<body>
<header>
        <div class="header container">
             <div class="navbar">
                <div class="logo">
                    <a href="#"> <img src="./image/hospitallogo.jpg" alt="icon">
                    <h1>ASTU_CLINIC</h1></a>

                </div>
            
                <div class="buttons" style=" display:block; margin-left:60%;">
                    <button><a href="signup.php">Sign Up</a></button>
                </div><br>
            </div>
        </div>
        <hr style="display: block; color: blue; width:90%;  margin: auto 2%;">
    </header>

    <section id="login">
        <div class="login container">
          
    
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h1>Login </h1>
    <hr style="display: block; color: blue; width:45%; margin: auto; margin-bottom: 5%;"> 
                <img src="./image/image.png" alt="logo">
             <?php   if(isset($msg)){
    foreach($msg as $msg){
        echo '<span class="error-msg">'.$msg.'</span>';
    };
};
?>


              
                <div class="loginput">     
        <label for="login_type">Login as:</label>
        <select id="login_type" name="login_type">
            <option value="email">Patient</option>
            <option value="username">Doctor</option>            
        </select>
        </div>

        <div class="loginput">
        <label for="credential">Username/Email:</label>
        <input type="text" id="credential" name="credential" required>
        </div>
        <div class="loginput">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" name="submit" value="Login">
    </form>
               </div>

    </section>
    <hr style="display: block; color: blue; width:97%;  margin: auto 2%;">
  
    <footer>
    <div class="footer">
        <div class="logo">
            <a href="#"> <img src="./image/Icon.png" alt="icon">
            <h1>MediLab</h1></a>
        </div>
        <div class="navlist">
            <h2 style="font-size: 2.5rem;"><b>QUICK LINK</b></h2>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="home.php">Services</a></li>
                <li><a href="home.php">Contact Us</a></li>
                <li><a href="home.php">About Us</a></li>

            </ul>
        </div>
        <div class="hours">
            <h2 style="font-size: 2.5rem;">Hours</h2>
            <ul>
            <li>Monday:&emsp;&emsp;&emsp;&emsp;9:00 - 18:00</li>
                <li>Tuesday: &emsp;&emsp;&emsp; 9:00 - 18:00</li>
                <li>Wednesday: &emsp;&emsp;9:00 - 18:00</li>
                <li>Thursday: &emsp;&emsp;&emsp;9:00 - 18:00</li>
                <li>Friday: &emsp;&emsp;&emsp;&emsp;  9:00 - 18:00</li>
            </ul>
        </div>
        <div class="footercontact">
        <h2 style="font-size: 2.5rem;">CONTACT</h2>
            <ul>
                <li>000-0000-000</li>
                <li>medilab@example.com</li>
                <li>Adama Ethiopia</li>
            </ul>
       </div>
    </div>
</footer>


</body>
</html>