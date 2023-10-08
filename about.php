<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS styles here -->
</head>
<body>
    <header>
        <h1>About Us</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php" class="active">About</a></li> <!-- Highlight the "About" link as it's the current page -->
                <li><a href="contact.php">Contact</a></li>
                
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

    <section class="about">
        <h2>Our Mission</h2>
        <p>
            Welcome to our job listing website! Our mission is to connect job seekers with employers and provide a platform where companies can post job openings for talented individuals.
        </p>

        <h2>Our Team</h2>
        <p>
            We have a dedicated team of professionals who are passionate about helping job seekers find the perfect job and assisting employers in finding top talent. Our team is committed to making the job search and recruitment process as smooth as possible.
        </p>

        <h2>Contact Us</h2>
        <p>
            If you have any questions or feedback, please feel free to <a href="contact.php">contact us</a>. We value your input and are here to assist you.
        </p>
    </section>
</body>
</html>
