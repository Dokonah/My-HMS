<?php
$currentPage = 'consulting.php';
include('../header.php');
include('../includes/connection.php');
$patient_id = '';
?>
<main>
    <div class="form-input">
        <form method="POST">
            <label for="patient">Patient:</label>
            <select id="patient" name="patient">
                <option value="">Select Patient</option>
                <?php
                // Retrieve patient names and IDs from the database
                $query = "SELECT Patient_ID, CONCAT(P_Fname, ' ', P_Oname, ' ', P_Lname) AS FullName FROM Patient";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $patient_id = $row['Patient_ID'];
                    $fullName = $row['FullName'];
                    echo "<option value='$fullName'>$fullName</option>";
                }
                ?>
            </select>

            <label for="complaint">Complaint:</label>
            <textarea id="complaint" name="complaint" rows="4" required></textarea>

            <label for="diagnosis">Diagnosis:</label>
            <textarea id="diagnosis" name="diagnosis" rows="4" required></textarea>

            <label for="prescription">Prescription:</label>
            <textarea id="prescription" name="prescription" rows="4" required></textarea>

            <label for="referall">Referall:</label>
            <textarea id="referall" name="referall" rows="4"></textarea>

            <label for="consult_date">Consult Date:</label>
            <input type="text" id="consult_date" name="consult_date" value="<?php echo date('Y-m-d'); ?>" readonly>

            <label for="review_checkbox">Review:</label>
            <input type="checkbox" id="review_checkbox" name="review_checkbox">
            <div id="review_section" style="display: none;">
                <label for="review_date">Review Date:</label>
                <input type="date" id="review_date" name="review_date">

                <label for="review_time">Review Time:</label>
                <input type="time" id="review_time" name="review_time">
            </div>

            <div class="form-buttons">
                <input type="submit" value="Submit">
                <button onclick="goBack()">Cancel</button>
            </div>
        </form>

    </div>

    <script>
        function goBack() {
            window.history.back();
        }
        // Toggle review section based on checkbox state
        var reviewCheckbox = document.getElementById('review_checkbox');
        var reviewSection = document.getElementById('review_section');
        reviewCheckbox.addEventListener('change', function () {
            if (reviewCheckbox.checked) {
                reviewSection.style.display = 'block';
            } else {
                reviewSection.style.display = 'none';
            }
        });
    </script>
    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $patient = $_POST['patient'];
        $complaint = $_POST['complaint'];
        $diagnosis = $_POST['diagnosis'];
        $prescription = $_POST['prescription'];
        $referall = $_POST['referall'];
        $consult_date = date('Y-m-d'); // Current date
        $review_checkbox = isset($_POST['review_checkbox']) ? 1 : 0;
        $review_date = $_POST['review_date'];
        $review_time = $_POST['review_time'];

        //Check for user ID
        $loggedInUser = $_SESSION['username'];
        $query = "SELECT Employee_ID FROM users WHERE Username = '$loggedInUser'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $employeeID = $row['Employee_ID'];

        // Insert the data into the Consultation table
        $query = "INSERT INTO consultation (Patient_name, Complaint, Diagnosis, Prescription, Referall, Employee_ID, Consult_Date, Review_Date,Review_Time,Patient_ID) 
          VALUES ('$patient', '$complaint', '$diagnosis', '$prescription', '$referall', '$employeeID', '$consult_date','$review_date','$review_time','$patient_id')";

        if (mysqli_query($connection, $query)) {
            // Successful insertion
            echo "Consultation record inserted successfully.";
        } else {
            // Error in insertion
            echo "Error: " . mysqli_error($connection);
        }

        // Insert into Appointments table
        if ($review_checkbox) {

            // Insert a new record into the Appointments table with review details
            $query = "INSERT INTO Appointments (Patient_ID, Patient_name, Employee_ID, Appoint_Date, Appoint_Time, Review_Date, Review_Time) VALUES ($patient_id, '$patient', $employeeID, '$consult_date', '00:00:00', '$review_date', '$review_time')";
            mysqli_query($connection, $query);
        }

        // Redirect to a success page or perform any other necessary actions
        // ...
    }
    ?>
</main>
</div>
</body>

</html>