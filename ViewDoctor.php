<?php
$user="";
$pwd ="";
$docdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($docdb->connect_error) {
    die("Connection failed: " . $docdb->connect_error);
}
session_start();


$DId = $_SESSION['DID'];
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Doctor Profile</title>
    <link rel="stylesheet" href="Admin.css">
    
</head>
<body>

  

<?php
if(strlen($DId) ==12){
  $docName= $_SESSION['docName'];
  $docFName= $_SESSION['docFName'];

$mysq= "SELECT *FROM doctorinfo WHERE DIC ='$DId'";
$select =mysqli_query($docdb, $mysq);
if($select==true){
    $row = mysqli_fetch_assoc($select);

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

      echo "<div class='top_nav'>";
       echo "<button class='backbtn' style=' border-radius: 50%; width: 50px; height: 50px; border: 2px solid white; cursor: pointer; margin-left: 25px;' onclick='goback()'><img src='./image/Backbtn.jpg'></button> ";
        echo "<h2>Dr. $docName $docFName 's profile</h2>";


      echo "</div>";
  echo "<div class='docprofile'>";
  echo "<div class= 'doc_info'>";

    echo "<h2 style='color: blue; text-align: center;'>Name And Id</h2>";
    echo "<hr style='display: block; color: blue; width:40%;  margin: 1%;'>";
    echo "<h2> Doc ID: &emsp;  $DOCId </h2>";
    echo "<h2> Name: &emsp;  $name $fname $gfName</h2>";
    echo "<h2 style='color: blue; text-align: center;'>Educational Background</h2>";
    echo "<hr style='display: block; color: blue; width:40%;  margin: 1%;'>";
    echo "<h2> Degree: &emsp;  $degree </h2>";
    echo "<h2> College: &emsp;  $college </h2>";
    echo "<h2> Specialist of: &emsp;  $Specilaized </h2>";
    echo "<h2>Skill:&emsp;  $Skill </h2>";
    echo "<h2>With Experience of  $Experience years. </h2>";
    echo "<h2 style='color: blue; text-align: center;'>Contact Address</h2>";
    echo "<hr style='display: block; color: blue; width:40%;  margin:  1%;'>";
    echo "<h2> Email: &emsp;  $Email </h2>";
    echo "<h2> Phone Number: &emsp;  $Phone </h2>";

    echo "<h2 style='color: blue; text-align: center;'>About You</h2>";
    echo "<hr style='display: block; color: blue; width:40%;  margin: 1%;'>";
    echo "<h2> Gender: &emsp;  $gender </h2>";
    echo "<h2> Birthdate: &emsp;  $birthdate </h2>";
    echo "<h2> Join on: &emsp;  $regon </h2>";
    echo "<h2 style='color: blue; text-align: center;'>Your Photo</h2>";
    echo "<hr style='display: block; color: blue; width:40%;  margin: 1%;'>";
    ?> 
   
    <img  src="../Doc Photo/<?php echo $row['Image'];?>" alt="Doctor's Image">
   <?php 


  echo "</div>";


  echo "<div class='docCard'>";
   echo "<h1>Your Card</h1>";
   echo "<hr style='display: block; color: blue; width:40%;  margin: 5%;'>";

   echo "<div class='docIDsample'>";
   echo "<div class='flip-card-inner'>";
   
      echo "<div class='flip-card-front'>";
        echo "<h1 style='font-size: 3rem; color:white;'>MediLab Hospital Doctor's Card</h1>";
        echo "<hr style='display: block; color: blue; width:100%;  '>";
        echo "<div class= 'front'>";
          echo "<div class='leftcard'>";
            echo "<h2><strong>Full Name:</strong>  $name $fname $gfName</h2>";
            echo "<h2><strong>ID Number:</strong>  $DOCId</h2>";
            echo "<h2><strong>Email :</strong>  $Email</h2>";
            echo "<h2><strong>Specialist of :</strong>  $Specilaized</h2>";
          echo "</div>";
          echo "<div class='rightcard'>";
        ?>
          <img  src="../Doc Photo/<?php echo $row['Image'];?>" alt="Doctor's Image">
        <?php 
        echo "</div>";   
        echo "</div>";

        echo "<div class='flip-card-back'>";
          echo "<h1 style='font-size: 3rem;'>MediLab Hospital Doctor's Card</h1>";
          echo "<hr style='display: block; color: blue; width:100%;  '>";
          echo "<h2><strong>Address</strong></h2>";
          echo "<h2><strong>Works in :</strong>  MediLab Hospital</h2>";
          echo "<h2><strong>Role :</strong>  Doctor</h2>";
          echo "<h2><strong>Email :</strong>  $Email</h2>";
          echo "<h2><strong>Phone No :</strong>   $Phone</h2>";
          echo "<h2><strong>Date Issue :</strong>  $regon</h2>";
        echo "</div>";
          
     echo "</div>";
   echo "</div>";
   echo "</div>";
 echo "</div>";
  echo "</div>";

echo "</div>";
echo "</div>";

 
  echo "</div>";
  echo "</div>";
  echo "</div>";
echo "</div>";
  echo  "</div>";

}
}
else{

  ?>
  <header>
        <div class="header">
        <button class="backbtn" onclick="goback()"><img src="./image/Backbtn.jpg"></button> 
               
                <h3 style="margin-left: 0;">Doctors Profile</h3>
                
                <

                </div>
            </div>
        <hr style="display: block; color: blue; width:90%;  margin: auto 2%;">
    </header>
  <div class="navlist">
          
  <ul  id="navlist">
           <li><a href="ActivateDoctor.php">Activate Doctor Account</a></li>
           <li><a href="AdminNotification.php">New Notification</a></li>
           <li><a href="Oldmessage.php">Old Notification</a></li>
           <li><a href="Medicalstore.php">View Medicalstore</a></li>
          
       </ul>
   </div>
   <?php


$confirm="";
$sql = "Select *from doctorinfo";
 $slect= mysqli_query($docdb,$sql);
 
 if(mysqli_num_rows($slect)>0){
    $counter =1;
    echo  "<div class='viewdoctors'>";
    
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
       
        if(!is_numeric($DOCId)){      
            echo  "<div class='eachdoctor'>";
             echo  "<div class='leftside'>";
        echo  "<div class='counter'>";
        echo  "$counter";
        echo  "</div>";

        echo  "<div>";
        echo "<h2 style='color: blue; text-align: center;'>Name And Id</h2>";
        echo "<hr style='display: block; color: blue; width:90%;  margin: auto 2%;'>";
        echo "<h2> Doc ID: &emsp;  $DOCId </h2>";
        echo "<h2> Name: &emsp;  $name $fname $gfName</h2>";
        echo  "</div>";
        echo  "<div>";
        echo "<h2 style='color: blue; text-align: center;'>Educational Background</h2>";
        echo "<hr style='display: block; color: blue; width:90%;  margin: auto 2%;'>";
        echo "<h2> Degree: &emsp;  $degree </h2>";
        echo "<h2> College: &emsp;  $college </h2>";
        echo "<h2> Specialist of: &emsp;  $Specilaized </h2>";
        echo "<h2>Skill:&emsp;  $Skill </h2>";
        echo "<h2>With Experience of  $Experience years. </h2>";
        echo  "</div>";
        echo  "<div>";
        echo "<h2 style='color: blue; text-align: center;'>Contact Address</h2>";
        echo "<hr style='display: block; color: blue; width:90%;  margin: auto 2%;'>";
        echo "<h2> Email: &emsp;  $Email </h2>";
        echo "<h2> Phone Number: &emsp;  $Phone </h2>";
        echo  "</div>";
        echo  "<div>";
        echo "<h2 style='color: blue; text-align: center;'>About him</h2>";
        echo "<hr style='display: block; color: blue; width:90%;  margin: auto 2%;'>";
        echo "<h2> Gender: &emsp;  $gender </h2>";
        echo "<h2> Birthdate: &emsp;  $birthdate </h2>";
        echo "<h2> Join on: &emsp;  $regon </h2>";
        echo  "</div>";       

        echo  "</div>";
        
        echo  "<div class='rightside'>";
           ?> 
            
            <img  src="../Doc Photo/<?php echo $row['Image'];?>" alt="Doctor's Image">
          <?php  
            echo  "</div>";
            echo  "</div>";
                          
    $counter++;
               
        }
    }
    }
  

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
  <script src="./script.js"></script>
  

</body>
</html>