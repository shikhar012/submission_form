<?php
if(isset($_POST['name'])){
$server="localhost:3307";
$username="root";
$password= ""; 
$insert;

$con = mysqli_connect($server,$username,$password);
if(!$con)
{
    die("Connection to this databse failed due to".mysqli_connect_error()); // tell what type of error
}

//echo "successfully connecting to the db";
$name=$_POST["name"];
$age=$_POST["age"];
$gender=$_POST["gender"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$desc=$_POST["desc"]; 
$sql="INSERT INTO `us_trip`.`us_trip` ( `name`, `age`, `gender`, `email`, `phone`, `others`, `date`) 
VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', current_timestamp());";
//echo $sql;

if($con->query($sql)==true)
{
    $insert=true ;
   // echo "succes inserted";
}
else{
    echo "ERROR: $sql <br> $con->error";
}
$con->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="bg" src="https://www.theindianwire.com/wp-content/uploads/2020/05/iit.jpg" alt="IIT Kharagpur" style="width: 100%;" >
    <div class="container">
        <h1>Welcome to IIT Kharagpur US Trip form</h3>
        <p>Enter your details and submit this form to confirm your participation in the trip </p>
        <?php
     if($insert == true){
        echo "<p class='submitMsg'>Thanks for submitting your form. We are happy to see you joining us for the US trip</p>";
        }
         ?>
        
        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name">
            <input type="text" name="age" id="age" placeholder="Enter your Age">
            <input type="text" name="gender" id="gender" placeholder="Enter your gender">
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="phone" name="phone" id="phone" placeholder="Enter your phone">
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
            <button class="btn">Submit</button> 
        </form>
    </div>
    <script src="index.js"></script>

</body>
</html>