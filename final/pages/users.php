<?php
$currentPage = 'users.php';
include('../header.php');
include('../includes/connection.php');
?>

<main>
    <div class="table-responsive">
        <?php
        // Fetch all columns from the Patient table
        $query = "SELECT * FROM users";
        $result = mysqli_query($connection, $query);
        ?>

        <table width="100%">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Role</th>


                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>
                            <?php echo $row['Employee_ID']; ?>
                        </td>
                        <td>
                            <?php echo $row['First_Name']; ?>
                        </td>
                        <td>
                            <?php echo $row['Last_Name']; ?>
                        </td>
                        <td>
                            <?php if ($row['Gender'] === 'F') {
                                echo 'Female';
                            } elseif ($row['Gender'] === 'M') {
                                echo "Male";
                            } else
                                echo $row['Gender'];
                            ?>
                        </td>
                        <td>
                            <?php echo $row['D_O_B']; ?>
                        </td>
                        <td>
                            <?php echo $row['Phone_Number']; ?>
                        </td>
                        <td>
                            <?php echo $row['Email']; ?>
                        </td>
                        <td>
                            <?php echo $row['Address']; ?>
                        </td>
                        <td>
                            <?php echo $row['Role']; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="add-users.php" class="btn btn-primary btn-rounded float-right"><i class="las la-plus"></i>
            Add User</a>
    </div>
</main>
</div>
</body>

</html>