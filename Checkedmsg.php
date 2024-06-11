<?php
$user="";
$pwd ="";
$connect = new mysqli('localhost','$user','$pwd','hms idea');
if($connect-> connect_error){
    echo "Error" .$connect->connect_error;
    }
 

$msgID = $_POST['msg_id'];


$update = "UPDATE user SET Checked =1 WHERE ID= '$msgID' ";


if (mysqli_query($connect, $update)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: ";
}

mysqli_close($connect);

?>