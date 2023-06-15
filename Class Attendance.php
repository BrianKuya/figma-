<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['fname'];
    $faculty = $_POST['fname'];
    $school= $_POST['sname'];
    $department = $_POST['dname'];
    $admission_no = $_POST['anumber'];

    // Validate and sanitize the form data as needed

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "attendance";

    // Create a new MySQLi instance
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO nav11 (Name, Faculty, School, Department, Admission_no) VALUES (?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $mysqli->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssss", $name, $faculty, $school, $dpartment, $admission_no);

    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        $response = "Data inserted successfully";
    } else {
        // Error in execution
        $response = "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $mysqli->close();

    // Output the response
    echo $response;
}
?>