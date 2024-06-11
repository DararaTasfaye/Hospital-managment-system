
<?php
$user="";
$pwd ="";
$connect = new mysqli('localhost','$user','$pwd','hms idea');
if($connect-> connect_error){
    echo "Error" .$connect->connect_error;
    }
$msg[]="";

if(isset($_POST['Send'])){
    $name =$_POST['name'];
    $Fath_Name =$_POST['Fname'];
    $Moile =$_POST['phonenum'];
    $Email =$_POST['email'];
    $comment =$_POST['message'];
    $hour = date("h:i:sa");
    $date =date('d');
    $month= date('m');
    $year = date("Y");
    
$insert = "INSERT INTO user(Name, FName, Phone, Email, Comment, Hour, Date, Month, Year) VALUES('$name' ,'$Fath_Name','$Moile','$Email','$comment','$hour','$date','$month','$year')";

$stmt = $connect->prepare($insert);
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link href="home.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header container">
            <!-- <h1>Hello</h1> -->
            <div class="navbar">
                <div class="logo">
                    <a href="#"> <img src="./image/Icon.png" alt="icon">
                    <h1>MediLab</h1></a>

                </div>
                <div class="navlist">
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="#aboutus">About Us</a></li>

                    </ul>
                </div>
                <div class="buttons">
                    <button><a href="login.php">Sign In</a></button>
                </div><br>
              
            </div>

        </div>
        <hr style="display: block; color: blue; width:90%;  margin: auto 2%;">
    </header>
    <section id="home">
        <div class="home container">
            <div class="home_txt">
                <h1>We help people to get appointment in online</h1>
                <p>Hospital Management Systems (HMS) play a crucial role. At Medinous, we take pride in offering a 
                    comprehensive Hospital Management System that ensures ideal end-to-end information flow, 
                    empowering hospitals with critical insights.</p>
                    <a href="signup.php"><button>Register</button></a>
            </div>
            <div class="home_photo">
                <img src="./image/doctosr.jpg" alt="Ethiopian Doctors">
            </div>
        </div>
    </section>
    <section id="aboutus">
        <div class="about container">
            <div class="home_photo">
                 <img src="./image/Doctor2.jpg" alt="Ethiopian Doctors">
            </div>
            <div class="about_txt">
                <h1>Who We Are?</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Rem ut officiis corrupti qui odit laudantium, molestias perspiciatis
                      quis autem laborum magnam eius 
                    nobis dolorum cumque, saepe sed. Voluptatem, sint doloribus?</p>
            </div>
           
        </div>
    </section>
    <section id="services">
        <div class="services container">
            <div class="section-title">
                <h1>Our Services</h1>
            </div>
     
            <div class="our_services">

<div class="each_services fade">
    <div class="photo">
    <div class="services_photo">
       
        <img src="./image/Laboratory.jpg" alt="">
        <h2>Laboratory</h2>
    </div>
    <div class="services_photo">
        <img src="./image/Surgery.jpg" alt="">
        <h2>Surgery</h2>
    </div>
    <div class="services_photo">
        <img src="./image/Emergency.jpg" alt="">
        <h2>Emergency</h2>
   </div> 
</div>
</div>

<div class="each_services fade">
    <div class="photo">
    <div class="services_photo">
        <img src="./image/Pharmacy.jpg" alt="">
        <h2>Pharmacy</h2>
    </div>
    <div class="services_photo">
        <img src="./image/Dental.jpg" alt="">
        <h2>Dental</h2>
    </div>
    <div class="services_photo">
        <img src="./image/Radiology.jpg" alt="">
        <h2>Radiology</h2>
   </div> 
</div>
</div>

<div class="each_services fade">
    <div class="photo">
    <div class="services_photo">
        <img src="./image/Ambulance.jpg" alt="">
        <h2>Ambulance</h2>
    </div>
    <div class="services_photo">
        <img src="./image/counseling.JPG" alt="">
        <h2>Counseling</h2>
    </div>
    <div class="services_photo">
        <img src="./image/image.png" alt="">
        <h2>Neurosciencei</h2>
   </div>
</div> 
</div>

</div>
<br>

<div style="text-align:center">
  <span class="step"></span> 
  <span class="step"></span> 
  <span class="step"></span> 
</div>
        </div>
    </section>
<section id="contact">
    <div class="contact container">
        <form action="" method="post">
        <h1>Send Us Message</h1>
        <div class="textinput">

        <input type="text" name="name" placeholder="First Name">
        <input type="text" name="Fname" placeholder="Last name">
        </div>
        <div class="contactinfo">
        <input type="tel"  name="phonenum" placeholder="Mobile Number">
        <input type="email" name="email" placeholder="Eg. example@example.come">
        </div>
        <textarea name="message" rows="4" placeholder="Write something here..."></textarea>
        <input type="submit" name="Send" value="Send">
        <?php
            foreach($msg as $msg){
                echo $msg;
            }
        ?>
         </form>
        
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
                <li>Adama Ethiopia</li>
            </ul>
       </div>
    </div>
</footer>


<script>
    var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("each_services");
    var steps = document.getElementsByClassName("step");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < steps.length; i++) {
        steps[i].className = steps[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    steps[slideIndex-1].className += " active";
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

</body>
</html>