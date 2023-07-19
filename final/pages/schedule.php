<?php
$currentPage = 'schedule.php';
include('../header.php');
include('../includes/connection.php');
?>
<main>
    <div class="Content-wrapper">
        <div>
            <label for="">
                Show
                <select name="DataTables_Table_0_length" class="custom select" id="">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </label>
            <!-- <div class="search-wrapper">
                 <span class="las la-search"></span>
                    <input type="search" placeholder="Search here" />
                    </div> -->

        </div>

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
        <a href="add-schedule.php" class="btn btn-primary btn-rounded float-right"><i class="las la-plus"></i>
            Appointment</a>
    </div>

</main>
</div>
</body>

</html>