<?php 

$user="";
$pwd ="";
$patientdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($patientdb->connect_error) {
    die("Connection failed: " . $patientdb->connect_error);
}
$Appointmentdb= mysqli_connect('localhost','$user','$pwd','appointmentdb');
if ($Appointmentdb->connect_error) {
    die("Connection failed: " . $Appointmentdb->connect_error);
}

function generateAppID() {
    // Generate a unique Appointment ID
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $ID = '';
    for ($i = 0; $i < 4; $i++) {
        $ID .= $characters[rand(0, $charactersLength - 1)];
    }
    return $ID;
}

session_start();


if(!isset($_SESSION['docName'])){
    header("location: login.php");
}
  
    $docName= $_SESSION['docName'];
    $docFName= $_SESSION['docFName'];
    $image= $_SESSION['image'];
    $DIC =$_SESSION['DID'];
    
    $doc_FullName= $docName .' '. $docFName;
    
    $_SESSION['DID'] =$DIC;
    $ID ='App-'.generateAppID();



if(isset($_POST['Submit'])){

    $patient =$_POST['patient_info'];
    $Appoint_Date =$_POST['appointment_date'];
    $Appoint_starton =$_POST['appointment_start_time'];
    $Appoint_duration =$_POST['appointment_duration'];
    $Appoint_type =$_POST['Appointment_type'];
    $Appoint_note =$_POST['appointment_notes'];
 
    
    $patientdata = "SELECT Name,FathName, Email, Phone FROM patient WHERE PIC ='$patient' ";
    $result = $patientdb->query($patientdata);
    if($result ==true){
    $row = $result->fetch_assoc();
    $patientName = $row['Name'];
    $patientFath_Name =$row['FathName'];
    $patientEmail=$row['Email'];
    $patient_Phone= $row['Phone'];
    $fullName = $patientName .' '. $patientFath_Name;
   

    $appoint ="INSERT INTO new_appointment(AppointmentID, `FULL NAME`,	Patient_Id, Patient_Email, Patient_Phone,Date, Time, Duration, Type, Note,Doc_Full_Name, Doc_ID) VALUES('$ID', '$fullName','$patient', '$patientEmail','$patient_Phone','$Appoint_Date', '$Appoint_starton','$Appoint_duration','$Appoint_type','$Appoint_note','$doc_FullName','$DIC' )";
       
       if(mysqli_query($Appointmentdb, $appoint) ==true){
           $message= "Appointed Succesfully";
        }
        else{
            $message="Please, Try Again";
            }
        


    }
    else{
        echo "No Patient with this account";
    }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS- Appoint patient</title>
    <link href="./Doctor.css" rel="stylesheet">
</head>
<body>

    <header class="Appoint-header">
   <button class="backbtn" onclick="goback()"><img src="./image/Backbtn.jpg"></button>
    <h1 class="desktoph1">Appointment Form</h1>
    <div class="userdoc">
        <div class="userdoc1">
        <img src="../Doc Photo/<?php echo $image?>" alt="Userphoto">            
        <span class="docname"><?php echo "Dr. " ,$docName.' '.$docFName?></span>
        </div>
        <div class="dropdown-content">
        <a href="login.php">Log out</a>        
    </div>  
    </header>
    <h1 class="phoneh1" style="text-align: center;">Appointment Form</h1>
<div class="appoint-form">
  

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="appointment-form">
       
        <h2>Patient Information</h2>
        <div class= 'patientInformation'>
        <label for='patient_info'>Select Patient</label>
        <select name='patient_info' required>
            <option value="">Name(Email, Phone)</option>
        <?php 

        $patientsql = "SELECT PIC, Name,FathName, Email, Phone FROM patient";
            $result = $patientdb->query($patientsql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  
                    $patients[$row['PIC']] = $row['Name'] . " " . $row['FathName'] . " (" . $row['Email'] . ", " . $row['Phone'] . ")";
              ?>
              <
                <option value="<?php echo $row['PIC']; ?>"> <?php echo $patients[$row['PIC']];?></option>                      

              
              <?php
                }}
        ?>
       
            </select>
     
        </div>
        
         <h2>Appointment Details</h2>
        <div class="appoint_deatil">
           
            <div>
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" name="appointment_date" id="appointment-date" required>
            <div id="message-container"></div>
            </div>
            <div>
            <label for="appointment_start_time">Appointment Start Time:</label>
            <input type="time"  name="appointment_start_time" required>
            </div>
            <div>
            <label for="appointment_duration">Appointment Duration (in minutes):</label>
            <input type="number"  name="appointment_duration" min="1" max="720" step="15" required>
            </div>
        </div>
        <h2 style="margin-top: 2rem;">Appointment Type</h2>
        <select name="Appointment_type" required>
        <option value="">Select appointment type</option>
        <option value="Checkup">Check- up</option>
        <option value="Consultation">Consultation with Specialist</option>
        <option value="Surgery">Surgical Procedure</option>
        <option value="Follow-up">Follow-up</option>
        
       
      </select>
      <h2 style="margin-top: 2rem;">Appointment Notes:</h2>
<textarea  name="appointment_notes" rows="5" placeholder="Enter any additional notes or comments related to the appointment"></textarea>
<input type="submit" name="Submit"  value="Appoint">
 

    </form>
</div>


    <script src="./script.js"></script>
    <script>
    window.alert("<?php echo $message; ?>")
    const today = new Date();

document.getElementById('appointment-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting


    const appointmentDate = new Date(document.getElementById('appointment-date').value);

    if (appointmentDate < today) {
        showMessage('The appointment date cannot be in the past.');
        return;
    }

 
    const timeDiff = appointmentDate.getTime() - today.getTime();
    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));


    if (daysDiff > 30) {
        showMessage('The appointment date must be within 30 days from today.');
        return;
    }

    this.submit();
});

function showMessage(message) {
    const messageContainer = document.getElementById('message-container');
    messageContainer.textContent = message;
    messageContainer.style.color = 'red';
}


</script>
</body>
</html>