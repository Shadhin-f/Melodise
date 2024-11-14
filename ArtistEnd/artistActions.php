<?php
session_start();

// Login / Registration Handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('connect.php');

    // Login actions
    if (isset($_POST['login-button'])) {
        $loginEmail = $_POST['loginEmail'];
        $loginPassword = $_POST['loginPassword'];

        // Query to search for login email in the database
        $select_artist_credentials = "SELECT * FROM `artists` WHERE Email = '$loginEmail'";
        $result_artist_credentials = mysqli_query($conn, $select_artist_credentials);

        if ($result_artist_credentials) {
            $artist_found = mysqli_num_rows($result_artist_credentials);
            if ($artist_found > 0) {
                $artist_data = mysqli_fetch_assoc($result_artist_credentials);
                $artistID = $artist_data['ArtistID'];
                $artist_password = $artist_data['Password'];

                if ($loginPassword == $artist_password) {
                    // Start session for the logged-in user
                    $_SESSION['artistid'] = $artist_data['ArtistID'];
                    $_SESSION['artistname'] = $artist_data['Name'];
                    $_SESSION['email'] = $artist_data['Email'];
                    
                    header('Location: dashboard.php');
                    exit();
                } else {
                    echo '<script>
                            alert("Incorrect Password! Try again!!");
                            window.location.href = "artistlogin.php";
                        </script>';
                }
            } else {
                echo '<script>
                        alert("User Not Found!!!");
                        window.location.href = "artistlogin.php";
                    </script>';
            }
        }
    }

    // Registration actions
    if (isset($_POST['registration-button'])) {
        $regName = $_POST['username'];
        $regEmail = $_POST['email'];
        $gender = $_POST['gender'];
        $regPassword = $_POST['password'];
        $regRePassword = $_POST['re-password'];
        $regDob = $_POST['dob'];
        $regCountry = $_POST['country'];
        $reBio = $_POST['bio'];

        // Check for empty fields
        if (empty($regName) || empty($regPassword) || empty($regRePassword) || empty($regDob) || empty($regCountry) || empty($gender) || empty($reBio)) {
            echo '<script>
                    alert("Please fill out all the necessary fields!!!");
                    window.location.href = "artistlogin.php";
                </script>';
        } else {
            // Password confirmation check
            if ($regPassword != $regRePassword) {
                echo '<script>
                        alert("Password did not match!!");
                        window.location.href = "artistlogin.php";
                    </script>';
            } else {
                // Check if email is already in use
                $select_artist_credentials = "SELECT * FROM `artists` WHERE Email = '$regEmail'";
                $result_artist_credentials = mysqli_query($conn, $select_artist_credentials);

                if ($result_artist_credentials) {
                    $artist_found = mysqli_num_rows($result_artist_credentials);
                    if ($artist_found > 0) {
                        echo '<script>
                                alert("Email Already in use!!");
                                window.location.href = "artistlogin.php";
                            </script>';
                    } else {
                        // Insert artist credentials into the database
                        $insert_artist_credentials = "INSERT INTO `artists` (`ArtistID`, `Name`, `Email`, `Password`, `Gender`,  `Dob`,`Bio` , `Country`, `Image`) VALUES (NULL, '$regName', '$regEmail', '$regPassword', '$gender',  '$regDob', '$reBio', '$regCountry', 'unknown.jpg')";
                        $result_artist_credentials = mysqli_query($conn, $insert_artist_credentials);

                        if ($result_artist_credentials) {
                            echo '<script>
                                    alert("Registration successful!!");
                                    window.location.href = "artistlogin.php";
                                </script>';
                        }
                    }
                }
            }
        }
    }
}





   //  Log out btn action (user profile)

   if (isset($_POST['artist-logout-btn'])) {
    header('Location: artistlogin.php');
    session_unset();
    session_destroy();
}


// Redirect to login page if login or registration button is pressed and not logged in
if (isset($_POST['artist-login-btn']) || isset($_POST['artist-register-btn'])) {
    header('Location: artistlogin.php');
}
?>
