<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Feedback Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: #fff;
        }
        tr:hover {
            background-color: #f5f5f5;
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

    // Fetch alumni names and feedback names from the database
    $sql = "SELECT DISTINCT alumni_name FROM alumni_feedback";
    $result = $conn->query($sql);
    ?>

    <h2>Total Alumni and Feedback Details</h2>

    <?php
    if ($result->num_rows > 0) {
        ?>
        <table>
            <tr>
                <th>Alumni Name</th>
                <th>Feedback Names</th>
            </tr>

            <?php
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $alumniName = $row["alumni_name"];

                // Fetch feedback names for each alumni
                $feedbackNames = $conn->query("SELECT GROUP_CONCAT(DISTINCT feedback_name SEPARATOR ', ') as names FROM alumni_feedback WHERE alumni_name = '$alumniName'")->fetch_assoc()["names"];

                echo "<tr><td>$alumniName</td><td>$feedbackNames</td></tr>";
            }
            ?>

        </table>
        <?php
    } else {
        echo "<p>No feedback available from alumni.</p>";
    }

    // Close the database connection here
    $conn->close();
    ?>
</body>
</html>
