<?php
// user.php
class User {
    protected $db;
    protected $table = "users";

    public function __construct() {
        $database = new Database(); // Assuming you have a Database class
        $this->db = $database->connect();
    }

    public function loginUser($username, $password) {
        // Start the session
        session_start();
        
        // Sanitize user input (not the most secure way, consider better sanitization)
        $username = $this->db->real_escape_string($username);
    
        // Retrieve the user's data from the database
        $sql = "SELECT id, username, password, role FROM users WHERE username = '$username'";
        $result = $this->db->query($sql);
    
        if (!$result) {
            echo "Error: " . $this->db->error;
            return;
        }
    
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];
            $stored_password = $row['password'];
            $user_role = $row['role'];
    
            // Verify the provided password against the stored hashed password
            if (password_verify($password, $stored_password)) {
                // Authentication succeeds
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_role'] = $user_role;
    
                // Redirect based on user role
                if ($user_role === 'admin') {
                    header("Location: admin.php"); // Redirect to the admin dashboard
                } else {
                    header("Location: normalUser.php"); // Redirect to the normal user dashboard
                }
                exit();
            }
        }
    
        // Authentication failed, display an error message or redirect to a login error page
        echo "Authentication failed. Please try again.";
    }
    


    public function registerUser($username, $password, $confirm_password) {
        // Check if the password and confirm_password match
        if ($password !== $confirm_password) {
            return "Passwords do not match. Please try again.";
        }

        // Sanitize user input (not the most secure way, consider better sanitization)
        $username = $this->db->real_escape_string($username);

        // Check if the username already exists
        $check_username_query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->db->query($check_username_query);

        if ($result->num_rows > 0) {
            return "Username already exists. Please choose a different username.";
        }

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $insert_user_query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

        if ($this->db->query($insert_user_query) === TRUE) {
            return "Registration successful. You can now <a href='login.php'>login</a>.";
        } else {
            return "Error: " . $this->db->error;
        }
    }

    public function deleteUser($user_id) {
        // Sanitize user input (not the most secure way, consider better sanitization)
        $user_id = $this->db->real_escape_string($user_id);

        // Execute a SQL query to delete the user with the specified ID
        $delete_query = "DELETE FROM $this->table WHERE id = '$user_id'";

        if ($this->db->query($delete_query) === TRUE) {
            return "User deleted successfully.";
        } else {
            return "Error deleting user: " . $this->db->error;
        }
    }

    
}
?>