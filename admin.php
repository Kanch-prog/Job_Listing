<?php
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== "admin") {
    // If the session variable is not set, redirect to the login page
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="#manage_user">Manage Users</a></li>
                <li><a href="#manage_job">Manage Jobs</a></li>
                <li><a href="#add_job">Add Job</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main id='content'>
        
    </main>


    <script>
        // Function to handle route changes
        function handleRouteChange() {
            // Get the current hash value (e.g., #home, #about, #contact)
            const hash = window.location.hash;

            // Get the content element where you want to display the content
            const contentElement = document.getElementById("content");

            // Define routes and their corresponding content
            const routes = {
                "#manage_user": "manage_user.php", // Fetch load_manage_user.php
                "#manage_job": "manage_job.php",
                "#add_job": "add_job.php"
            };

            // Check if the hash exists in the routes object
            if (routes[hash]) {
                // Use fetch to load content
                fetch(routes[hash])
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.text();
                    })
                    .then(data => {
                        contentElement.innerHTML = data;
                    })
                    .catch(error => {
                        console.error("Error loading content:", error);
                    });
            } else {
                // Handle 404 or unknown route
                contentElement.innerHTML = "Select the navigation bar links for desired functions.";
            }
        }

        window.addEventListener("load", handleRouteChange);
        window.addEventListener("hashchange", handleRouteChange);
            
    </script>

    
</body>
</html>

