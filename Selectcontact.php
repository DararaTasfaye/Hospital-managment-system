<?php
$user="";
$pwd ="";
$patientdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($patientdb->connect_error) {
    die("Connection failed: " . $patientdb->connect_error);
}
session_start();


if(isset($_SESSION['docName'])){
$docName= $_SESSION['docName'];
$docFName= $_SESSION['docFName'];
$image= $_SESSION['image'];
}
elseif (isset($_SESSION['PatName'])){
    $patName= $_SESSION['PatName'];
    $patFName=$_SESSION['PatFName'];
    $pathID=$_SESSION['PID'];

}
else{
    header("location. login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="./message.css">
    <script src="./jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".clear-btn").click(function(){
                var DoctorPhone=$(this).closest("tr").find(".userID").text();
                $.ajax({
                    url:"DeleteDoctor.php", method:"POST", data:{DocPhone:DoctorPhone}, 
                    success:function(response){
                        alert(response);
                        location.reload();                        
                    }
                });
            });
        });
    </script>
</head>
<body>
   
    <header class="msg_header">
    <button class="backbtn" onclick="goback()"><img src="./image/Backbtn.jpg"></button>
    <h2 style="color: crimson; font-size: 2rem; margin: 0 auto;">Select contact</h2>
    <div class="userlogout">
    <div class="userName">
        <?php
        if(isset($_SESSION['docName'])){
            ?>
            <img  src="../Doc Photo/<?php echo $image?>" alt="Doctor's Image">
            <?php
            echo "<h1 style='color: white;'><b style='color: whiteblue;'>Dr. $docName $docFName</b></h1>";
        }
        elseif(isset($_SESSION['PatName'])){
            ?>
            <img src="./image/user.PNG" alt="user">
            <?php
           echo "<h1> $patName $patFName</h1>";

        }
        ?>
         </div>
        <div class="dropdown-content">
        <a href="login.php">Log out</a>        
         </div> 
         </div>
       
    </div>
    </header>
    <div class="message_dashboard">
        <div class="selectphoto">
        <img src="./image/selectuser.png" alt="User">
        </div>
        <div class="userlist" style="width: 98%;">
     <?php
            if(isset($_SESSION['docName'])){   
                
              
                ?>
              <table>
                <tbody>
                <tr>                    
                    <th> Full Name </th>
                    <th> ID </th>
                    <th> Phone No</th>
                    <th> Address</th>
                    <th style="background-color: #ABF600;"> Contact </th>
                    <th style="background-color: red;"> History </th>
            </tr>
                <?php
                $patient = "Select *from patient";
                    $select= mysqli_query($patientdb,$patient);
                    
                    if(mysqli_num_rows($select)>0){                      
                        
                        while($row = mysqli_fetch_assoc($select)){
                            $patId =$row['PIC'];
                            $Name = $row['Name'];
                            $fname= $row['FathName'];
                            $address= $row['Address'];
                            $Phone= $row['Phone'];
                            $FullName =$Name." ". $fname;
                            echo "<tr>";
                            echo "<td class='user_Name'> $FullName</td>";                            
                            echo "<td  class='userID'> $patId</td>";
                            echo "<td>$Phone</td>";
                            echo "<td>$address</td>";
                            ?>
                            <td>
                             <button type="Submit" class="contact-btn" style="background-color: #93dcff; border: none; font-size: 1rem;">
                <a href="messageform.php?contact_id=<?php echo  $patId; ?>">Contact</a>
            </button></td>
            <?php
             echo "<td><button type='Submit' class='clear-btn' style='background-color: #f2fed1; border: none; font-size: 1rem;'>Clear</button></td>"; 
                            echo "</tr>";
                            
                        }
                    }
                
            }
         else{
                    ?>
                   
                <table>
                    <caption style="font-size: 2rem;">Select Doctor  </caption>
                <tbody>
                <tr>                    
                    <th> Name </th>
                    <th> Father Name </th>
                    <th> ID </th>                    
                    <th> Specialist Of</th>
                    <th> Phone No</th>
                    <th style="background-color: #ABF600;"> Contact </th>
                    <th style="background-color: red;"> History </th>
            </tr>
                <?php
                $doctor = "SELECT *FROM doctorinfo";
                    $selectdoc= mysqli_query($patientdb,$doctor);
                    
                    if(mysqli_num_rows($selectdoc)>0){
                       
                        
                        while($row = mysqli_fetch_assoc($selectdoc)){
                            $DOCId =$row['DIC'];
                            $name = $row['Name'];
                            $fname= $row['MName'];
                            $special= $row['Specialization'];
                            $Phone= $row['Phone'];


                            echo "<tr>";
                            echo "<td>$name</td>";
                            echo "<td>$fname</td>";
                            echo "<td class='userID'>$DOCId</td>";
                            echo "<td>$special</td>";
                            echo "<td>$Phone</td>";                           
                            ?>
                            <td>
                             <button type="Submit" class="contact-btn" style="background-color: #93dcff; border: none; font-size: 1rem;">
                <a href="messageform.php?contact_id=<?php echo  $DOCId; ?>">Contact</a>
            </button></td>
            <?php
                            echo "<td><button type='Submit' class='clear-btn' style='background-color: #f2fed1; border: none; font-size: 1rem;'>Clear</button></td>"; 
                            echo "</tr>";
                            
                        }
                    }
                
            }
         
            ?>
        </div>
        

    </div>



    <script src="./script.js"></script>
</body>
</html>