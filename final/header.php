<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,intial-scale=1,maximum-scale=1">
    <title>My HMS</title>
    <!--<link rel="icon" type="image/x-icon" href="favicon.ico">-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

    <input type="checkbox" id="nav-toggle">

    <div class="sidebar">
        <div class="sidebar-brand">
            <h1><span class="las la-stethoscope"></span><span>MyHMS</span></h1>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php" <?php if (strpos($currentPage, 'dashboard.php') !== false)
                        echo 'class="active"'; ?>>
                        <span class="las la-igloo"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="patients.php" <?php if (strpos($currentPage, 'patients.php') !== false)
                        echo 'class="active"'; ?>>
                        <span class="las la-users"></span>
                        <span>Patients</span>
                    </a>
                </li>
                <li>
                    <a href="schedule.php" <?php if (strpos($currentPage, 'schedule.php') !== false)
                        echo 'class="active"'; ?>>
                        <span class="las la-calendar-check"></span>
                        <span>Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="consulting.php" <?php if ($currentPage === 'consulting.php')
                        echo 'class="active"'; ?>>
                        <span class="las la-clipboard-list"></span>
                        <span>Consulting</span>
                    </a>
                </li>
                <li>
                    <a href="users.php" <?php if (strrpos($currentPage, 'users.php') !== false)
                        echo 'class="active"'; ?>>
                        <span class="las la-user"></span>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="logout">
                        <span class="las la-sign-out-alt"></span>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php
    session_start();

    if (empty($_SESSION['username'])) {
        header('location:../index.php');
        // Get the role from the session
    }
    $role = $_SESSION['role'];

    ?>
    <div class="main_content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                <?php
                if ($currentPage === 'dashboard.php') {
                    echo 'Dashboard';
                    $_SESSION['LAST_ACTIVITY'] = time();
                } elseif (strpos($currentPage, 'patients.php') !== false) {
                    echo 'Patients';
                    $_SESSION['LAST_ACTIVITY'] = time();
                } elseif (strpos($currentPage, 'schedule.php') !== false) {
                    echo 'Appointments';
                    $_SESSION['LAST_ACTIVITY'] = time();
                } elseif (strpos($currentPage, 'consulting.php') !== false) {
                    echo 'Consulting';
                    $_SESSION['LAST_ACTIVITY'] = time();
                } elseif (strpos($currentPage, 'users.php') !== false) {
                    echo 'Users';
                    $_SESSION['LAST_ACTIVITY'] = time();
                }
                ?>
            </h2>
            <div class="user-wrapper">
                <img src="../img/user.jpg" width="30px" height="30px">
                <div>
                    <?php
                    if ($role === "admin") { ?>
                        <small>Admin</small>
                    <?php } else { ?>
                        <small>
                            <?php echo $_SESSION['username']; ?>
                        </small>
                    <?php } ?>

                </div>
            </div>
        </header>