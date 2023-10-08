<?php
session_start();
include_once('db.php');
include('job.php');

// Check if the user is logged in and is a normal user
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== "user") {
    // If not logged in or not a normal user, redirect to the login page
    header("Location: login.php");
    exit();
}

// Get the user's ID from the session
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
        // Form was already submitted, ignore this request
        header("Location: normalUser.php");
        exit();
    }
        
    $job = new Job();

    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];

    // Check if the connection to the database was successful
    if ($job->db) {
        $result = $job->addJobListing($title, $company, $location, $description, $salary, $user_id);
        echo $result;
        
    } else {
        echo "Error: Unable to connect to the database.";
    }
    $_SESSION['form_submitted'] = true;

    // Redirect to the same page to avoid form resubmission
    header("Location: normalUser.php");
    exit();
}

$job = new Job();

// Get jobs posted by the logged-in user
// Get the user's ID from the session
$userId = $_SESSION['user_id'];

// Get jobs posted by the logged-in user
$userJobs = $job->getJobsByUserId($userId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normal User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="user_styles.css">
</head>
<body>
    <header>
        <h1>Normal User Dashboard</h1>
        <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['user_id'])) {
                // If logged in, display a logout link
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                // If not logged in, display a login link
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="register.php">Register</a></li>';
            }
            ?>
        </ul>
    </nav>

    </header>

    <main>
        <h2>Add Job</h2>
        <section class="job-form">
        <form action="normalUser.php" method="POST">
            <label for="title">Job Title:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="company">Company:</label>
            <input type="text" id="company" name="company" required><br>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea><br>

            <label for="salary">Salary:</label>
            <input type="text" id="salary" name="salary" required><br>

            <input type="submit" value="Submit">
        </form>
        </section>

        <h2>Your Jobs</h2>
        <!-- Display a list of jobs posted by the user -->
        <table border="1">
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Title</th>
                <th>Company</th>
                <th>Location</th>
                <th>Description</th>
                <th>Salary</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($userJobs as $userJob) {
                echo "<tr>";
                echo "<td>" . $userJob['id'] . "</td>";
                echo "<td>" . $userJob['title'] . "</td>";
                echo "<td>" . $userJob['company'] . "</td>";
                echo "<td>" . $userJob['location'] . "</td>";
                echo "<td>" . $userJob['description'] . "</td>";
                echo "<td>" . $userJob['salary'] . "</td>";
                echo "<td><a href='edit_job.php?id=" . $userJob['id'] . "'>Edit</a></td>";
                echo "<td><a href='delete_job.php?id=" . $userJob['id'] . "'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </main>
</body>
</html>