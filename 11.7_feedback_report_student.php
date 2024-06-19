<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #3498db;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #ecf0f1;
        }

        tr:hover {
            background-color: #d4e6f1;
        }

    </style>
</head>
<body>

<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in as principal
if (!isset($_SESSION["p_id"])) {
    // Redirect to the login page if the user is not logged in
    header("location: 11.7_principal_login.html");
    exit();
}

// Include the database connection code here
$host = "localhost";
$username = "root";
$password = "";
$database = "feedback_db";

$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student details and feedback names from the database
$sql = "SELECT DISTINCT student_name, branch, section, semester FROM std_feedback";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Total Students and Feedback Details</h2>";
    echo "<table>";
    echo "<tr><th>Student Name</th><th>Branch</th><th>Section</th><th>Semester</th><th>Total Feedbacks</th><th>Feedback Names</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $studentName = $row["student_name"];
        $branch = $row["branch"];
        $section = $row["section"];
        $semester = $row["semester"];

        // Count the total feedbacks for each student
        $feedbackCount = $conn->query("SELECT COUNT(*) as total FROM std_feedback WHERE student_name = '$studentName' AND branch = '$branch' AND section = '$section' AND semester = '$semester'")->fetch_assoc()["total"];

        // Fetch feedback names for each student
        $feedbackNames = $conn->query("SELECT GROUP_CONCAT(DISTINCT feedback_name SEPARATOR ', ') as names FROM std_feedback WHERE student_name = '$studentName' AND branch = '$branch' AND section = '$section' AND semester = '$semester'")->fetch_assoc()["names"];

        echo "<tr><td>$studentName</td><td>$branch</td><td>$section</td><td>$semester</td><td>$feedbackCount</td><td>$feedbackNames</td></tr>";
    }

    echo "</table>";
} else {
    echo "<p>No feedback available from students.</p>";
}

// Close the database connection here
$conn->close();
?>

</body>
</html>
