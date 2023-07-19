<?php
$currentPage = 'patients.php';
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
        // Fetch all columns from the Patient table
        $query = "SELECT * FROM Patient";
        $result = mysqli_query($connection, $query);
        ?>

        <table width="100%">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Religion</th>
                    <th>Marital Status</th>
                    <th>Social History</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>
                            <?php echo $row['Patient_ID']; ?>
                        </td>
                        <td>
                            <?php echo $row['P_Fname']; ?>
                        </td>
                        <td>
                            <?php echo $row['P_Oname']; ?>
                        </td>
                        <td>
                            <?php echo $row['P_Lname']; ?>
                        </td>
                        <td>
                            <?php echo $row['Date_of_Birth']; ?>
                        </td>
                        <td>
                            <?php echo $row['gender']; ?>
                        </td>
                        <td>
                            <?php echo $row['Religion']; ?>
                        </td>
                        <td>
                            <?php echo $row['Marital_Status']; ?>
                        </td>
                        <td>
                            <?php echo $row['Social_History']; ?>
                        </td>
                        <td>
                            <?php echo $row['Phone_Number']; ?>
                        </td>
                        <td>
                            <?php echo $row['email']; ?>
                        </td>
                        <td>
                            <?php echo $row['Address']; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="add-patients.php" class="btn btn-primary btn-rounded float-right"><i class="las la-plus"></i> Add
            Patient</a>
    </div>

</main>
</div>
</body>

</html>