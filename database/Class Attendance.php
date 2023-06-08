<?php
// Database connection settings
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a form with student names and checkboxes for attendance
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the student names and attendance data from the form
    $students = $_POST['student'];
    $attendance = $_POST['attendance'];

    // Loop through the students and their attendance data
    foreach ($students as $index => $student) {
        // Get the attendance value for the current student
        $isPresent = isset($attendance[$index]) ? 1 : 0;

        // Prepare and execute an SQL statement to insert attendance data into the database
        $stmt = $conn->prepare("INSERT INTO attendance (student_name, is_present) VALUES (?, ?)");
        $stmt->bind_param("si", $student, $isPresent);
        $stmt->execute();
    }

    echo "Attendance captured and stored successfully!";
}
?>

<!-- Example HTML form to capture student attendance -->
<form method="POST" action="">
    <label for="student1">
        <input type="checkbox" id="student1" name="attendance[0]">
        Student 1
    </label><br>

    <label for="student2">
        <input type="checkbox" id="student2" name="attendance[1]">
        Student 2
    </label><br>

    <label for="student3">
        <input type="checkbox" id="student3" name="attendance[2]">
        Student 3
    </label><br>

    <!-- Add more students as needed -->

    <input type="submit" value="Submit Attendance">
</form>
