<!DOCTYPE html>
<html>

<head>
    <title>Employee Details</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .employee-details {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
        }
    </style>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="header">
        <img src="KNC_50Yrs_Primary-Logo.png" alt="Kenya Nut Company Limited Logo"
            style="max-height: 200px;"><br>
        <h1>Kenya Nut Company Limited</h1>
    </div>

    <div class="employee-details">
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

        $sql = "SELECT id_number, first_name, middle_name, last_name, telephone, department, year_employed, years_in_company FROM employees WHERE id_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<div class='detail-row'><span class='detail-label'>ID Number:</span> <span>" . $row["id_number"] . "</span></div>";
            echo "<div class='detail-row'><span class='detail-label'>First Name:</span> <span>" . $row["first_name"] . "</span></div>";
            echo "<div class='detail-row'><span class='detail-label'>Middle Name:</span> <span>" . $row["middle_name"] . "</span></div>";
            echo "<div class='detail-row'><span class='detail-label'>Last Name:</span> <span>" . $row["last_name"] . "</span></div>";
            echo "<div class='detail-row'><span class='detail-label'>Telephone:</span> <span>" . $row["telephone"] . "</span></div>";
            echo "<div class='detail-row'><span class='detail-label'>Department:</span> <span>" . $row["department"] . "</span></div>";
            echo "<div class='detail-row'><span class='detail-label'>Year Employed:</span> <span>" . $row["year_employed"] . "</span></div>";
            echo "<div class='detail-row'><span class='detail-label'>Years in Company:</span> <span>" . $row["years_in_company"] . "</span></div>";
            // Display photo if available (implement this part if needed)
        } else {
            echo "Employee not found.";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
    <p><a href="index.php">Back to Employee List</a></p>
</body>

</html>