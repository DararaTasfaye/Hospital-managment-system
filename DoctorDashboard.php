<?php

$user="";
$pwd ="";
$docdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($docdb->connect_error) {
    die("Connection failed: " . $docdb->connect_error);
}
$Appointmentdb= mysqli_connect('localhost','darara1','D1a2r3a4r5a@','appointmentdb');
if ($Appointmentdb->connect_error) {
    die("Connection failed: " . $Appointmentdb->connect_error);
}

session_start();

if(!isset($_SESSION['docName'])){
    header('location:login.php');
}

$docName= $_SESSION['docName'];
$docFName= $_SESSION['docFName'];
$image= $_SESSION['image'];
$DIC =$_SESSION['DID'];

$_SESSION['DID'] =$DIC;
$Doc_URI = $_SERVER['REQUEST_URI'];
$_SESSION['Doc_URI'] = $Doc_URI;


$message = "SELECT COUNT(*) AS total_rows  FROM doctorinfo";
$result = $docdb->query($message);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $customer_count = $row["total_rows"];
    $docNo = $customer_count;
} else {
    $docNo = "No customers found.";
}




$sql_patients = "SELECT COUNT(*) AS total_patients FROM patient";
$result_patients = $docdb->query($sql_patients);
if ($result_patients->num_rows > 0) {
    $row_patients = $result_patients->fetch_assoc();
    $patient_count = $row_patients["total_patients"];
    $patientNo =$patient_count;
} else {
    $patientNo = "No patients found.";
}

$recentAppoint = "SELECT COUNT(*) AS total_appointement FROM new_appointment WHERE Complete='0' AND Doc_ID='$DIC' ";
$result_recent = $Appointmentdb->query($recentAppoint);
if ($result_recent->num_rows > 0) {
    $row = $result_recent->fetch_assoc();
    $Appointment_count = $row["total_appointement"];
    $Appintment_Recent =$Appointment_count;
}

$AllAppoint = "SELECT COUNT(*) AS finished_appointement FROM new_appointment WHERE Complete='1' AND Doc_ID='$DIC' ";
$result_old = $Appointmentdb->query($AllAppoint);
if ($result_old->num_rows > 0) {
    $row = $result_old->fetch_assoc();
    $Finished_Appointment_count = $row["finished_appointement"];
    $Appintment_finished =$Finished_Appointment_count;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="Doctor.css">

    <script src="./jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
    $(".delete-btn").click(function(){
                var AppointId=$(this).closest("tr").find(".Appointmentdate").text();
                $.ajax({
                    url:"DeleteDoctor.php", method:"POST", data:{AppointId:AppointId}, 
                    success:function(response){
                        alert(response);
                        location.reload();                        
                    }
                });
            });
            
            $(".complete-btn").click(function(){
                var AppointTime=$(this).closest("tr").find(".Appointmentdate").text();
                $.ajax({
                    url:"ConfirmDoctor.php", method:"POST", data:{AppointTime:AppointTime}, 
                    success:function(response){
                        alert(response);
                        location.reload();                        
                    }
                });
            });
        });
    </script>
