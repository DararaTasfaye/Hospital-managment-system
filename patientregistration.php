<?php
$user="";
$pwd ="";

$conn= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function generateID() {
    // Generate a unique patient ID
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $ID = '';
    for ($i = 0; $i < 5; $i++) {
        $ID .= $characters[rand(0, $charactersLength - 1)];
    }
    return $ID;
}

$name = $_POST['pname'];
$mname = $_POST['Fname'];  
$gname = $_POST['Gname']; 
$mobile= $_POST['phonenum'];
$email =$_POST['email'];
$Address = $_POST['Address']; 
$HouseNo = $_POST['HNo']; 
$Age = $_POST['Age']; 
$birthdate = $_POST['birthdate'];
$Maritul = $_POST['patient_marital_status']; 
$EName = $_POST['Emergencyname']; 
$EPhone = $_POST['Emegencyphonenum']; 
$Relation = $_POST['relation']; 
$gender = $_POST['Gender'];    
$Pass =md5($_POST['pwd']);
$ConfirmP =md5($_POST['cpwd']);
$patientID= 'PAT-'.generateID().'-'.date('y');



if($Pass===$ConfirmP && $name != $mname){
    $insert ="INSERT INTO patient(PIC,Name,FathName,GFName,Phone,Email,Address, HNo,Age,BirthDate, Marital,EName,EPhone,EEmail,Gender,Password) VALUES( '$patientID','$name','$mname','$gname','$mobile','$email','$Address','$HouseNo','$Age','$birthdate','$Maritul','$EName','$EPhone','$Relation','$gender','$Pass')";
    mysqli_query($conn,$insert);
    header("location:login.php");
     }
    elseif($Pass!=$ConfirmP){
        $msg[] ="Mismatch Password. Try Again";
    }
    elseif($name===$mname){
        $msg[]="The same name is not allowed. Try Again";
    }
    else{
    $msg[]="Try Again";
}
if(isset($msg)){
    foreach($msg as $msg){
        echo '<span class="error-msg">'.$msg.'</span>';
    };
};

$conn->close();
?>