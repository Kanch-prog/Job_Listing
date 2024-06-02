# Job Listing Website

## Overview
This project is a job listing website aimed at connecting employers and job seekers. It was designed and implemented using HTML, CSS, PHP with Object-Oriented Programming (OOP) principles, and MySQL for database management.

https://github.com/Kanch-prog/Job_Listing/assets/121807277/086f73ff-9fda-4a95-b8f1-7af5997a46da


## Features
- **User Authentication:** Employers and job seekers can create accounts and log in securely.
- **Job Listings:** Employers can post job opportunities with details such as job title, description, requirements, etc.
- **Job Search:** Job seekers can search for jobs based on various criteria like job title, location, industry, etc.
- **Apply for Jobs:** Job seekers can apply for jobs directly through the platform.
- **Messaging System:** Employers and job seekers can communicate securely through a messaging system.
- **User Profile:** Users can create and manage their profiles, including their resumes for job seekers.

## Technologies Used
- HTML
- CSS
- PHP
- MySQL

## Setup Instructions
1. Clone the repository: `git clone https://github.com/your-username/job-listing-website.git`
2. Import the database schema from `database/schema.sql`.
3. Configure the database connection in `config/db.php`.
4. Start the PHP server.

## File Structure
- **index.php:** Landing page of the website.
- **login.php:** Login page for users.
- **register.php:** Registration page for new users.
- **dashboard.php:** Dashboard page for logged-in users.
- **job_listing.php:** Page for displaying job listings.
- **job_details.php:** Page displaying details of a specific job.
- **profile.php:** User profile page.
- **messaging.php:** Messaging system for communication between users.
- **config/:** Configuration files.
- **includes/:** PHP files for reusable components.
- **css/:** Stylesheets.
- **js/:** JavaScript files.
- **images/:** Image assets.

## Database Schema
The database schema includes tables for users, jobs, messages, etc. Refer to `database/schema.sql` for the complete schema.

## Future Improvements
- Implementing a more advanced search functionality with filters.
- Adding features like job recommendations based on user profiles.
- Enhancing the messaging system with real-time chat functionality.

## Contributors
- [Kanchana Karunarathna](https://github.com/Kanch-prog)

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
