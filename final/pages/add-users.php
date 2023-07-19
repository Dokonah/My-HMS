<?php
$currentPage = 'add-users.php';
include('../header.php');
include('../includes/connection.php');
?>
<main>
    <h1>Add User</h1>

    <form method="POST" action="">
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>
        <div>
            <label for="gender">Gender:</label>
            <input type="radio" id="male" name="gender" value="M" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="F" required>
            <label for="female">Female</label>
        </div>
        <div>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
        </div>
        <div>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea>
        </div>
        <div>
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" required>
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Add User</button>
        </div>
    </form>
    <button onclick="goBack()">Cancel</button>

    <script>
        function goBack() {
            window.;
        }
    </script>
    <?php
    // Validate and process the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and validate form inputs
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate phone number (Ghanaian phone numbers)
        function validatePhoneNumber($number)
        {
            // Remove any non-digit characters
            $number = preg_replace('/[^0-9]/', '', $number);

            // Validate length and format
            if (strlen($number) === 10 && preg_match('/^(0[235][0-9]{8}|0[24][0-9]{8}|0[57][0-9]{8}|1[0-9]{9})$/', $number)) {
                return true;
            } else {
                return false;
            }
        }

        if (!validatePhoneNumber($phone_number)) {
            echo '<p class="error">Invalid phone number. Please enter a valid Ghanaian phone number.</p>';
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user into the database
            $query = "INSERT INTO users (First_Name, Last_Name, Gender, D_O_B, Phone_Number, Email, Address, Role, Username, Passkey)
                      VALUES ('$first_name', '$last_name', '$gender', '$dob', '$phone_number', '$email', '$address', '$role', '$username', '$hashed_password')";

            // Execute the query
            mysqli_query($connection, $query);

            // Check if the user was successfully added
            if (mysqli_affected_rows($connection) > 0) {
                echo '<script>';
                echo 'setTimeout(function() { window.location.href = "users.php"; }, 5000);';
                echo '</script>';

                // Display success message or perform any other actions
                echo '<h3>User added successfully!</h3>';
            } else {
                echo '<p class="error">Failed to add user. Please try again.</p>';
            }
        }
    }
    ?>
</main>
</body>

</html>