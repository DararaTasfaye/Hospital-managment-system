<?php
$user="";
$pwd ="";
$patientdb = mysqli_connect('localhost','$user','$pwd', 'patientinfo');
if ($patientdb->connect_error) {
    die("Connection failed: " . $patientdb->connect_error);
}
$contact_id = $_GET["contact_id"];
$first3Chars = substr($contact_id, 0, 3);
    
if ($first3Chars == "PAT") {

$sql = "SELECT Name, FathName FROM patient WHERE PIC ='$contact_id' ";
$stmt = mysqli_query($patientdb,$sql);
$row12 = mysqli_fetch_assoc($stmt);

$RecieptN= $row12['Name'];
$RecieptFN= $row12['FathName'];
$Reciept = $RecieptN . " ". $RecieptFN;
}
else{
    $sql = "SELECT Name, MName FROM doctorinfo WHERE DIC ='$contact_id' ";
    $stmt = mysqli_query($patientdb,$sql);
    $row12 = mysqli_fetch_assoc($stmt);
    
    $RecieptN= $row12['Name'];
    $RecieptFN= $row12['MName'];
    $Reciept = $RecieptN . " ". $RecieptFN;
}

session_start();


$messagedb = mysqli_connect('localhost','$user','$pwd', 'hms_messagedb');
if ($messagedb->connect_error) {
    die("Connection failed: " . $messagedb->connect_error);
}


if (isset($_SESSION['PatName'])) {
    $pathID=$_SESSION['PID'];
   $patient = "SELECT * FROM patient WHERE PIC='$pathID'";
   $select = mysqli_query($patientdb, $patient);
     $row = mysqli_fetch_assoc($select);
     $userId = $row['PIC'];
     $name = $row['Name'];
     $fname = $row['FathName'];
     $address = $row['Address'];
     $Phone = $row['Phone'];
    $Name= $name ." ".$fname;
 
  




} 

elseif(isset($_SESSION['docName'])) {
    $DIC =$_SESSION['DID'];
    $doctor = "SELECT * FROM doctorinfo WHERE DIC='$DIC'";
    $selectdoc = mysqli_query($patientdb, $doctor);
    $row_doc = mysqli_fetch_assoc($selectdoc);
    $userId = $row_doc['DIC'];
    $name = $row_doc['Name'];
    $fname = $row_doc['MName'];
    $address = $row_doc['Email'];
    $Phone = $row_doc['Phone'];
    $image= $_SESSION['image'];
    $Name= $name ." ".$fname;
    
}
else{
    header("location: login.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected = $_POST['contact_id'];
    $message =$_POST['message'];
    $Name= $name ." ".$fname;
    $Date = date('Y-m-d');
        $Time = date('H:i:s');
       $recipient_name=$_POST['recipient_name'];
       $recipient_fath=$_POST['recipient_fath'];
       $recipient =$recipient_name." ".$recipient_fath;
      
    $Insertmsg = "INSERT INTO messagetable(Sender,SenderID, Reciever,RecieverID, Message, Date, Time) VALUES('$Name','$userId','$recipient','$selected', '$message', '$Date', '$Time')";
    if (mysqli_query($messagedb, $Insertmsg)) {
        echo "Message sent successfully!";
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("Location: $previousPage");
        exit();
        } else {
        echo "Error: " . $Insertmsg . "<br>" . mysqli_error($messagedb);
    }

}



    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Form</title>
    <link rel="stylesheet" href="./message.css">
</head>
<body>
<header class="msg_header">
    <button class="backbtn" onclick="goback()"><img src="./image/Backbtn.jpg"></button>
    <h2 style="color: crimson; font-size: 2rem; margin: 0 auto;">Message with <?php if(isset($_SESSION['PatName'])){echo "Dr. ". $Reciept;;} else echo $Reciept; ?></h2>
    <div class="userlogout">
    <div class="userName">
        <?php
        if(isset($_SESSION['docName'])){
            ?>
            <img  src="../Doc Photo/<?php echo $image?>" alt="Doctor's Image">
            <?php
            echo "<h1 style='color: white;'><b style='color: whiteblue;'>Dr. $Name</b></h1>";
        }
        elseif(isset($_SESSION['PatName'])){
            ?>
            <img src="./image/user.PNG" alt="user">
            <?php
           echo "<h1> $Name</h1>";

        }
        ?>
         </div>
        <div class="dropdown-content">
        <a href="login.php">Log out</a>        
         </div> 
         </div>
       
    </div>
    </header>
   
    <?php 

    ?>
<div class="message_board">
     
        <?php
       
        $selectmsg = "SELECT * FROM messagetable WHERE (RecieverID='$userId' OR RecieverID='$contact_id') AND (SenderID='$userId'  OR SenderID='$contact_id')";
       
        $msg = mysqli_query($messagedb, $selectmsg);

        if (mysqli_num_rows($msg) > 0) {
            while ($row = mysqli_fetch_assoc($msg)) {
                $Sender = $row['Sender'];
                $Reciever = $row['Reciever'];
                $RecieverID =$row['RecieverID'];
                $Message = $row['Message'];
                $Date = $row['Date'];
                $Time = $row['Time'];
                $Status = $row['Status'];
                if($RecieverID==$contact_id){
                echo "<div class='eachmessage' style ='background-color: white;  border: 2px solid blue;  border-radius: 20px; padding: 30px; width: 40%; margin-left: 5%; margin-top:1%;'>";
                
                echo "Send to: " . $Reciever . "<br>";
                }
                else{
                    echo "<div class='eachmessage' style ='background-color: white;  border: 2px solid blue;  border-radius: 20px; padding: 30px; width: 40%; margin-left:50%; margin-top:1%;'>";
                    
                    echo "From: " . $Sender . "<br>";
                    }

                echo "Date: " . $Date . "<br>";
                echo "Time: " . $Time . "<br>";
                echo "<hr>";
                echo "Message: " . $Message . "<br>";
            
               echo "</div>";
            }
        }    
        else {
            echo "No Message";
          
        }
        ?>
        <div class="message_form">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <input type="hidden" name="contact_id" value="<?php echo $contact_id; ?>">
             <input type="hidden" id="recipient_name" name="recipient_name" value="<?php echo $row12['Name'];?>" readonly>
            <input type="hidden" id="recipient_fath" name="recipient_fath" value="<?php echo $RecieptFN; ?>" readonly>
           
                <textarea name="message" cols="3" rows="4" placeholder="Type here..." required></textarea>
                <input type="Submit" name="Send" id="Send" value="Send">
            </form>          
        </div>
    </div>
    <script src="./script.js"></script>
</body>
</html>