<!DOCTYPE html>
<html>

<head>
    <title>Edit Employee</title>
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

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="tel"],
        input[type="number"],
        select {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .header {
            text-align: center;
            padding: 20px;
        }

        #years_in_company_display {
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 5px;
        }
    </style>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="header">
        <img src="KNC_50Yrs_Primary-Logo.png" alt="Kenya Nut Company Limited Logo"
            style="max-height: 200px;"><br>
        <h1>Edit Employee</h1>
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "Waithaka@_7730";
    $dbname = "information collection";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id_number = mysqli_real_escape_string($conn, $_GET["id"]); 

    $sql = "SELECT id_number, first_name, middle_name, last_name, telephone, department, year_employed FROM employees WHERE id_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        ?>

        <form id="employeeForm" action="update_employee.php" method="post">
            <input type="hidden" name="id_number" value="<?php echo $row['id_number']; ?>">

            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required><br><br>

            <label for="middle_name">Middle Name:</label><br>
            <input type="text" id="middle_name" name="middle_name" value="<?php echo $row['middle_name']; ?>"><br><br>

            <label for="last_name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required><br><br>

            <label for="telephone">Telephone Number:</label><br>
            <input type="tel" id="telephone" name="telephone" value="<?php echo $row['telephone']; ?>" required
                minlength="13" maxlength="13" pattern="{13}"><br>
            <div id="telephone_error" class="error-message"></div><br>

            <label for="department">Department:</label><br>
            <select id="department" name="department" required>
                <option value="">Select Department</option>
                <option value="HR" <?php if ($row['department'] == 'HR') echo 'selected'; ?>>Human Resource</option>
                <option value="IT" <?php if ($row['department'] == 'ICT') echo 'selected'; ?>>IT Team</option>
                <option value="ENG" <?php if ($row['department'] == 'ENG') echo 'selected'; ?>>Engineering</option>
                <option value="PROC" <?php if ($row['department'] == 'PROC') echo 'selected'; ?>>Procurement</option>
                <option value="CAT" <?php if ($row['department'] == 'CAT') echo 'Catering'; ?>>Procurement</option>
                <option value="FNS" <?php if ($row['department'] == 'FNS') echo 'selected'; ?>>Financials</option>
                <option value="CMP" <?php if ($row['department'] == 'CMP') echo 'selected'; ?>>Compound</option>
                <option value="SH" <?php if ($row['department'] == 'SH') echo 'selected'; ?>>Shop</option>
                <option value="HS" <?php if ($row['department'] == 'HS') echo 'selected'; ?>>Health & Safety</option>
                <option value="MGR" <?php if ($row['department'] == 'MGR') echo 'selected'; ?>>Manager</option>
                </select><br><br>

            <label for="year_employed">Year Employed:</label><br>
            <select id="year_employed" name="year_employed" required>
            </select><br><br>

            <input type="submit" value="Update Employee">
        </form>

        <script>
            const yearEmployedSelect = document.getElementById("year_employed");
            const currentYear = new Date().getFullYear();
            for (let year = currentYear; year >= 1976; year--) {
                const option = document.createElement("option");
                option.value = year;
                option.text = year;
                yearEmployedSelect.add(option);
            }

            // Set the selected year
            const yearEmployed = document.getElementById("year_employed");
            yearEmployed.value = <?php echo $row['year_employed']; ?>;

            // Telephone Number Validation
            const telephoneInput = document.getElementById("telephone");
            const telephoneError = document.getElementById("telephone_error");
            telephoneInput.addEventListener("input", () => {
                if (!telephoneInput.checkValidity()) {
                    telephoneError.textContent = "Phone number must be 13 numerical characters.";
                } else {
                    telephoneError.textContent = "";
                }
            });
        </script>
    <?php
    } else {
        echo "Employee not found.";
    }

    $stmt->close();
    $conn->close();
    ?>
    <p><a href="index.php">Back to Employee List</a></p>
</body>

</html>