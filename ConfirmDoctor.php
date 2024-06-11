<?php
$user="";
$pwd ="";
session_start();
$docdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($docdb->connect_error) {
    die("Connection failed: " . $docdb->connect_error);
}

if(isset($_SESSION['doc_dashboard'])){
    $Appointmentdb= mysqli_connect('localhost','darara1','D1a2r3a4r5a@','appointmentdb');
    if ($Appointmentdb->connect_error) {
        die("Connection failed: " . $Appointmentdb->connect_error);
    }
    $AppointId =$_POST['AppointTime'];
    $updateappointment ="UPDATE new_appointment SET Complete='1' WHERE Time='$AppointId' ";
    if(mysqli_query($Appointmentdb,$updateappointment)){
        echo "Appointment task completed";
    }
    else{
        echo "Please Retry!";
    }
}
else{

$DocPhone = $_POST['DocPhone'];
$DocUserName = $_POST['UserName'];
$DocPwd =md5($_POST['Password']);

$update = "UPDATE doctorinfo SET DIC =? , Password =? WHERE Phone= '$DocPhone' ";
$stmt =$docdb->prepare($update);
$stmt -> bind_param("ss", $DocUserName, $DocPwd);

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $stmt->error;
}
}
mysqli_close($docdb);

?>