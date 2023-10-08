<?php
require_once('db.php'); // Include the Database class
include('job.php'); // Include the Job class

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    // Get the job ID from the URL
    $job_id = $_GET['id'];

    // Create a new instance of the Database class
    $database = new Database();
    $db = $database->connect();

    $job = new Job();

    // Call the deleteJob method to delete the specific job
    $deleteResult = $job->deleteJob($job_id);

    // Check the result of the deletion
    if (strpos($deleteResult, 'successfully') !== false) {
        // Redirect back to the job management page if the deletion was successful
        header("Location: admin.php#manage_job");
        exit();
    } else {
        echo $deleteResult; // Display an error message if deletion fails
    }
} else {
    echo "Invalid job ID."; // Display an error message if 'id' is not set in the URL
}
?>
