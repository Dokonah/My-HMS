<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,intial-scale=1,maximum-scale=1">
    <title>My HMS</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    <?php
    // Check if the user is already logged in
    session_start();
    include('includes/connection.php');
    if (isset($_SESSION['username'])) {
        header("Location: pages/dashboard.php");
        exit;
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Authenticate user with prepared statement
        $query = "SELECT role, username, Passkey FROM users WHERE username = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $role, $dummyUsername, $dummyPassword);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            if (password_verify($password, $dummyPassword)) {
                // Session variables set and redirect to dashboard
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                header("Location: pages/dashboard.php");
                exit;
            } else {
                $loginError = 'Invalid username or password';
            }
        } else {
            $loginError = 'User does not exist';
        }
    }




    ?>

    <div class="login-container">
        <form class="login-form" method="post" action="">
            <div class="myhms">
                M
                <span class="stethoscope-container">
                    <span class="las la-stethoscope"></span>
                </span>HMS
            </div>
            <?php if (isset($loginError)): ?>
                <p class="error-message">
                    <?php echo $loginError; ?>
                </p>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Log In</button>
        </form>
    </div>
</body>

</html>