<?php
if (isset($_POST['id'])) {
    $server = "localhost:3307";
    $username = "root";
    $password = "";
    $db = "us_trip";

    $con = mysqli_connect($server, $username, $password, $db);
    if (!$con) {
        die("Connection to this database failed due to" . mysqli_connect_error());
    }

    $id = $_POST["id"]; // Use $_POST instead of $_GET to retrieve the ID when updating.

    // Prepare and execute the update query using prepared statements to prevent SQL injection.
    $stmt = $con->prepare("UPDATE us_trip SET name=?, age=?, gender=?, email=?, phone=?, others=? WHERE id=?");
    $stmt->bind_param("ssssssi", $_POST["name"], $_POST["age"], $_POST["gender"], $_POST["email"], $_POST["phone"], $_POST["desc"], $id);
    $stmt->execute();

    // Check if the update was successful and set the $insert variable accordingly.
    $insert = ($stmt->affected_rows > 0);

   
    $con->close();
}

if (isset($_GET["id"])) {
    $server = "localhost:3307";
    $username = "root";
    $password = "";
    $db = "us_trip";

    $con = mysqli_connect($server, $username, $password, $db);
    if (!$con) {
        die("Connection to this database failed due to" . mysqli_connect_error());
    }

    $id = $_GET["id"];
    $query = "SELECT * FROM us_trip WHERE id=$id";
    $data = mysqli_query($con, $query);
    $result = mysqli_fetch_assoc($data);

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
    <link rel="stylesheet" href="project/style.css">
</head>
<body>
    <img class="bg" src="https://www.theindianwire.com/wp-content/uploads/2020/05/iit.jpg" alt="IIT Kharagpur" style="width: 100%;" >
    <div class="container">
        <h1>Welcome to IIT Kharagpur US Trip form</h1>
        <p>UPDATE YOUR DETAILS IN FORM </p>
        <?php
        if (isset($insert) && $insert) {
            echo "<p class='submitMsg'>Thanks for submitting your form. We are happy to see you joining us for the US trip</p>";
        }
        ?>
        <form action="update_form.php" method="post"> <!-- Changed form action and method -->
            <!-- Add a hidden input field to send the ID when updating -->
            <input type="hidden" name="id" value="<?php echo isset($result['id']) ? $result['id'] : ''; ?>">
            <input type="text" name="name" value="<?php echo isset($result['name']) ? $result['name'] : ''; ?>" id="name" placeholder="Enter your name">
            <input type="text" name="age" id="age" placeholder="Enter your Age" value="<?php echo isset($result['age']) ? $result['age'] : ''; ?>">
            <input type="text" name="gender" id="gender" placeholder="Enter your gender" value="<?php echo isset($result['gender']) ? $result['gender'] : ''; ?>">
            <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo isset($result['email']) ? $result['email'] : ''; ?>">
            <input type="password" name="phone" id="phone" placeholder="Enter your phone" value="<?php echo isset($result['phone']) ? $result['phone'] : ''; ?>">
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"><?php echo isset($result['others']) ? $result['others'] : ''; ?></textarea>
            <button class="btn">Submit</button>
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>
