<?php
// job.php
include_once('db.php');

class Job {
    public $db;
    protected $table = "jobs";

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAllJobs() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->db->query($query);
        $jobs = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }

        return $jobs;
    }

    public function addJobListing($title, $company, $location, $description, $salary) {
        // Escape user input to prevent SQL injection (not as secure as prepared statements)
        $title = mysqli_real_escape_string($this->db, $title);
        $company = mysqli_real_escape_string($this->db, $company);
        $location = mysqli_real_escape_string($this->db, $location);
        $description = mysqli_real_escape_string($this->db, $description);
        $salary = mysqli_real_escape_string($this->db, $salary);

        $sql = "INSERT INTO jobs (title, company, location, description, salary) VALUES ('$title', '$company', '$location', '$description', '$salary')";

        if ($this->db->query($sql) === TRUE) {
            return "Job listing added successfully.";
        } else {
            return "Error: " . $this->db->error;
        }
    }

    public function deleteJob($job_id) {
        // Ensure $job_id is properly sanitized (e.g., using prepared statements)
        $job_id = $this->db->real_escape_string($job_id);

        // Create and execute the SQL query to delete the job
        $sql = "DELETE FROM $this->table WHERE id = '$job_id'";
        $result = $this->db->query($sql);

        if ($result === true) {
            return "Job deleted successfully.";
        } else {
            return "Error deleting job: " . $this->db->error;
        }
    }

    public function getTotalJobs() {
        // Create and execute an SQL query to count the total number of jobs
        $sql = "SELECT COUNT(*) AS total_jobs FROM $this->table";
        $result = $this->db->query($sql);

        if ($result === false) {
            return 0; // Return 0 if there was an error
        }

        $row = $result->fetch_assoc();
        return $row['total_jobs'];
    }

    public function getJobsByUserId($userId) {
        $sql = "SELECT * FROM jobs WHERE user_id = '$userId'";
        $result = $this->db->query($sql);
    
        if (!$result) {
            return []; // Return an empty array if there's an error
        }
    
        $jobs = [];
        while ($row = $result->fetch_assoc()) {
            $jobs[] = $row;
        }
    
        return $jobs;
    }
    

}
?>