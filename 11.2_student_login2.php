<?php
// Establish a connection to the database
$host = "localhost";
$username = "root";
$password = "";
$database = "feedback_db";

$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $userId = $_POST["userId"];
    $password = $_POST["password"];
    $branch = $_POST["Branch"];
    $section = $_POST["Section"];

    // SQL query to check if the user exists in the database
    $query = "SELECT * FROM student WHERE s_id = '$userId' AND s_pswd = '$password' AND s_branch = '$branch' AND s_section = '$section'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Start a session and store user information
        session_start();
        $_SESSION["s_id"] = $userId;
        $_SESSION["s_branch"] = $branch;
        $_SESSION["s_section"] = $section;

        // Redirect to the welcome page
        header("Location: 11.2_student_welcome.php");
        exit();
    } else {
        // User doesn't exist or credentials are incorrect, display an error message
        echo "Invalid login credentials";
    }
}

// Close the database connection
$conn->close();
?>
