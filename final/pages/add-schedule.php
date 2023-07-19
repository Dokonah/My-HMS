<?php
$currentPage = 'add-schedule.php';
include('../header.php');
include('../includes/connection.php');
?>

<main>
    <div>
        <div class="add-schedules-form">
            <h1>Add Appointment</h1>
            <?php
            // Check if the form is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve the form data
                $patientID = $_POST['patient_id'];
                $appointDate = $_POST['appoint_date'];
                $appointTime = $_POST['appoint_time'];

                // Retrieve the Employee_ID based on the logged-in username
                $loggedInUser = $_SESSION['username'];
                $query = "SELECT Employee_ID FROM users WHERE Username = '$loggedInUser'";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($result);
                $employeeID = $row['Employee_ID'];

                // Insert the appointment into the database
                $query = "INSERT INTO Appointments (Patient_ID, Employee_ID, Appoint_Date, Appoint_Time) VALUES ('$patientID', '$employeeID', '$appointDate', '$appointTime')";
                $result = mysqli_query($connection, $query);

                // Check if the insertion was successful
                if ($result) {
                    echo "Appointment added successfully!";
                } else {
                    echo "Error adding appointment: " . mysqli_error($connection);
                }
            }
            ?>
            <form action="" method="POST">
                <label for="patient">Patient:</label>
                <select name="patient_id" id="patient">
                    <?php
                    // Fetch the patients from the Patient table
                    $query = "SELECT Patient_ID, P_Fname, P_Lname FROM Patient";
                    $result = mysqli_query($connection, $query);

                    // Generate the options for the dropdown
                    while ($row = mysqli_fetch_assoc($result)) {
                        $patientID = $row['Patient_ID'];
                        $patientName = $row['P_Fname'] . ' ' . $row['P_Lname'];
                        echo "<option value='$patientID'>$patientName</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="appoint_date">Appointment Date:</label>
                <input type="date" name="appoint_date" id="appoint_date">
                <br>
                <label for="appoint_time">Appointment Time:</label>
                <input type="time" name="appoint_time" id="appoint_time">
                <br>
                <input type="submit" value="Add Appointment">
            </form>

            <button onclick="goBack()">Cancel</button>

            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </div>
    </div>
</main>
</div>
</body>

</html>