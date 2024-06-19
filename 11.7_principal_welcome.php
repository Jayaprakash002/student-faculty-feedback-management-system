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
    <?php
    // Check if the user is logged in
    session_start();
    if (isset($_SESSION["p_id"])) {
        echo "<h2>Welcome, " . $_SESSION["p_id"] . "!</h2>";
    } else {
        // Redirect to the login page if the user is not logged in
        header("location: 11.7_principal_login.html");
        exit();
    }
    ?>
    <div class="container">
        <h2>Select Feedback Type To View Feedback Report</h2>
        <a href="11.7_feedback_report_student.php" class="button">Students Feedback</a>
        <a href="11.7_feedback_report_alumni.php" class="button">Alumni Feedback</a>
        <a href="11.7_feedback_report_faculty.php" class="button">Faculty Feedback</a>
        <a href="11.7_feedback_report_emp.php" class="button">Employee's Feedback</a>
    </div>
    
    <!-- Logout button -->
    <form method="post" action="11.7_principal_Logout.php">
        <input type="submit" value="Logout">
    </form>
</body>
</html>