</head>
<body style="border: 3px solid rgb(255, 218, 218);">

   <section class="docpage">
    
    <div class="header">
    <div class="headr">
    <div class="hamburger" onclick="myFunction()" id="hamburger">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div> 
    
    </div>
    <div class="userdoc">
        <div class="userdoc1">
        <img src="../Doc Photo/<?php echo $image?>" alt="Userphoto">            
        <span class="docname"><?php echo "Dr. " ,$docName.' '.$docFName?></span>
        </div>
        <div class="dropdown-content">
        <a href="login.php">Log out</a>        
    </div>   
       
    </div>
    

    </div>
    
 

   </section>
   <section id="docpage">
   <div class="docdashboard">
    <div class="navlist">
          
          <ul  id="navlist">
                   <li><a href="Appointment.php">Appointment</a></li>
                   <li><a href="ViewDoctor.php">View Your profile</a></li>
                   <li><a href="selectcontact.php">Message</a></li>
                   <li><a href="Addmedicine.php">Add Medicine</a></li>
                   <li><a href="Medicalstore.php">View Medicalstore</a></li>               

               </ul>
           </div>
    </div>
    <div class="docprofile">
        <div class="docphoto">
          <img  src="../Doc Photo/<?php echo $image?>" alt="Doctor's Image">
        </div>
        <div class="docName">
        <?php echo "<h1 style='color: white;'>Wel Come, <b style='color: whiteblue;'><span>Dr. $docName $docFName</span></b></h1>"?>
        <h2 style="color: white;">Wish you have a nice day!</h2>
        </div>
    </div>
    <div class="docboard">
        
    <div class="calander">
            <h1>Calander</h1>
            
            <hr style="display: block; color: blue; width:45%;margin-bottom: 5%;"> 
        <div class="calendar-container">
        <div class="calendar-header">
            <button class="prev-month">&lt;</button>
            <div class="current-month"></div>
            <button class="next-month">&gt;</button>
        </div>
        <table class="calendar-table">
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody class="calendar-body"></tbody>
        </table>
    </div>
    <hr style="width : 80%; height:2px; color: white; margin: 2% auto;">
    <div class="calanderfooter">
    <h2>Total Working Days</h2>
    <hr style="display: block; color: blue; width:100%;margin-bottom: 1%;"> 
    <h2 style="color: white;">24 Days</h2>
    </div>

        </div>
    <div class="rightsideboard">

    <div class="statistics">
        <div class="eachstatistics">
            <h1 style="color: blue; font-size: 2rem;"><?php echo  $docNo; ?></h1>
            <h2>Doctors</h2>
        </div>
        <div class="eachstatistics">
        <h1 style="color: blue; font-size: 2rem;"><?php echo $patientNo;?></h1>
          <h2>Patient's</h2>

        </div>
        <div class="eachstatistics">
        <h1 style="color: blue; font-size: 2rem;"><?php echo $Appintment_Recent; ?></h1>
        <h3 style="color: crimson;">New Appointment's</h3>  
        </div>
        <div class="eachstatistics">
        <h1 style="color: blue; font-size: 2rem;"><?php echo $Finished_Appointment_count; ?></h1>
        <h3 style="color: crimson;">Finished Appointment's</h3>  
        </div>

    </div>
    <div class="appointment_table">
        <h1 style="font-size: 2.5rem; color:blue;">Recent Appointment</h1>
    <div class="recent_appointment">
        
    <table style="width:100%">
    
        <?php
       $today = date('Y-m-d');
       $thismonth = date('Y-m-d', strtotime('+30 days'));


        $recent = "SELECT * FROM new_appointment WHERE Doc_ID='$DIC' AND cOMPLETE ='0' AND Appointed_On BETWEEN '$today' AND '$thismonth' ORDER BY Appointed_On DESC";
         $selectrecent= mysqli_query($Appointmentdb ,$recent);
         
         if(mysqli_num_rows($selectrecent)>0){
            $counter =1;          

            ?>
            <caption style="font-size: 2rem; color: crimson;">Your Appointment In this month</caption>
        <tr>
            <th> No </th>
            <th> Patient Name </th>
            <th> Patient ID</th>
            <th> Date </th> 
            <th> Time </th>        
            <th> Decline </th> 
            <th style="width: 30px;"> Completed </th>        
        </tr>
            <?php
            while($row = mysqli_fetch_assoc($selectrecent)){
                
                $fullname = $row['Full Name'];
                $PatientId= $row['Patient_Id'];
                $Date= $row['Date'];
                $Time= $row['Time'];
                
                echo "<tr style='text-align:center;'>";
                echo "<td>$counter</td>";
                echo "<td>$fullname</td>";
                echo "<td>$PatientId</td>";
                echo "<td>$Date</td>";
                echo "<td class='Appointmentdate'>$Time</td>";

                if ($today == $Date) {
                    echo "<td><button type='submit' class='delete-btn'>Delete</button> </td>";
                    echo "<td><button class='delete-btn' style='background-color: #ABF600; border: none; font-size: 1.5rem; width: 80px;'>Active</button></td>";
                              
                }
                elseif($today> $Date){
                    echo "<td><button type='submit' class='delete-btn'>Delete</button> </td>";
                    echo "<td><button class='delete-btn' style='background-color: #f2fed1; border: none; font-size: 1.5rem; width: 80px; color:black;'>Completed</button></td>"; 
                }
                else{
                    echo "<td><button type='submit' class='delete-btn'>Delete</button> </td>";
                    echo "<td><button class='delete-btn' style='background-color: #93dcff; border: none; font-size: 1.5rem; width: 80px;'>Upcoming</button> </td>";
                    
                }
               echo "</tr>";
                $counter++;
            }
            }
            else{
                echo "<h2>No recent Appointment</h2>";
            }
                ?>




</table>
    </div>
    </div>

    </div>
    </div>
   </section>


   <script>   
    function myFunction() {
    var x = document.getElementById("navlist");
     if (x.style.display === "flex") {
        x.style.width = "0px";
       x.style.display = "none";
       x.style.transition ="0.5s";
      
     } else {
        
      x.style.width = "60%";
      x.style.display="flex";
      x.style.transition ="0.5s";
      
  }
}


    const calendarBody = document.querySelector('.calendar-body');
    const currentMonthElement = document.querySelector('.current-month');
    const prevMonthButton = document.querySelector('.prev-month');
    const nextMonthButton = document.querySelector('.next-month');

let currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

function renderCalendar() {
    calendarBody.innerHTML = '';
    currentMonthElement.textContent = `${getMonthName(currentMonth)} ${currentYear}`;

    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    let date = 1;
    for (let i = 0; i < 6; i++) {
        const row = document.createElement('tr');
        for (let j = 0; j < 7; j++) {
            const cell = document.createElement('td');
            if (i === 0 && j < firstDay) {
                cell.classList.add('other-month');
            } else if (date > daysInMonth) {
                cell.classList.add('other-month');
            } else {
                const currentDateString = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                cell.textContent = date;
                if (currentDateString === new Date().toISOString().slice(0, 10)) {
                    cell.classList.add('today');
                }
                date++;
            }
            row.appendChild(cell);
        }
        calendarBody.appendChild(row);
    }
}

function getMonthName(month) {
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    return monthNames[month];
}

prevMonthButton.addEventListener('click', () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    renderCalendar();
});

nextMonthButton.addEventListener('click', () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendar();
});

renderCalendar();

    </script>
  </script>
</body>
</html>