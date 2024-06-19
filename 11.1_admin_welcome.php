<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
    <style>
        body {
            background-color: #2c3e50; /* Background color */
            color: #ecf0f1; /* Text color */
            font-family: 'Arial', sans-serif;
            text-align: center;
        }

        h2 {
            color: #3498db; /* Header text color */
        }

        button {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            background-color: #27ae60; /* Button background color */
            color: #fff; /* Button text color */
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #219d54; /* Hover state color */
        }

        input[type="submit"] {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            background-color: #e74c3c; /* Logout button background color */
            color: #fff; /* Logout button text color */
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #c0392b; /* Hover state color */
        }
    </style>
</head>

<body>

    <?php
    // Check if the user is logged in
    session_start();
    if (isset($_SESSION["a_id"])) {
        echo "<h2>Welcome, " . $_SESSION["a_id"] . "!</h2>";
    } else {
        // Redirect to the login page if the user is not logged in
        header("location: 11.1_admin_login.html");
        exit();
    }
    ?>

    <!-- Display the buttons for "Add" and "Update" -->
    To add feedback form click here:<button onclick="window.location.href='add.php'">Add</button><br><br>
    To update feedback form click here:<button onclick="window.location.href='update.php'">Update</button><br><br><br><br>

    <!-- Logout button -->
    <form method="post" action="11.1_admin_logout.php">
        <input type="submit" value="Logout">
    </form>

</body>

</html>
