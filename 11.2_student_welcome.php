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

// Check if the user is logged in
session_start();
if (!isset($_SESSION["s_id"])) {
    // Redirect to the login page if the user is not logged in
    header("location: 11.2_student_login.html");
    exit();
}

// Retrieve additional information from the student table
$userId = $_SESSION["s_id"];
$query = "SELECT s_name, s_branch, s_section, s_semester FROM student WHERE s_id = '$userId'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $studentName = $row["s_name"];
    $branch = $row["s_branch"];
    $section = $row["s_section"];
    $semester = $row["s_semester"];
} else {
    // Handle the case where user information is not found
    $studentName = "Unknown";
    $branch = "Unknown";
    $section = "Unknown";
    $semester = "Unknown";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            background-color: #0b72d35b;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 100px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(9, 130, 160, 0.897);
        }
        .button {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>DEPARTMENT of <?php echo $branch; ?></h1>
    <h2>Welcome, <?php echo $studentName; ?>!</h2>
    <p>Branch: <?php echo $branch; ?></p>
    <p>Section: <?php echo $section; ?></p>
    <p>Semester: <?php echo $semester; ?></p>

    <div class="container">
        <h2>Select Feedback Type</h2>
        <a href="11.2_student_FB_form.html" class="button">Student Feedback</a>
        <a href="11.2_satisfaction_FB_form.html" class="button">Student Satisfaction Feedback</a>
        <!-- <a href="hostel_feedback.html" class="button">Hostel Feedback</a>-->
        <a href="11.2_library_FB_form.html" class="button">Library Feedback</a>
        <a href="11.2_exit_FB_form.html" class="button">Exit Feedback</a>
    </div>
    
    <!-- Logout button -->
    <form method="post" action="11.2_student_Logout.php">
        <input type="submit" value="Logout">
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
