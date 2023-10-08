<?php
include_once('db.php');
include('job.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job = new Job();

    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];

    // Check if the connection to the database was successful
    if ($job->db) {
        $result = $job->addJobListing($title, $company, $location, $description, $salary);

        // Check if the job was added successfully
        if ($result === "Job added successfully") {
            // Start the session (if not already started)
            session_start();

            // Check the user's role
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                // Redirect an admin user to the admin dashboard
                header("Location: admin.php");
                exit();
            } else {
                // Redirect a normal user to the normal user dashboard
                header("Location: normalUser.php");
                exit();
            }
        } else {
            echo $result; // Display an error message if job addition failed
        }
    } else {
        echo "Error: Unable to connect to the database.";
    }
}
?>

<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   
    <h2>Add Job Listing</h2>
    <a href="index.php">Back to Job Listings</a>
    <section class="job-form">
        <form action="add_job.php" method="POST">
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
</body>

