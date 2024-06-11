<?php
$user="";
$pwd ="";
$connect = mysqli_connect('localhost','$user','$pwd','hms idea');

if ($connect->connect_error) {
    echo "Error " . $connect->connect_error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Notification</title>
    <link rel="stylesheet" href="Admin.css">
    
   
</head>

<body>
    <header>
        <div class="header container">
            <div class="navbar">
                <div class="logo">
                    <a href="#"> <img src="./image/Icon.png" alt="icon">
                        <h1>MediLab</h1></a>
                </div>
            </div>
            <h3>Old Message</h3>
        </div>
        <hr style="display: block; color: blue; width:90%;  margin: auto 2%;">
    </header>

    <?php
    $msg = "SELECT * FROM user WHERE Checked = 1";
    $result = mysqli_query($connect, $msg);
    if (mysqli_num_rows($result) > 0) {
        $counter = 1;
        echo "<div class='notification'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $msg_ID = $row['ID'];
            $name = $row['Name'];
            $FName = $row['FName'];
            $Phone = $row['Phone'];
            $Email = $row['Email'];
            $Comment = $row['Comment'];
            $hour = $row['Hour'];
            $date = $row['Date'];
            $month = $row['Month'];
            $year = $row['Year'];
            $checked = $row['Checked'];

            echo "<div class='Each_msg'>";
            echo "<div class='counter'>";
            echo "$counter";
            echo "</div>";
            echo "<div class='msg-id' style='display:none'>";
            echo "$msg_ID";
            echo "</div>";

            echo "<div>";
            echo "<h2 style='color: blue; text-align: center;'>Name</h2>";
            echo "<hr style='display: block; color: blue; width:90%;  margin: auto 2%;'>";
            echo "<h2>Name: $name $FName</h2>";
            echo "<h2>Send Comment on: $date / $month / $year</h2>";
            echo "<h2>Send Comment at: $hour</h2>";
            echo "</div>";

            echo "<div>";
            echo "<h2 style='color: blue; text-align: center;'>Sender Contact Address</h2>";
            echo "<hr style='display: block; color: blue; width:90%;  margin: auto 2%;'>";
            echo "<h2>Email: $Email</h2>";
            echo "<h2>Phone Number: $Phone</h2>";
            echo "</div>";

            echo "<div>";
            echo "<h2 style='color: blue; text-align: center;'>Sender Comment</h2>";
            echo "<hr style='display: block; color: blue; width:90%;  margin: auto 2%;'>";
            echo "<div class='comment'>";
            echo "<h2>$Comment</h2>";
            echo "</div>";
            echo "</div>";
        

            $counter++;
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "No New Message";
    }
    ?>
</body>

</html>