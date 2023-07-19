<?php
$currentPage = 'add-patients.php';
include('../header.php');
include('../includes/connection.php');
?>

<main>
    <div>
        <div class="add-patients-form">
            <form method="POST" action="">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" required>

                <label for="mname">Middle Name:</label>
                <input type="text" id="mname" name="mname">

                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" required>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>

                <label for="religion">Religion:</label>
                <select type="text" id="religion" name="religion">
                    <option value="Christian">Christian</option>
                    <option value="Muslim">Muslim</option>
                    <option value="Traditional">Traditional</option>
                    <option value="Other">Other</option>
                </select>

                <label for="maritalStatus">Marital Status:</label>
                <select id="maritalStatus" name="maritalStatus">
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                </select>

                <label for="socialHistory">Social History:</label>
                <textarea id="socialHistory" name="socialHistory"></textarea>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email">

                <label for="address">Address:</label>
                <textarea id="address" name="address"></textarea>

                <button type="submit">Add Patient</button>
            </form>
            <button onclick="goBack()">Cancel</button>

            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </div>
        <?php
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the form data
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $religion = $_POST['religion'];
            $maritalStatus = $_POST['maritalStatus'];
            $socialHistory = $_POST['socialHistory'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            // Check if the connection was successful
            if ($connection) {
                // Prepare the SQL query to insert the patient data
                $query = "INSERT INTO Patient (P_Fname, P_Oname, P_Lname, Date_of_Birth, Gender, Religion, Marital_Status, Social_History, Phone_Number, Email, Address) 
                  VALUES ('$fname', '$mname', '$lname', '$dob', '$gender', '$religion', '$maritalStatus', '$socialHistory', '$phone', '$email', '$address')";

                // Execute the query
                $result = mysqli_query($connection, $query);

                // Check if the insertion was successful
                if ($result) {
                    // Patient added successfully
                    echo '<script>';
                    echo 'setTimeout(function() { window.location.href = "patients.php"; }, 5000);';
                    echo '</script>';
                    echo "Patient added successfully.";

                } else {
                    // Error occurred during insertion
                    echo "Error: " . mysqli_error($connection);
                }

                // Close the database connection
                mysqli_close($connection);
            } else {
                // Error connecting to the database
                echo "Error: Unable to connect to the database.";
            }
        }
        ?>


    </div>
</main>
</div>
</body>

</html>