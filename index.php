<!DOCTYPE html>
<html>

<head>
    <title>Employee Management</title>
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

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            display: flex;
            justify-content: space-around;
        }

        .header {
            text-align: center;
            padding: 20px;
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

    <h2>Add New Employee</h2>
    <p><a href="create.php">Add Employee</a></p>

    <h2>Employee List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "Waithaka@_7730";
            $dbname = "information collection";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id_number, first_name, last_name, department FROM employees";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_number"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["department"] . "</td>";
                    echo "<td class='actions'>";
                    echo "<a href='read.php?id=" . $row["id_number"] . "'>Read</a>";
                    echo "<a href='update.php?id=" . $row["id_number"] . "'>Update</a>";
                    echo "<a href='delete_employee.php?id=" . $row["id_number"] . "'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No employees found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>