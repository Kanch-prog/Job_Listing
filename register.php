<?php
// Include the User class and any necessary dependencies
require_once('user.php');
require_once('db.php'); // Assuming you have a Database class

// Initialize the User class
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Call the registerUser method from the User class
    $registration_result = $user->registerUser($username, $password, $confirm_password);

    // Display the result to the user
    echo $registration_result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS styles here -->
</head>
<body>
    <header>
        <h1>Registration</h1>
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="login-form">
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br>

            <input type="submit" value="Register">
        </form>
    </section>
</body>
</html>
