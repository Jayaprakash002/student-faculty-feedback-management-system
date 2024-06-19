<?php
// Start session to retrieve faculty name (assuming it's stored during login)
session_start();

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
    $feedbackName = $_POST["feedback_name"];

    // Retrieve faculty name from the session
    $alumniName = $_SESSION["a_id"]; // Assuming the faculty name is stored in the session during login

    // Insert faculty name and feedback name into the database
    $query = "INSERT INTO alumni_feedback (alumni_name, feedback_name) VALUES ('$alumniName', '$feedbackName')";
    
    if (mysqli_query($conn, $query)) {
        // Feedback submitted successfully
        echo "Thank you for submitting your feedback, $alumniName!";
    } else {
        // Error in query execution
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
