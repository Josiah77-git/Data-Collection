<?php
$servername = "localhost";
$username = "root";
$password = "Waithaka@_7730";
$dbname = "information collection";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data (with proper sanitization)
$id_number = mysqli_real_escape_string($conn, $_POST["id_number"]);
$first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
$middle_name = isset($_POST["middle_name"]) ? mysqli_real_escape_string($conn, $_POST["middle_name"]) : "";
$last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
$telephone = mysqli_real_escape_string($conn, $_POST["telephone"]);
$department = mysqli_real_escape_string($conn, $_POST["department"]);
$year_employed = (int)$_POST["year_employed"];

// Calculate years in company
$currentDate = new DateTime();
$currentYear = (int)$currentDate->format("Y");
$years_in_company = $currentYear - $year_employed;

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO employees (id_number, first_name, middle_name, last_name, telephone, department, year_employed, years_in_company) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssii", $id_number, $first_name, $middle_name, $last_name, $telephone, $department, $year_employed, $years_in_company);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully!";
} else {
    // Check for duplicate key error
    if ($conn->errno == 1062) {
        echo "Error: ID Number already exists.";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

// Redirect to index.php after adding
header("Location: index.php");
exit();
?>