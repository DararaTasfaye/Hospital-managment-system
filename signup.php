<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
   
    <link href="registration.css" rel="stylesheet">
</head>
<body>
   
<header>
        <div class="header container">
            
            <div class="navbar">
                <div class="logo">
                    <a href="#"> <img src="./image/Icon.png" alt="icon">
                    <h1>MediLab</h1></a>

                </div>
               
                <div class="buttons" style=" display:block; margin-left:60%;">
                    <button><a href="login.php">Sign In</a></button>
                </div><br>
              
            </div>

        </div>
        <hr style="display: block; color: blue; width:90%;  margin: auto 2%;">
    </header>
    <section id="signup">
        <div class="signup container">
        <div class="signupform">
            <h1>Sign Up</h1>   
            <hr style="display: block; color: blue; width:45%;margin-bottom: 5%;">         
            <h2 style="margin-left: 10%;">Please Sign Up to Continue</h2>
                <ul class="tabs">
                    <li id="patient-tab" class="active">Patient</li>
                    <li id="doctor-tab">Doctors</li>
                </ul>
           
    <div id="patient-form" class="form-container">
      <form action="patientregistration.php" method="post">
        <h2>Patient Registration</h2>        
        <div class="patientinfo">
            <h3>Full Name</h3>

        <input type="text" name="pname" placeholder="First Name" required>
        <input type="text" name="Fname" placeholder="Father name" required>
        <input type="text" name="Gname" placeholder="Grand F name" required>
        </div>
        <div class="patientinfo">
            <h3>Your Contact</h3>
        <input type="tel"  name="phonenum" placeholder="Mobile Number" required>
        <input type="email" name="email" placeholder="Eg. example@example.com" required>
        <input type="text" name="Address" placeholder="Eg. Adama" required>
        <input type="text" name="HNo" placeholder="House Number" required>
        </div>
        <div class="patientinfo">
        <h3>Age And Birth Date</h3>
        <input type="number" name="Age" placeholder="Age" min="20" max="40" required>
        <input type="date" name="birthdate" placeholder="Birth Date" required>
        <label for="marital">Marital status:</label>
            <select id="patient_marital_status" name="patient_marital_status" required>
                <option value="Unknown">Select Marital Status</option>
                <option value="single">Single</option>
                <option value="married">Married</option>
            </select>
        </div>
        <div class="patientinfo">
            <h3>Emergency Contact</h3>
            <input type="text" name="Emergencyname" placeholder="Full Name" required>
            <input type="tel"  name="Emegencyphonenum" placeholder="Eg. +2519 09090909 " required>
            <label for="relation">Your Relation</label>
             <input type="text" name="relation" placeholder="Eg. Father" required>


        </div>
        
        <div class="patientinfo">
        <label for="Gender">Gender</label>
            <select name="Gender" required>
                <option name="Male">Male</option>
                <option name="Male">Female</option>
            </select>
        <input type="password" name="pwd" placeholder="Password" required>
        <input type="password" name="cpwd" placeholder="Confirm Password" required>
        </div>
            <div style="text-align:center;margin-top:40px;">
            <span class="step-patient"></span>
            <span class="step-patient"></span>
            <span class="step-patient"></span>
            <span class="step-patient"></span>
            <span class="step-patient"></span>
        </div>
        <div style="float:right; margin-left: auto;">
            <button type="button" id="prevBtn-patient" onclick="nextPrevPatient(-1)">Previous</button>
            <button type="button" id="nextBtn-patient" onclick="nextPrevPatient(1)">Next</button>
            <input type="submit" name="Submit" id="submitBtn-patient" value="Register">
        </div>

         
      </form>
    </div>
    <div id="doctor-form" class="form-container" style="display: none;">
      <form action="docregistration.php" method="post"  enctype="multipart/form-data">
        <h2>Doctor Registration</h2>
        <div class="doctorinfo">
            <h3>Full Name</h3>
        <input type="text" name="Dname" placeholder="First Name" required>
        <input type="text" name="DFname" placeholder="Father name" required>
        <input type="text" name="DGname" placeholder="Grand F name" required>
        </div>
        <div class="doctorinfo">
          <h3>Study information</h3>
        <label for="specializatin"></label>
        <input type="text" name="Ddegree" placeholder="Eg. Nursing" required>
        <input type="text" name="Dcollege" placeholder="Eg. Addis Ababa University" required>
        <input type="number" name="DExperience" placeholder="Year of Experience" required min="0">
        </div>
        <div class="doctorinfo">
        <h3>Your Skill</h3>
        <input type="text" name="Dspecialize" placeholder="Specialization field">
        <label>Check your Skill</label>

        <textarea name="skill" id="skill" placeholder="Write your skill here ..." style="font-size: 3rem;">...</textarea>


        </div>
        <div class="doctorinfo">
            <h3>Your Contact</h3>
        <input type="tel"  name="Dphonenum" placeholder="Mobile Number" required>
        <input type="email" name="Demail" placeholder="Eg. example@example.com" required>
        <input type="text" name="DAddress" placeholder="Eg. Adama" required>
        </div>
        <div class="doctorinfo">
        <h3> Fill the Information</h3>
        <label for="image">Your Image</label>
        <input type="file" id="imageInput" name="imageInput" accept="image/*" />
        <label for="imageInput" class="image-label">Upload Image</label>
        <input type="number" name="Age" placeholder="Age" min="20" max="40" required>
        <input type="date" name="birthdate" placeholder="Birth Date" required>
        <label for="Gender">Gender</label>
            <select name="Gender" required>
                <option name="gender">Male</option>
                <option name="gender">Female</option>
            </select>
       
        </div>
       
            <div style="text-align:center;margin-top:40px;">
            <span class="step-doctor"></span>
            <span class="step-doctor"></span>
            <span class="step-doctor"></span>
            <span class="step-doctor"></span>
            <!-- <span class="step-doctor"></span> -->
           
        </div>
        <div style="float:right; margin-left: auto;">
            <button type="button" id="prevBtn-doctor" onclick="nextPrevDoctor(-1)">Previous</button>
            <button type="button" id="nextBtn-doctor" onclick="nextPrevDoctor(1)">Next</button>
            <input type="submit" name="Submit" id="submitBtn-doctor" value="Register">
        </div>
        
      </form>
    </div>

        </div>
        </div>

    </section>

    <hr style="display: block; color: blue; width:97%;  margin: auto 2%;">

    
