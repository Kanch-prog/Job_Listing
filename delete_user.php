<?php
require_once('db.php'); // Include the Database class
include('user.php'); // Include the User class

// Create a new instance of the Database class
$database = new Database();
$db = $database->connect();

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    // Create a new instance of the User class
    $user = new User();
    
    // Call the deleteUser method to delete the specific user
    $deleteResult = $user->deleteUser($user_id);

    // Check the result of the deletion
    if (strpos($deleteResult, 'successfully') !== false) {
        echo $deleteResult; // User deleted successfully.
        header("Location: admin.php#manage_user");
        exit();
    } else {
        echo $deleteResult; // Error deleting user: ...
    }
} else {
    echo "Invalid user ID.";
}
?>