<?php
// Include necessary files and classes
require_once('user.php');
require_once('db.php'); // Include the Database class

// Initialize the User class
$user = new User();

$login_result = ""; // Initialize the login result variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Call the loginUser method from the User class
    $login_result = $user->loginUser($username, $password);

    if ($login_result === "Login successful") {
        // Start a session
        session_start();

        // Set a session variable to track the user's login status
        $_SESSION['admin'] = $username;
        header("Location: admin.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS styles here -->
</head>
<body>
    <header>
        <h1>Login</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <section class="login-form">
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Login">            
        </form>
       
    </section>
</body>
</html>
