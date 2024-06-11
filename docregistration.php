<?php
$user="";
$pwd ="";
$docdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($docdb->connect_error) {
    die("Connection failed: " . $docdb->connect_error);
}

function generateID() {
    // Generate a unique patient ID
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $ID = '';
    for ($i = 0; $i < 6; $i++) {
        $ID .= $characters[rand(0, $charactersLength - 1)];
    }
    return $ID;
}

$num =generateID();
$name = $_POST['Dname'];
$mname = $_POST['DFname'];  
$gname = $_POST['DGname']; 
$Degree = $_POST['Ddegree'];  
$College = $_POST['Dcollege']; 
$EXperience = $_POST['DExperience'];
$specialize=$_POST['Dspecialize'];
$skill =$_POST['skill'];
$mobile= $_POST['Dphonenum'];
$email =$_POST['Demail'];
$Address = $_POST['DAddress']; 
$Age = $_POST['Age']; 
$birthdate = $_POST['birthdate'];
$gender = $_POST['Gender']; 
$target_dir = "C:/xampp/htdocs/dashboard/Web Project/Doc Photo/";
$target_file = $target_dir . basename($_FILES["imageInput"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$image = $_FILES["imageInput"]["tmp_name"];
$imgcontent=$_FILES["imageInput"]["name"];

$check = getimagesize($_FILES["imageInput"]["tmp_name"]);
if ($check !== false) {
    if (move_uploaded_file($image, $target_file)) {
        $insert ="INSERT INTO doctorinfo(DIC,Name,MName,GName,Degree,College,Experience,Specialization,Skill,Phone,Email,Image,Age,BirthD,Gender,Password)
         VALUES('$num','$name','$mname','$gname','$Degree','$College','$EXperience','$specialize','$skill','$mobile','$email','$imgcontent','$Age','$birthdate','$gender','')";
         mysqli_query($docdb,$insert);

        
         header("location:Viewstatus.php");
    }
}
?>