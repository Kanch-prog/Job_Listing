<?php
require_once('db.php'); // Include the Database class
include('job.php'); // Include the Job class
include('pagination.php');

$database = new Database();
$db = $database->connect();

$job = new Job();

// Number of jobs to display per page
$itemsPerPage = 8;

// Get the total number of jobs from the database
$totalJobs = $job->getTotalJobs();

// Determine the current page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Create a Pagination instance
$pagination = new Pagination($totalJobs, $itemsPerPage, $currentPage);

// Calculate the SQL LIMIT clause for the current page
$offset = $pagination->getOffset();

// Query to fetch jobs for the current page
$sql = "SELECT * FROM jobs LIMIT $offset, $itemsPerPage";

// Execute the query and fetch job data
$result = $db->query($sql);

if ($result === false) {
    die("Query failed: " . $db->error);
}
?>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Optional: Add some spacing between table cells */
        td {
            padding: 8px 12px;
        }

        /* Style for the Edit and Delete links */
        .edit-link, .delete-link {
            text-decoration: none;
            color: #007bff; /* Blue color for links */
            margin-right: 10px; /* Add some space between the links */
        }
    </style>
</head>

<h2>Manage Jobs List</h2>
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
        // Loop through the results and display job data in table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['company'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['salary'] . "</td>";
            echo "<td><a href='edit_job.php?id=" . $row['id'] . "'>Edit</a></td>";
            echo "<td><a href='delete_job.php?id=" . $row['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Generate pagination links -->
<div class="pagination">
    <?php for ($page = 1; $page <= $pagination->getTotalPages(); $page++) { ?>
        <a href="admin.php?section=manage_job&page=<?php echo $page; ?>"><?php echo $page; ?></a>
    <?php } ?>
</div>
