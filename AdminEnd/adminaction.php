<?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('connect.php');
        // Login actions

        if (isset($_POST['admin-login-button'])) {
            $loginEmail = $_POST['loginEmail'];
            $loginPassword = $_POST['loginPassword'];

            $select_admin_credentials = "SELECT * FROM `admins` WHERE Email = '$loginEmail'";                    // Query to search for login email in data base
            $result_admin_credentials = mysqli_query($conn, $select_admin_credentials);

            if ($result_admin_credentials) {
                $admin_found = mysqli_num_rows($result_admin_credentials);
                if ($admin_found > 0) {
                    $admin_data = mysqli_fetch_assoc($result_admin_credentials);
                    $admin_password = $admin_data['Password'];
                    if ($loginPassword == $admin_password) {
                        session_start();
                        
                        $_SESSION['adminname'] = $admin_data['Name'];
                        $_SESSION['email'] = $admin_data['Email'];


                        header('Location: adminhome.php');
                        
                    } else {
                        echo '<script>
                                alert("Incorrect Password! Try again!!");
                                window.location.href = "adminlogin.php";
                            </script>';
                    }
                } else {
                    echo '<script>
                                alert("admin Not Found!!!");
                                window.location.href = "adminlogin.php";
                            </script>';
                }
            }
        }

        if (isset($_POST['admin-login-btn'])) {
            header('Location: adminlogin.php');

        }

        if (isset($_POST['logout-btn'])) {
            session_start();
            session_unset();
            session_destroy();
            header('Location: adminlogin.php');

        }

    }
?>