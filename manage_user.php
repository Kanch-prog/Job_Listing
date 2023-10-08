<?php
require_once('db.php'); // Include the Database class
include('user.php'); // Include the User class

// Create a new instance of the Database class
$database = new Database();
$db = $database->connect();

$user = new User();
    

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


    <h2>Manage Users</h2>
    <table border="1">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to fetch user data from the database
            $sql = "SELECT id, username, role FROM users";
            
            // Execute the query and fetch user data
            $result = $db->query($sql);

            if ($result === false) {
                die("Query failed: " . $db->error);
            }

            // Loop through the results and display user data in table rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td><a href='edit_user.php?id=" . $row['id'] . "'>Edit</a></td>";
                echo "<td><a href='delete_user.php?id=" . $row['id'] . "'>Delete</a></td>";
                echo "</tr>";              
               
            }
            ?>
        </tbody>
    </table>

