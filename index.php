<?php
include('db.php');
include('job.php');

// Instantiate job classes
$job = new Job();
// Get job listings
$jobs = $job->getAllJobs();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listing</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Job Listings</h1>
        <nav>
        <ul>
            <li <?php echo ($_SERVER['PHP_SELF'] == '/index.php') ? 'class="active"' : ''; ?>>
                <a href="index.php">Home</a>
            </li>
            <li <?php echo ($_SERVER['PHP_SELF'] == '/about.php') ? 'class="active"' : ''; ?>>
                <a href="about.php">About</a>
            </li>
            <li <?php echo ($_SERVER['PHP_SELF'] == '/contact.php') ? 'class="active"' : ''; ?>>
                <a href="contact.php">Contact</a>
            </li>
            <?php
            session_start();

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
    
    <section class="job-listings">
        <h2>All Jobs</h2>
        <div class="job">
    
    <?php
    foreach ($jobs as $job) {
        echo '<div class="job">';
        echo '<h3>' . $job['title'] . '</h3>';
        echo '<p>Company: ' . $job['company'] . '</p>';
        echo '<p>Location: ' . $job['location'] . '</p>';
        echo '<p>Description: ' . $job['description'] . '</p>';
        echo '<p>Salary: ' . $job['salary'] . '</p>';
        echo '</div>';
    }
    ?>
        </div>

    </section>
</body>
</html>
