<?php
$user="";
$pwd ="";
$docdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($docdb->connect_error) {
    die("Connection failed: " . $docdb->connect_error);
}

session_start();

$AppointId =$_POST['AppointId'];


echo $MedicalId;
// $MedicineId =$_POST
if(!isset($_SESSION['docName'])){
    $DocPhone = $_POST['DocPhone'];
    $del = "DELETE from doctorinfo where Phone='$DocPhone' "; 
    if(mysqli_query($docdb,$del)){
    echo " User deleted.";

    }else{
    echo "Failed:". mysqli_error($docdb);
}
    mysqli_close($docdb);
}
else{
    $MedicalId=  $_POST['MedicalId'];
  
if(is_numeric($MedicalId)){

   
    $medicaldb =new mysqli('localhost','$user','$pwd','medicine');
    if($medicaldb->connect_error){
    die("Not Connected:" .$medicaldb->connect_error);
    }
    $MedicalId= $_POST['MedicalId'];
    $medic_delete ="DELETE from medicinestore WHERE Medical_Id ='$MedicalId'";
    if(mysqli_query($medicaldb,$medic_delete)){
        echo " Medicine deleted from database of Medical store.";
        exit();
}


}
else{
         $Appointmentdb= mysqli_connect('localhost','$user','$pwd','appointmentdb');
        if ($Appointmentdb->connect_error) {
            die("Connection failed: " . $Appointmentdb->connect_error);
        }
        $AppointId =$_POST['AppointId'];
        $dltappointment ="DELETE FROM new_appointment WHERE Time='$AppointId'";
        if(mysqli_query($Appointmentdb,$dltappointment)){
            echo "Appointment Cancelled";
            exit();
        }

}

}
?>