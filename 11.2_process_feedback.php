<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION["s_id"])) {
    // Redirect to the login page if the user is not logged in
    header("location: 11.2_student_login.html");
    exit();
}

// Retrieve student details from session
$studentID = $_SESSION["s_id"];
$branch = $_SESSION["s_branch"];
$section = $_SESSION["s_section"];

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

// Prepare and execute the SQL statement to retrieve student's name and semester
$sql = "SELECT s_name, s_semester FROM student WHERE s_id = ?";
$stmt = $conn->prepare($sql);

// Check if the preparation of the statement was successful
if (!$stmt) {
    die("Error in preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $studentID);

// Check if the binding of parameters was successful
if (!$stmt->bind_param("s", $studentID)) {
    die("Error in binding parameters: " . $stmt->error);
}

$stmt->execute();

// Check if the execution of the statement was successful
if (!$stmt) {
    die("Error in executing statement: " . $conn->error);
}

$stmt->bind_result($studentName, $semester);

// Fetch the result
$stmt->fetch();

// Check if the fetch was successful
if (!$studentName || !$semester) {
    // Handle the case where user information is not found
    $studentName = "Unknown";
    $semester = "Unknown";
}

// Close the statement to allow the execution of a new one
$stmt->close();

// Retrieve feedback name from the form
$feedbackName = $_POST['feedback_name'];

// Prepare and execute the SQL statement to insert feedback data into the database
$sqlInsert = "INSERT INTO std_feedback (student_name, branch, semester, section, feedback_name) VALUES (?, ?, ?, ?, ?)";
$stmtInsert = $conn->prepare($sqlInsert);

// Check if the preparation of the insert statement was successful
if (!$stmtInsert) {
    die("Error in preparing insert statement: " . $conn->error);
}

$stmtInsert->bind_param("sssss", $studentName, $branch, $semester, $section, $feedbackName);

// Check if the binding of parameters for insert statement was successful
if (!$stmtInsert->bind_param("sssss", $studentName, $branch, $semester, $section, $feedbackName)) {
    die("Error in binding parameters for insert statement: " . $stmtInsert->error);
}

if ($stmtInsert->execute()) {
    echo "<div class='container'><h2>Your feedback has been submitted successfully! Thank you!</h2></div>";
} else {
    echo "Error: " . $stmtInsert->error;
}

// Close the insert statement and database connection
$stmtInsert->close();
$conn->close();
?>
