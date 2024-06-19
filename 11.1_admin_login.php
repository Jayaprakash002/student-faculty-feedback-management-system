<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (replace with your actual database credentials)
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "feedback_db";

    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get input values from the form
    $username = $_POST["Uname"];
    $password = $_POST["Pass"];

    // Perform SQL query to check if the user exists in the database (replace with your actual query)
    $query = "SELECT * FROM admin WHERE a_id = '$username' AND a_pswd = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == TRUE) {
        // User authentication successful
        session_start();
        $_SESSION["a_id"] = $username;
        header("location: 11.1_admin_welcome.php"); // Redirect to the welcome page
        exit();
    } else {
        // User authentication failed
        echo "Invalid username or password";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

