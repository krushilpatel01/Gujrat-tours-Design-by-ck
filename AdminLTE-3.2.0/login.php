<?php
include '../user/config.php';

session_start();
// Start output buffering
ob_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('Query failed: ' . mysqli_error($conn));

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);

        // Debugging: Print the fetched user data
        echo "Fetched user data: <pre>";
        print_r($row);
        echo "</pre>";

        // Debugging: Check the user type
        $user_type = trim(strtolower($row['user_type']));
        echo "User type (after trimming and converting to lowercase): $user_type<br>";

        if ($user_type == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            echo "<script>
                    alert('User registered');
                    window.location.href = 'index.php';
                  </script>";
            ob_end_flush(); // End output buffering and send headers
            exit;

        } elseif ($user_type == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            echo "<script>
                    window.location.href = '../index.php';
                  </script>";
            ob_end_flush(); // End output buffering and send headers
            exit;

        } else {
            echo 'Unrecognized user type!';
        }

    } else {
        echo "<script>alert('Incorrect email or password!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .admin-login-page{
        align-items: center;
    }
    .side-detail{
        padding: 129px 20px;
        background-color: brown;
        color: white;
    }
    .side-detail h1{
        font-weight: 900;
        margin-top:50px ;
    }
    .side-detail2{
        width: 100%;
        margin-left: 30px;
        text-align: center;
    }
    .side-detail2 input{
        width: 100%;
        padding: 10px 0px;
        text-indent: 20px;
        margin: 10px auto;
    }
    .logo-class{
        width: 70%;
        height: 70%;
        position: relative;
        animation: mymove 5s ease-in;
    }
    @keyframes mymove {
        0%   {top: 0px;}
        45%  {top: 200px;}
        100%  {top: 0px}
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="container">
        <div class="row admin-login-page">
            <div class="col side-detail">
                <div class="icon"><i class="fa-solid fa-plane-circle-check fa-2xl" style="color: #ffffff;"></i></div>
                <h1>Hello Using</h1>
                <h3>THis Form You Can Login To The Admin Panel.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati 
                    ipsam doloremque iusto neque assumenda impedit, accusantium ipsa autem
                     quae odio tenetur est, quis reprehenderit. Vel hic expedita recusandae 
                     modi laboriosam?</p>
                <ul>
                   <li>Here You Can Add Trip - Destination - Hotel - Transpot.</li>
                   <li>Also Check Booking Detail Of Client.</li>
                   <li>Get Othenitication Of Your Site.</li>
                   <li>We Can Access Your Website Home Page.</li>
                   <li>And Many More Services.</li>
                </ul>
            </div>
            <div class="col side-detail2">
                <section class="form-container">
                    <form action="" method="post">
                        <h2>Welcome To Guj<span style="color:red;">rat</span> Tours Admin</h2>
                        <h3>Login Form</h3>
                        <input type="email" name="email" placeholder="Enter your email" id="" class="box" required>
                        <input type="password" name="password" placeholder="Enter your password" id="" class="box" required>
                        <input type="submit" name="submit" value="Login Now" class="btn btn-warning">
                        <p><a href="register.php">Forget Password</a></p>
                    </form>
                </section>
            </div>
        </div>
    </div>

<footer class="main-footer mx-0">
      <strong>Copyright &copy; 2024-2025 <a href="https://www.linkedin.com/in/krushil-chabhadiya-7aa52a265/">Krushil
          Chabhadiya</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 8.3.1
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
  <!-- ./wrapper -->

  <!-- fotnawesome js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>