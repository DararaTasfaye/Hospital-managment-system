<?php
$user="";
$pwd ="";

session_start();
if(!isset($_SESSION['PatName'])){
    header("location: login.php");
}

$docdb= mysqli_connect('localhost','$user','$pwd','patientinfo');
if ($docdb->connect_error) {
    die("Connection failed: " . $docdb->connect_error);
}
$Appointmentdb= mysqli_connect('localhost','$user','$pwd','appointmentdb');
if ($Appointmentdb->connect_error) {
    die("Connection failed: " . $Appointmentdb->connect_error);
}
$messagedb = mysqli_connect('localhost','$user','$pwd', 'hms_messagedb');
if ($messagedb->connect_error) {
    die("Connection failed: " . $messagedb->connect_error);
}


$patName= $_SESSION['PatName'];
$patFName=$_SESSION['PatFName'];

$pathID=$_SESSION['PID'];

$sql_patients = "SELECT COUNT(*) AS total_patients FROM patient";
$result_patients = $docdb->query($sql_patients);
if ($result_patients->num_rows > 0) {
    $row_patients = $result_patients->fetch_assoc();
    $patient_count = $row_patients["total_patients"];
    $patientNo =$patient_count;
} 

$doctor_No = "SELECT COUNT(*) AS doctor_No FROM doctorinfo";
$result_doc = $docdb->query($doctor_No);
if ($result_doc->num_rows > 0) {
    $row = $result_doc->fetch_assoc();
    $Doc_count = $row["doctor_No"];
    $All_Doc =$Doc_count;
}

$AllAppoint = "SELECT COUNT(*) AS finished_appointement FROM new_appointment WHERE Complete='1'";
$result_old = $Appointmentdb->query($AllAppoint);
if ($result_old->num_rows > 0) {
    $row = $result_old->fetch_assoc();
    $Finished_Appointment_count = $row["finished_appointement"];
    $Appintment_finished =$Finished_Appointment_count;
}
$Allmessage = "SELECT COUNT(*) AS total_message FROM messagetable WHERE RecieverID='$pathID'";
$result_msg = $messagedb->query($Allmessage);
if ($result_msg->num_rows > 0) {
    $row = $result_msg->fetch_assoc();
    $total_Message_count = $row["total_message"];
    $Total_Message =$total_Message_count;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="patient.css">
</head>
<body>
    <header>
        <div class="hospitallogo">
            <img src="./image/hospitallogo.jpg" alt="Hospital Logo">
            <h2>ASTU_CLINIC</h2>
        </div>
        <div class="patient-topnav">
            <div class="hamburger" onclick="myFunction()" id="hamburger">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
             </div> 
            <h1>Patient Dashboard</h1>
            <div class="useraccount">
                <div class="userlogo">
                    <img src="./image/user.PNG" alt="User">
                </div>
                <div class="dropdown-content">
                <a href="login.php">Log out</a> 
                 </div> 
            </div>
           
        </div>

    </header>
    <section id="patient_dashboard">
         <div class="navlist">          
          <ul  id="navlist">
                    
                   <li><a href="Selectcontact.php">New Message</a></li>
                   <li><a href="ViewDoctor.php">Doctor List</a></li>              

               </ul>
           </div>
        <div class="patient_dashboard_all">
            <div class="left_Dashboard">
        <div class="patient_dashboard">
            <h2>Hello, <?php echo $patName." ". $patFName; ?>👋</h2>
            <h2>How are you feeling today?</h2>
            <div class="blue_board">
                <div style="display: flex; flex-direction:column;">
                <h1>Find the best Doctors with healthcare</h1>
                <h2>Appoint the doctors and get finest medical services</h2>
                </div>
                <img src="./image/Appointment.jpg" alt="Appoint">
            </div>     
        
        </div>
        </div>
        

        <div class="calander">
        
       
            <h1>Calander</h1>
            
            <hr style="color: blue; width:45%;"> 
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
 
    
        </div>


        </div>
    
        </div>


        <div class="hospital_status">
            <h1 style="margin-left: 20%;"><u>Statics</u></h1>
            <div class="allstatics">
                <div class="eachcount">
                    <h2><?php echo $All_Doc; ?></h2>
                    <h2>Doctors</h2>
                </div>
                <div class="eachcount">
                    <h2><?php echo $patientNo;?></h2>
                    <h2>Total Patient</h2>
                </div>
                <div class="eachcount">
                    <h2><?php echo $Appintment_finished; ?></h2>
                    <h2>Completed Appointment</h2>
                </div>
                <div class="eachcount">
                    <h2><?php echo $Total_Message; ?></h2>
                    <h2>message</h2>
                </div>

            </div>

        </div>
       
        <div class="patient_appointment">
            <h2>Appointment</h2>
            <div class="appointment_table">
                <h2 style="color: crimson;">Recent Appointment</h2>
                
    <table style="width:100%">
    
    <?php
   $today = date('Y-m-d');
   $thismonth = date('Y-m-d', strtotime('+30 days'));


    $recent = "SELECT * FROM new_appointment WHERE Patient_Id='$pathID' AND cOMPLETE ='0' AND Appointed_On BETWEEN '$today' AND '$thismonth' ORDER BY Appointed_On DESC";
     $selectrecent= mysqli_query($Appointmentdb ,$recent);
     
     if(mysqli_num_rows($selectrecent)>0){
             
        
        ?>
        
    <tr>
        <th> Doctor </th>
        <th> Specification</th>
        <th> Date </th> 
        <th> Time </th>        
        <th> Status </th> 
        
    </tr>
        <?php
        while($row = mysqli_fetch_assoc($selectrecent)){
            
            $fullname = $row['Doc_Full_Name'];
            $Type= $row['Type'];
            $Date= $row['Date'];
            $Time= $row['Time'];
          
            echo "<tr style='text-align:center;'>";
            echo "<td>Dr. $fullname</td>";
            echo "<td>$Type</td>";
            echo "<td>$Date</td>";
            echo "<td class='Appointmentdate'>$Time</td>";
            
            if ($today == $Date) {
            echo "<td><button style='background-color: #ABF600; border: none; font-size: 1rem;'>Active</button></td>";
                      
        }
        elseif($today> $Date){
            echo "<td><button style='background-color: #f2fed1; border: none; font-size: 1rem;'>Completed</button></td>"; 
        }
        else{
            echo "<td><button style='background-color: #93dcff; border: none; font-size: 1rem;'>Upcoming</button> </td>";
            
        }
            echo "</tr>";
       
        }
        }
        else{
            echo "<h2>No recent Appointment</h2>";
        }
            ?>




</table>
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
    
</body>
</html>