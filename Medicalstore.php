<?php 

$user="";
$pwd ="";
 $medicaldb =new mysqli('localhost','$user','$pwd','medicine');
 if($medicaldb->connect_error){
    die("Not Connected:" .$medicaldb->connect_error);
 }
session_start();

if(isset($_SESSION['docName'])){
   

$docName= $_SESSION['docName'];
$docFName =$_SESSION['docFName'];
$image= $_SESSION['image'];
$DIC =$_SESSION['DID'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical store</title>
    <link rel="stylesheet" href="./Doctor.css">
    <script src="./jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
    $(".delete-btn").click(function(){
                var MedicalId=$(this).closest("tr").find(".medicineId").text();
                $.ajax({
                    url:"DeleteDoctor.php", method:"POST", data:{MedicalId:MedicalId}, 
                    success:function(response){
                        alert(response);
                        location.reload();                        
                    }
                });
            });
        });
    </script>
</head>
<body style="border: none;">
    
<button class="backbtn" onclick="goback()"><img src="./image/Backbtn.jpg"></button>
    <div class="docName">
        <?php
        if(isset($_SESSION['docName'])){
            echo "<h1 style='color: blue;'>Wel Come, <b style='color: whiteblue;'>Dr. $docName $docFName</b></h1>";
        }?>
        <h2 style="color: crimson; font-size: 3rem;">View Medice store</h2>
    </div>
    <div class="medicalboard">
        <table>
        <tbody>
        <tr>
            <th> No </th>
            <th> Name </th>
            <th> Unique Name</th>
            <th>ID</th>
            <th> Manufactured</th>
            <th>Expire Date</th>
            <th> Ammount </th>
            <th> Price (Birr) </th>
            <th> Dosage </th>

            <th>Strength </th>
            <th> Regulatory </th>
            <th> Therapeutic </th>
       
            
            <th> Bought by </th>
            <th> Doctor's ID </th>
           
            <th> Bought on </th>
            <?php
            if(isset($_SESSION['docName'])){
                echo "<th> Delete </th>";
            }
            ?>
                    </tr>
                    <?php


$confirm="";
$medicalsql = "Select *from medicinestore";
 $select= mysqli_query($medicaldb,$medicalsql);
 
 if(mysqli_num_rows($select)>0){
    $counter =1;
    
    while($row = mysqli_fetch_assoc($select)){
        $DOCId =$row['ByDocId'];
        $name = $row['Name'];
        $Uniquename= $row['UniqueName'];
        $MedicineId =$row['Medical_Id'];
        $_SESSION['MedicineId']=$MedicineId;
        $Manufacturer= $row['Manufacturer'];
        $Expiredate= $row['ExpireDate'];
        $Ammount= $row['Ammount'];
        $Price= $row['Price'];
        $Dosage= $row['Dosage'];
        $Strength= $row['Strength'];
        $Regulatory= $row['Regulatory'];
        $Therapeutic=  $row['Therapeutic'];
        $docName= $row['ByName'];
                                  
        $boughton= $row['DateBought']; 
        
        
          
                          
        echo "<tr>";
        echo "<td>$counter</td>";
        echo "<td>$name</td>";
        echo "<td>$Uniquename</td>";
        echo "<td class='medicineId'>$MedicineId</td>";
        echo "<td>$Manufacturer</td>";        
        echo "<td>$Expiredate</td>";
        echo "<td> $Ammount</td>";
        echo "<td>$Price</td>";
        echo "<td> $Dosage</td>";
        echo "<td>$Strength</td>";  
        echo "<td>$Regulatory</td>" ;             
        
        echo "<td> $Therapeutic</td>";
        echo "<td>$docName</td>";
        echo "<td>$DOCId</td>";
       
        echo "<td>$boughton</td>";
        if(isset($_SESSION['docName'])){
            echo "<td><button type='submit' class='delete-btn'>Delete</button> </td>";
        }
      
         $counter++;  
               
        }
        
    }
    echo "</table>";      

 
    mysqli_close($medicaldb);

?>

            
            </tbody>
        </table>
    </div>

    
    <script src="./script.js"></script>
    
</body>
</html>