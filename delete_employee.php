<?php
$servername = "localhost";
$username = "root";
$password = "Waithaka@_7730";
$dbname = "information collection";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_number = mysqli_real_escape_string($conn, $_GET["id"]); // Get ID from URL

// Prepare and bind SQL statement
$stmt = $conn->prepare("DELETE FROM employees WHERE id_number = ?");
$stmt->bind_param("s", $id_number);

// Execute the statement
if ($stmt->execute()) {
    echo "Employee deleted successfully!";
} else {
    echo "Error deleting employee: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect to index.php after deleting
header("Location: index.php");
exit();
?>