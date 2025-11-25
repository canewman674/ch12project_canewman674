<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    
    <link rel="stylesheet" href="main.css">
</head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

   $conn = mysqli_connect("localhost", "root", "mysql", "taus_data");

    if (!$conn) {
        echo "<div class='message'>Database connection failed.</div>";
        exit();
    }

    $query = "SELECT firstName, lastName, email FROM tbl_student WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        echo "<div class='message'>";
        echo "Student Found: " . $row['firstName'] . " " . $row['lastName'] . "<br>";
        echo "Email: " . $row['email'];
        echo "</div>";
    } else {
        echo "<div class='message'>No student found with that email.</div>";
    }

    mysqli_close($conn);
}
?>
<p><a href="index.php">Return to Homepage</a></p>

</body>
</html>