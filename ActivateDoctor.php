<?php
session_start();
$user="";
$pwd ="";
$docdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($docdb->connect_error) {
    die("Connection failed: " . $docdb->connect_error);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate Accounte</title>
    <link rel="stylesheet" href="Admin.css">
    <script src="./jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".confirm-btn").click(function(){
                var DoctorPhone =$(this).closest("tr").find(".phone").text();
                UserName = GenerateUserName();
                Password = GeneratePassword();
                $.ajax({
                    url:"ConfirmDoctor.php",
                    method:"POST", 
                    data:{DocPhone:DoctorPhone, UserName:UserName, Password:Password},
                    success:function(response){
                        alert(response);
                       location.reload();
                    }

            });
            });
            $(".delete-btn").click(function(){
                var DoctorPhone=$(this).closest("tr").find(".phone").text();
                $.ajax({
                    url:"DeleteDoctor.php", method:"POST", data:{DocPhone:DoctorPhone}, 
                    success:function(response){
                        alert(response);
                        location.reload();                        
                    }
                });
            });
        });
        function GenerateUserNamePassword(){
            UserName = GenerateUserName();
            Password = GeneratePassword();
     
            $("#username").text(UserName);
            $("#password").text(Password);        
             
            
        }      
        
        function GenerateUserName(){
            var letters= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var digits ='0123456789';
            var now = new Date();
            var year= now.getFullYear().toString().slice(-2);
            var UserName='DOC';
           
            UserName+= "-";
            for(var i=0;i<5;i++){
                UserName+=digits.charAt(Math.floor(Math.random() * digits.length));
            }
            UserName+="-";
            UserName+=year;
            return UserName;
        }
        function GeneratePassword(){
            var passwordlength=8;
            var charset='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#!$%&*';
            var Password='';
            for(var i=0;i<passwordlength;i++){
                var randomIndex = Math.floor(Math.random()*charset.length);
                Password += charset.charAt(randomIndex);
            }
            return Password;
        }
    </script>
</head>
<body>

<header>
        <div class="header" style=" display: flex;align-items: center; justify-content: space-between;">
               <div class="hamburger" onclick="myFunction()" id="hamburger">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>                             
               
                <h3 style="margin-left: 0;">Registered Doctors</h3>
                
                <div class="logo" style="margin-right: 14rem;">
                    <a href="./Adminlogin.php"> <img src="./image/logout-512.png" alt="icon">
                    <h1>Logout</h1></a>

                </div>
            </div>
        <hr style="display: block; color: blue; width:90%;  margin: auto 2%;">
    </header>
  <div class="navlist">
          
  <ul  id="navlist">
           <li><a href="ActivateDoctor.php">Activate Doctor Account</a></li>
           <li><a href="ViewDoctor.php">View Doctors profile</a></li>
           <li><a href="AdminNotification.php">New Notification</a></li>          
           <li><a href="Medicalstore.php">View Medicalstore</a></li>
          
       </ul>
   </div>  

<div class="table">
<p id="hello"></p>

    <table>
    <tbody>
    <tr>
        <th> No </th>
        <th> Name </th>
        <th> Father Name </th>
        <th> Last Name </th>
        <th> Degree </th>
        <th> College </th>
        <th> Experience </th>
        <th> Specialized at </th>

        <th> Skill </th>
        <th> Phone No </th>
        <th> Email </th>     
        <th> Age </th>
        <th> BirthDate </th>
        <th> Gender </th>
        
        <th> Registered on </th>
        <th> Confirm </th>
        <th> Delete </th>
                </tr>
        </tbody>
        <?php
       $confirm="";
        $sql = "Select *from doctorinfo";
         $slect= mysqli_query($docdb,$sql);
         
         if(mysqli_num_rows($slect)>0){
            $counter =1;            
            while($row = mysqli_fetch_assoc($slect)){
                $DOCId =$row['DIC'];
                $name = $row['Name'];
                $fname= $row['MName'];
                $gfName= $row['GName'];
                $degree= $row['Degree'];
                $college= $row['College'];
                $Experience= $row['Experience'];
                $Specilaized= $row['Specialization'];
                $Skill= $row['Skill'];
                $Phone= $row['Phone'];
                $Email=  $row['Email'];
                $image= $row['Image'];
                $age= $row['Age'];
                $birthdate =$row['BirthD'];
                $gender= $row['Gender'];                            
                $regon= $row['RegistrationDate']; 
                
                
                if(is_numeric($DOCId)){      
                                  
                echo "<tr>";
                echo "<td>$counter</td>";
                echo "<td>$name</td>";
                echo "<td>$fname</td>";
                echo "<td>$gfName</td>";
                echo "<td>$degree</td>";
                echo "<td>$college</td>";
                echo "<td>$Experience</td>";
                echo "<td>$Specilaized</td>";
                echo "<td>$Skill</td>";  
                echo "<td class='phone'>$Phone</td>";  
                echo "<td>$Email</td>" ;             
                
                echo "<td>$age</td>";
                echo "<td>$birthdate</td>";
                echo "<td>$gender</td>";
               
                echo "<td>$regon</td>";
                echo "<td><button type='submit' class='confirm-btn'>Confirm</button> </td>";
                echo "<td><button type='submit' class='delete-btn'>Delete</button> </td>";
                 $counter++;  
                       
                }
                
            }
            echo "</table>";  
            

         }
            mysqli_close($docdb);
       
        ?>

        </div>

        <script>
            function myFunction() {
            var x = document.getElementById("navlist");
            if (x.style.display === "block") {
                x.style.width = "0px";
            x.style.display = "none";
            document.getElementById("board").style.marginLeft = "0px";
            } else {
            
            x.style.width = "60vh";
            x.style.display="block";
            document.getElementById("board").style.marginLeft = "60vh";
        }
        }
        </script>
</body>
</html>