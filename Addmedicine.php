<?php
$user="";
$pwd ='';
$Medicinedb = mysqli_connect('localhost','$user','$pwd','medicine');

if ($Medicinedb->connect_error) {
    echo "Error " . $Medicinedb->connect_error;
}

session_start();
if(!isset($_SESSION['docName'])){
    header('location:login.php');
}
$docName= $_SESSION['docName'];
$docFName =$_SESSION['docFName'];
$image= $_SESSION['image'];
$DIC =$_SESSION['DID'];

$byName= $docName .' '. $docFName;

if(isset($_GET['Store'])){
    $Medicine= $_GET['medicine']; 
    $uniquemedicine =$_GET['uniquemedicine'];
    $Manufacturer= $_GET['Manufacturer'];
    $expiredate =$_GET['expiredate'];
    $ammount =$_GET['ammount'];
    $Costbought=$_GET['Costbought'];
    $Dosage =$_GET['Dosage'];
    $strength= $_GET['strength'];
    $Regulatory =$_GET['Regulatory'];
    $Therapeutic =$_GET['Therapeutic'];

 $store ="INSERT INTO medicinestore(Name, UniqueName,Manufacturer,ExpireDate, Ammount, Price, Dosage, Strength, Regulatory, Therapeutic, ByName, ByDocId)
  Values('$Medicine','$uniquemedicine','$Manufacturer','$expiredate','$ammount','$Costbought','$Dosage','$strength', '$Regulatory','$Therapeutic','$byName','$DIC')";

if(mysqli_query($Medicinedb, $store) ==true){
    $message= "Recorded Succesfully";
}
else{
    $message="Please, Try Again";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Mmedicine form</title>
    <link rel="stylesheet" href="Doctor.css">
  
</head>
<body>
<button class="backbtn" onclick="goback()"><img src="./image/Backbtn.jpg"></button>
<div class="docprofile" style="margin-top: 3rem;">
        <div class="docphoto">
          <img  src="../Doc Photo/<?php echo $image?>" alt="Doctor's Image">
        </div>
        <div class="docName">
        <?php echo "<h1 style='color: white;'>Wel Come, <b style='color: whiteblue;'>Dr. $docName $docFName</b></h1>"?>
        <h2 style="color: white; font-size: 3rem;">Add Medice to store</h2>
        </div>
    </div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">

<h2 style="font-size: 2.5rem; color:blue;">Add Medicine Form</h2>


<hr style='display: block; color: blue; width:90%;  margin: 1%;'>
<div><strong style="font-size: 1.5rem;">Medicine Name:</strong><input type="text" name="medicine" placeholder="Medicine Name...." id="name" required autocomplete="off"></div>
<div><strong style="font-size: 1.5rem;">Brand Name:</strong><input type="text" name="uniquemedicine" placeholder="Unique Medicine Name...." id="uniname"  autocomplete="off"></div>

<div><strong style="font-size: 1.5rem;">Manufacturer Name:</strong><input type="text" name="Manufacturer" placeholder="Manufacture Name...." id="name" required autocomplete="off"></div>
<div class="medicalammount">
<div><strong style="font-size: 1.5rem;">Expire Date:</strong><input type="date" name="expiredate" required></div>
<div><strong style="font-size: 1.5rem;">Ammount:</strong><input type="number" name="ammount"  placeholder="Medicine ammount...." required></div>
<div><strong style="font-size: 1.5rem;">Cost:</strong><input type="number" name="Costbought"placeholder="Cost of bought...." required></div>
</div>
<div><strong style="font-size: 1.5rem;">Dosage Form:</strong>
 <select name="Dosage">
    <option value="Tablet">Tablet</option>
    <option value="Capsule">Capsule</option>
    <option value="Injection">Injection</option>  
</select></div>
<div><strong style="font-size: 1.5rem;">Strength:</strong><input type="text" name="strength" placeholder="Eg. 50mg , 34mg/ml "></div>

<div><strong style="font-size: 1.5rem;">Regulatory Status:</strong>
 <select name="Regulatory">
    <option value="approved">Approved</option>
    <option value="Discontinued">Discontinued</option>
    <option value="banned">Banned</option>  
</select></div>
<div><strong style="font-size: 1.5rem;">Therapeutic Class:</strong>
 <select name="Therapeutic">
    <option value="Antibiotics">Antibiotics</option>
    <option value="Analgesics">Analgesics</option>
    <option value="antidepressants">Antidepressants</option>
    <option value="other">Other</option>  
</select></div>


<input type="submit" name="Store" value="Add to Store">
</form>

<script src="./script.js"></script>
<script>
    window.alert("<?php echo $message; ?>")
</script>
</body>
</html>