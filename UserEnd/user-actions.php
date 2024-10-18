<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include('connect.php');
    if (isset($_GET['all-music-btn'])) {
        header('Location: allmusic.php');
    }
    if (isset($_GET['back-to-home-btn'])) {
        header('Location: index.php');
    }
    if (isset($_GET['all-artist-btn'])) {
        header('Location: allartist.php');
    }
}



//  Login Registration



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('connect.php');


    // Login actions

    if(isset($_POST['login-button'])){
        $loginEmail = $_POST['loginEmail'];
        $loginPassword = $_POST['loginPassword'];
    
        $select_user_credentials = "SELECT * FROM `users` WHERE Email = '$loginEmail'";                    // Query to search for login email in data base
        $result_user_credentials = mysqli_query($conn, $select_user_credentials);
    
        if ($result_user_credentials) {
            $user_found = mysqli_num_rows($result_user_credentials);
            if ($user_found > 0) {
                $user_data = mysqli_fetch_assoc($result_user_credentials);
                $user_password = $user_data['Password'];
                if ($loginPassword == $user_password) {
                    $_SESSION['username'] = $user_data['Name'];
                    $_SESSION['email'] = $user_data['Email'];
                    header('Location: index.php');
                } else {
                    echo '<script>
                            alert("Incorrect Password! Try again!!");
                            window.location.href = "login.php";
                        </script>';
                }
            } else {
                echo '<script>
                            alert("User Not Found!!!");
                            window.location.href = "login.php";
                        </script>';
            }
        }

    }

    // registration 

    if(isset($_POST['registration-buttom'])){
        $regName = $_POST['username'];
        $regEmail = $_POST['email'];
        
        // Password input without hashing

        $regPassword = $_POST['password'];
        $regRePassword = $_POST['re-password'];

        // password input with hadhing

        // $regPassword = md5($_POST['password']);
        // $regRePassword = md5($_POST['re-password']);



        $regDob = $_POST['dob'];
        $regCountry = $_POST['country'];
        // echo "$regName, $regEmail, $regPassword, $regRePassword, $regDob, $regCountry";
        
        // Empty field check

        if ( $regName == '' || $regPassword == '' || $regRePassword == '' || $regDob == '' || $regCountry == ''){
            echo '<script>
                        alert("Please fillout all the necessary field!!!");
                        window.location.href = "login.php";
                    </script>';
        }
        else{

            // password confirm match check

            if($regPassword != $regRePassword){
                echo '<script>
                            alert("Password did not match!!");
                            window.location.href = "login.php";
                        </script>';
            }else{


                // Checking if email is already in use

                $select_user_credentials = "SELECT * FROM `users` WHERE Email = '$regEmail'";                    // Query to search for login email in data base
                $result_user_credentials = mysqli_query($conn, $select_user_credentials);

                if ($result_user_credentials) {
                    $user_found = mysqli_num_rows($result_user_credentials);
                    if ($user_found > 0) {
                        echo '<script>
                            alert("Email Already in use!!");
                            window.location.href = "login.php";
                        </script>';   
                    }


                    // All the cases passed

                    else{
                        $insert_user_credentials = "INSERT INTO `users` (`UserID`, `Name`, `Email`, `Password`, `DateOfBirth`, `Country`) VALUES (NULL, '$regName', '$regEmail', '$regPassword', '$regDob', '$regCountry')";                    // Query to insert user data to database
                        $result_user_credentials = mysqli_query($conn, $insert_user_credentials);
                        if($result_user_credentials){
                            echo '<script>
                            alert("Registration successful!!");
                            window.location.href = "login.php";
                            </script>'; 
                        }
                        // echo "$regName, $regEmail, $regPassword, $regRePassword, $regDob, $regCountry";
                        
                    }
                } 
                
                
            }


        }
        
    }




    // Guest Button action
    if(isset($_POST['guest-view-button'])){
        header('Location: index.php');
        session_destroy();
    }
}
