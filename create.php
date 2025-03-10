<!DOCTYPE html>
<html>

<head>
    <title>Add Employee</title>
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
        <h1>Kenya Nut Company Limited</h1>
    </div>

    <h2>Add Employee</h2>

    <form id="employeeForm" action="add_employee.php" method="post">
        <label for="id_number">ID Number:</label><br>
        <input type="text" id="id_number" name="id_number" required minlength="8" maxlength="9"
            pattern="{8,9}"><br>
        <div id="id_number_error" class="error-message"></div><br>

        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="middle_name">Middle Name:</label><br>
        <input type="text" id="middle_name" name="middle_name"><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="telephone">Telephone Number:</label><br>
        <input type="tel" id="telephone" name="telephone" required minlength="10" or maxlength="13"
            pattern="{13}"><br>
        <div id="telephone_error" class="error-message"></div><br>

        <label for="department">Department:</label><br>
        <select id="department" name="department" required>
            <option value="">Select Department</option>
            <option value="HR">Human Resource</option>
            <option value="ICT">IT Team</option>
            <option value="ENG">Engineering</option>
            <option value="PROC">Procurement</option>
            <option value="CAT">Catering</option>
            <option value="FNS">Financials</option>
            <option value="CMP">Compound</option>
            <option value="SH">Shop</option>
            <option value="HS">Health & Safety</option>
            <option value="MGR">Manager</option>
            </select><br><br>

        <label for="year_employed">Year Employed:</label><br>
        <select id="year_employed" name="year_employed" required>
        </select><br><br>

        <input type="submit" value="Add Employee">
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

        // ID Number Validation
        const idNumberInput = document.getElementById("id_number");
        const idNumberError = document.getElementById("id_number_error");
        idNumberInput.addEventListener("input", () => {
            if (!idNumberInput.checkValidity()) {
                idNumberError.textContent = "ID Number must be 8-9 numerical characters.";
            } else {
                idNumberError.textContent = "";
            }
        });

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
</body>

</html>