<footer>
    <div class="footer">
        <div class="logo">
            <a href="#"> <img src="./image/Icon.png" alt="icon">
            <h1>MediLab</h1></a>
        </div>
        <div class="navlist">
            <h2 style="font-size: 2.5rem;"><b>QUICK LINK</b></h2>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="#aboutus">About Us</a></li>

            </ul>
        </div>
        <div class="hours">
            <h2 style="font-size: 2.5rem;">Hours</h2>
            <ul>
                <li>Monday:&emsp;&emsp;&emsp;&emsp;9:00 - 18:00</li>
                <li>Tuesday: &emsp;&emsp;&emsp; 9:00 - 18:00</li>
                <li>Wednesday: &emsp;&emsp;9:00 - 18:00</li>
                <li>Thursday: &emsp;&emsp;&emsp;9:00 - 18:00</li>
                <li>Friday: &emsp;&emsp;&emsp;&emsp;  9:00 - 18:00</li>
            </ul>
        </div>
        <div class="footercontact">
        <h2 style="font-size: 2.5rem;">CONTACT</h2>
            <ul>
                <li>000-0000-000</li>
                <li>medilab@example.com</li>
                <li>Adama Ethiopia </li>
            </ul>
       </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
  const patientTab = document.getElementById('patient-tab');
  const doctorTab = document.getElementById('doctor-tab');
  const patientForm = document.getElementById('patient-form');
  const doctorForm = document.getElementById('doctor-form');

  patientTab.addEventListener('click', () => {
    patientTab.classList.add('active');
    doctorTab.classList.remove('active');
    patientForm.style.display = 'block';
    doctorForm.style.display = 'none';
  });

  doctorTab.addEventListener('click', () => {
    patientTab.classList.remove('active');
    doctorTab.classList.add('active');
    patientForm.style.display = 'none';
    doctorForm.style.display = 'block';
  });
});

// Patient Form
var currentPatient = 0;
showPatient(currentPatient);

function showPatient(n) {
  var x = document.getElementsByClassName("patientinfo");
  for (var i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("prevBtn-patient").style.display = "none";
    document.getElementById("submitBtn-patient").style.display = "none";
  } else {
    document.getElementById("prevBtn-patient").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn-patient").style.display="none";
    document.getElementById("submitBtn-patient").style.display="inline";
    document.getElementById("submitBtn-patient").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn-patient").style.display="inline";
    document.getElementById("nextBtn-patient").innerHTML = "Next";
  }
  fixStepIndicator(n, "patient");
}

function nextPrevPatient(n) {
  var x = document.getElementsByClassName("patientinfo");
  if (n == 1 && !validateForm("patient")) return false;
  x[currentPatient].style.display = "none";
  // Increase or decrease the current  by 1:
  currentPatient = currentPatient + n;
  // if you have reached the end of the form... :
  if (currentPatient >= x.length) {
    //...the form gets submitted:
    document.getElementById("patient-form").submit();
    document.getElementById("submitBtn").style.display = "block";

    return false;
  }
 
  showPatient(currentPatient);
}


var currentDoctor = 0;
showDoctor(currentDoctor);
function showDoctor(n) {
  var x = document.getElementsByClassName("doctorinfo");
  for (var i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("prevBtn-doctor").style.display = "none";
    document.getElementById("submitBtn-doctor").style.display = "none";
  } else {
    document.getElementById("prevBtn-doctor").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn-doctor").style.display="none";
    document.getElementById("submitBtn-doctor").style.display="inline";
    document.getElementById("submitBtn-doctor").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn-doctor").style.display="inline";
    document.getElementById("nextBtn-doctor").innerHTML = "Next";
  }
  fixStepIndicator(n, "doctor");
}

function nextPrevDoctor(n) {
  if (n == 1 && !validateForm("doctor")) return false;
  showDoctor(currentDoctor += n);
}

function validateForm(formType) {
  var valid = true;
  var x, y, i;
  if (formType === "patient") {
    x = document.getElementsByClassName("patientinfo");
    y = x[currentPatient].getElementsByTagName("input");
  } else {
    x = document.getElementsByClassName("doctorinfo");
    y = x[currentDoctor].getElementsByTagName("input");
  }
  for (i = 0; i < y.length; i++) {
    if (y[i].value == "") {
      y[i].className += " invalid";
      valid = false;
    }
  }
  if (valid) {
    document.getElementsByClassName(`step-${formType}`)[currentPatient || currentDoctor].className += " finish";
  }
  return valid;
}

function fixStepIndicator(n, formType) {
  var i, x = document.getElementsByClassName(`step-${formType}`);
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}



function checkRadioButton(){
  
  const selectedRadio = document.querySelector('input[name="agreement"]:checked');
  if(selectedRadio.value== "Agree"){
    document.getElementById("agreebtn").style.display="none";    
    document.getElementById("text").style.display="block";
  }
  else{
    window.alert("U must agree")
    location.reload();
  }
}



  </script>

</body>
</html>