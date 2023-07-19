<?php
$currentPage = 'dashboard.php';
include('../header.php');
include('../includes/connection.php');
?>

<main>
    <div class="cards">
        <div class="card-single">
            <div>
                <?php
                $fetch_query = mysqli_query($connection, "select count(*) as total from patient");
                $paitents = mysqli_fetch_row($fetch_query);
                ?>
                <h1>
                    <?php echo $paitents[0]; ?>
                </h1>
                <span>Patients</span>
            </div>
            <div>
                <span class="las la-users"></span>
            </div>
        </div>


        <div class="card-single">
            <div>
                <?php
                $fetch_query = mysqli_query($connection, "SELECT count(*) FROM Appointments WHERE Appoint_Date >= CURDATE() AND Appoint_Time >= CURTIME();");
                $Appoints = mysqli_fetch_row($fetch_query);
                ?>
                <h1>
                    <?php echo $Appoints[0]; ?>
                </h1>
                <span>Today's Schedule</span>
            </div>
            <div>
                <span class="las la-calendar-check"></span>
            </div>
        </div>

        <div class="card-single">
            <div>
                <?php
                $fetch_query = mysqli_query($connection, "SELECT COUNT(*) AS consultation_count FROM Consultation WHERE DATE(Consult_Date) = CURDATE() ");
                $Consults = mysqli_fetch_row($fetch_query);
                ?>
                <h1>
                    <?php echo $Consults[0]; ?>
                </h1>
                <span>Consultations</span>
            </div>
            <div>
                <span class="las la-clipboard-list"></span>
            </div>
        </div>
    </div>

    <div class="recent-flex">
        <div class="patients">
            <div class="card">
                <div class="card-header">
                    <h3>Patients</h3>

                    <button onclick="window.location.href='patients.php'">See all <span
                            class="las la-arrow-right"></span></button>
                </div>
                <div class="card-body">
                    <?php
                    // Assuming you have established a database connection
                    
                    // Fetch the first 5 rows from the Patient table along with the last visit information
                    $query = "SELECT p.P_Fname, p.P_Lname, p.gender, p.Date_of_Birth, MAX(c.Consult_Date) AS Last_Visit FROM Patient p JOIN Consultation c ON p.Patient_ID = c.Patient_ID GROUP BY p.Patient_ID LIMIT 5";

                    $result = mysqli_query($connection, $query);
                    ?>

                    <table width="100%">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Gender</td>
                                <td>D. O. B</td>
                                <td>Last visit</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <?php echo $row['P_Fname'] . ' ' . $row['P_Lname']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['gender']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Date_of_Birth']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Last_Visit']; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="Appointments">
            <div class="card">
                <div class="card-header">
                    <h3>Appointments</h3>

                    <button onclick="window.location.href='schedule.php'">See all <span
                            class="las la-arrow-right"></span></button>
                </div>
                <div class="card-body">
                    <?php
                    // Assuming you have established a database connection
                    
                    // Fetch the upcoming appointments from the Appointments table
                    $query = "SELECT p.P_Fname, a.Appoint_Date, a.Appoint_Time
          FROM Appointments a
          JOIN Patient p ON p.Patient_ID = a.Patient_ID
          WHERE a.Appoint_Date >= CURDATE()
          ORDER BY a.Appoint_Date ASC, a.Appoint_Time ASC
          LIMIT 5";

                    $result = mysqli_query($connection, $query);
                    ?>

                    <table width="100%">
                        <thead>
                            <tr>
                                <td>Patient</td>
                                <td>Date</td>
                                <td>Time</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <?php echo $row['P_Fname']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Appoint_Date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Appoint_Time']; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

</main>
</div>
</body>

</html>