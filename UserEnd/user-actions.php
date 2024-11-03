<?php

session_start();



// Home Page 




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


    //  Search button action (Nav bar)


    // Check if search-btn is set (even if empty)
    if (isset($_GET['search-btn'])) {

        // Check if the search key exists and is not empty
        if (isset($_GET['search-key']) && !empty($_GET['search-key'])) {
            // Store search key in session
            $searchKey = $_GET['search-key'];
            $_SESSION['searchKey'] = $searchKey;

            // Redirect to searchresult.php
            header('Location: searchresult.php');
            exit;  // Stop further script execution
        } else {
            // Handle the case where search key is missing or empty
            echo '<script>
                        alert("No search keyword!!!");
                        window.location.href = "index.php";
                    </script>';
        }
    }
}



//  Login Registration



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('connect.php');


    // Login actions

    if (isset($_POST['login-button'])) {
        $loginEmail = $_POST['loginEmail'];
        $loginPassword = $_POST['loginPassword'];

        $select_user_credentials = "SELECT * FROM `users` WHERE Email = '$loginEmail'";                    // Query to search for login email in data base
        $result_user_credentials = mysqli_query($conn, $select_user_credentials);

        if ($result_user_credentials) {
            $user_found = mysqli_num_rows($result_user_credentials);
            if ($user_found > 0) {
                $user_data = mysqli_fetch_assoc($result_user_credentials);
                $userID = $user_data['UserID'];
                $user_password = $user_data['Password'];
                // $UserID = 8;
                if ($loginPassword == $user_password) {

                    // Checking Free or premium user

                    $userType = 1; // 1 For free users

                    // fetching subsiption data
                    $select_user_subs_info = "SELECT * FROM `subscription_records` WHERE UserID = '$userID' AND EndDate > CURDATE() AND SubscriptionType <> 1";                    // Query to search for login email in data base
                    $result_user_subs_info = mysqli_query($conn, $select_user_subs_info);

                    if ($result_user_subs_info) {
                        $subscriptin_found = mysqli_num_rows($result_user_subs_info);
                        if ($subscriptin_found > 0) {
                            $subs_data = mysqli_fetch_assoc($result_user_subs_info);
                            $userType = $subs_data['SubscriptionType'];      // Storing subscription type
                        }
                    }

                    // Session Start for the logged in user

                    $_SESSION['username'] = $user_data['Name'];
                    $_SESSION['email'] = $user_data['Email'];
                    $_SESSION['usertype'] = $userType;


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

    if (isset($_POST['registration-buttom'])) {
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

        if ($regName == '' || $regPassword == '' || $regRePassword == '' || $regDob == '' || $regCountry == '') {
            echo '<script>
                        alert("Please fillout all the necessary field!!!");
                        window.location.href = "login.php";
                    </script>';
        } else {

            // password confirm match check

            if ($regPassword != $regRePassword) {
                echo '<script>
                            alert("Password did not match!!");
                            window.location.href = "login.php";
                        </script>';
            } else {


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

                    else {
                        $insert_user_credentials = "INSERT INTO `users` (`UserID`, `Name`, `Email`, `Password`, `DateOfBirth`, `Country`) VALUES (NULL, '$regName', '$regEmail', '$regPassword', '$regDob', '$regCountry')";                    // Query to insert user data to database
                        $result_user_credentials = mysqli_query($conn, $insert_user_credentials);
                        if ($result_user_credentials) {
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



    if (isset($_POST['guest-view-button'])) {
        header('Location: index.php');
        session_destroy();
    }

    // Navigation bar actions

    if (isset($_POST['user-profile-btn'])) {
        header('Location: userprofile.php');
    }


    // Login / registration button / if not logged in

    if (isset($_POST['user-login-btn']) || isset($_POST['user-register-btn'])) {
        header('Location: login.php');
    }


    //  Log out btn action

    if (isset($_POST['logout-btn'])) {
        header('Location: login.php');
        session_unset();
        session_destroy();
    }


    //Confirm Update profile button

    if (isset($_POST['profile-update-btn'])) {
        session_start();

        $userEmail = $_SESSION['email'];

        $upName = $_POST['updated-name'];
        $upEmail = $_POST['updated-email'];
        $upDOB = $_POST['updated-dob'];
        $upCountry = $_POST['updated-country'];
        $upGender = $_POST['updated-gender'];

        // Empty field check

        if ($upName == '' || $upDOB == '' || $upCountry == '' || $upEmail == '') {
            echo '<script>
                        alert("Please fillout all the necessary field!!!");
                        window.location.href = "profileupdate.php";
                    </script>';
        } else {



            // Checking if email is already in use and fetch the user ID

            $select_user_credentials = "SELECT * FROM `users` WHERE Email = '$upEmail'";                    // Query to search for login email in data base
            $result_user_credentials = mysqli_query($conn, $select_user_credentials);

            if ($result_user_credentials) {
                $user_found = mysqli_num_rows($result_user_credentials);
                if ($user_found > 0 && $upEmail != $userEmail) {
                    echo '<script>
                            alert("Email Already in use!!");
                            window.location.href = "profileupdate.php";
                        </script>';
                }

                // All the cases passed

                else {
                    $update_user_credentials = "UPDATE `users` SET `Name` = '$upName', `Email` = '$upEmail', `DateOfBirth` = '$upDOB', `Gender` = '$upGender', `Country` = '$upCountry' WHERE `users`.`Email` = '$userEmail';";                    // Query to insert user data to database
                    $result_user_credentials = mysqli_query($conn, $update_user_credentials);
                    if ($result_user_credentials) {
                        echo '<script>
                            alert("Profile Updated. Login to view updated profile!");
                            window.location.href = "login.php";
                            </script>';
                    }
                    // echo "$regName, $regEmail, $regPassword, $regRePassword, $regDob, $regCountry";

                }
            }
        }
    }
}
