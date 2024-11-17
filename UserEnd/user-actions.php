<?php

session_start();





if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //  -------------  Home page  --------------
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

    // View artist profile btn

    if (isset($_GET['view-artist-profile-btn'])) {
        $artistID = $_GET['artist_id'];
        $_SESSION['artistid'] = $artistID;
        header('Location: artist.php');
    }



    //  Search button action (Nav bar)


    // Check if search-btn is set (even if empty)
    if (isset($_GET['search-btn'])) {

        // Check if the search key exists
        if (isset($_GET['search-key'])) {
            // Store search key in session
            $searchKey = $_GET['search-key'];
            $_SESSION['searchKey'] = $searchKey;

            // Redirect to searchresult.php
            header('Location: index.php');
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



//  ----------------------------- Login Registration --------------------------------



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

                    $_SESSION['userid'] = $user_data['UserID'];
                    $_SESSION['username'] = $user_data['Name'];
                    $_SESSION['email'] = $user_data['Email'];
                    $_SESSION['usertype'] = $userType;


                    // if user login admin session must be unset to avoid clashes
                    session_start();
                    if (isset($_SESSION['adminname'])) {
                        unset($_SESSION['adminname']);
                    }


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

    //------------------------------ registration ---------------------------------

    if (isset($_POST['registration-button'])) {
        $regName = $_POST['username'];
        $regEmail = $_POST['email'];
        $gender = $_POST['gender'];

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

        if ($regName == '' || $regPassword == '' || $regRePassword == '' || $regDob == '' || $regCountry == '' || $gender == '') {
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
                        $insert_user_credentials = "INSERT INTO `users` (`UserID`, `Name`, `Email`, `Password`, `DateOfBirth`,`Gender`, `Country`, `Image`) VALUES (NULL, '$regName', '$regEmail', '$regPassword', '$regDob', '$gender','$regCountry', 'unknown.jpg')";                    // Query to insert user data to database
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

    // -----------------------------Navigation bar actions------------------------------

    if (isset($_POST['user-profile-btn'])) {
        header('Location: userprofile.php');
    }


    // Login / registration button / if not logged in

    if (isset($_POST['user-login-btn']) || isset($_POST['user-register-btn'])) {
        header('Location: login.php');
    }



    //  ------------------------------Artist page --------------------------------


    // artist page follow action

    if (isset($_POST['follow-artist-btn'])) {
        $userID = $_SESSION['userid'];
        $artistID = $_SESSION['artistid'];
        $follow_artist_query = "INSERT INTO `artist_followers` (`UserID`, `ArtistID`, `FollowedTime`) VALUES ('$userID', '$artistID', current_timestamp());";
        $result_follow_artist_query = mysqli_query($conn, $follow_artist_query);
        if ($result_follow_artist_query) {
            header('Location: artist.php');
        }
    }
    // artist page unfollow action

    if (isset($_POST['unfollow-artist-btn'])) {
        $userID = $_SESSION['userid'];
        $artistID = $_SESSION['artistid'];
        $unfollow_artist_query = "DELETE FROM `artist_followers` WHERE UserID = '$userID' AND ArtistID = '$artistID';";
        $result_unfollow_artist_query = mysqli_query($conn, $unfollow_artist_query);
        if ($result_unfollow_artist_query) {
            header('Location: artist.php');
        }
    }




    //-------------------------- Play list veiew button (Index.php)------------------------------

    if (isset($_POST['view-playlist-btn'])) {
        $playlistID = $_POST['playlistID'];
        $playlistName = $_POST['playlistName'];

        $_SESSION['playlistid'] = $playlistID;
        $_SESSION['playlistname'] = $playlistName;

        header('Location: view-playlist.php');
    }

    // Create Playlist confirm button (index.php)

    if (isset($_POST['create-playlist-confirm-btn'])) {
        $userID = $_SESSION['userid'];
        $playlistName = $_POST['playlistName'];


        // Query to insert new playlist to database

        $insert_new_playlist = "INSERT INTO `playlists` (`PlaylistID`, `Name`, `UserID`, `CreatedDate`) VALUES (NULL, '$playlistName', '$userID', current_timestamp());";
        $result_new_playlist = mysqli_query($conn, $insert_new_playlist);
        if ($result_new_playlist) {
            header('Location: index.php');
        }
    }

    //  Add to play list button


    if (isset($_POST['add-to-playlist-btn'])) {
        $songID = $_POST['songID'];
        $playlistID = $_POST['playlistID'];

        // Query to add song to playlist
        try {

            $insert_song_to_playlist = "INSERT INTO `playlist_songs` (`PlaylistID`, `SongID`, `AddDate`) VALUES ('$playlistID', '$songID', current_timestamp())";
            $result_insert_song_to_playlist = mysqli_query($conn, $insert_song_to_playlist);

            if ($result_insert_song_to_playlist) {
                echo '<script>window.history.back();</script>';
            }
        } catch (Exception $e) {
            echo '<script>window.history.back();</script>';
        }
    }


    // Remove Song From Playlist button

    if (isset($_POST['songID']) && isset($_POST['remove-song-btn'])) {
        $songID = $_POST['songID'];
        $playlistID = $_SESSION['playlistid'];

        // Query to remove song from playlist
        try {
            $remove_song_from_playlist = "DELETE FROM playlist_songs WHERE SongID = '$songID' AND PlaylistID = '$playlistID'";
            $result_remove_song_from_playlist = mysqli_query($conn, $remove_song_from_playlist);
            if ($result_remove_song_from_playlist) {
                header('Location: view-playlist.php');
            }
        } catch (Exception $e) {
            header('Location: view-playlist.php');
        }
    }



    // Delete Playlist button (view playlist page)

    if (isset($_POST['delete-playlist-btn'])) {

        $playlistID = $_SESSION['playlistid'];

        $delete_playlist_query = "DELETE FROM playlists WHERE `playlists`.`PlaylistID` = '$playlistID'";
        $result_delete_playlist = mysqli_query($conn, $delete_playlist_query);
        if ($result_delete_playlist) {
            echo '<script>
                            alert("Playlist Deleted");
                            window.location.href = "index.php";
                            </script>';
        }
    }


    // profile edit btn (user profile)

    if (isset($_POST['subscription-buy-btn'])) {
        header('Location: subscription-purchase.php');
    }


    //------------------------------------ Subscription buy btn (user profile)------------------------------

    if (isset($_POST['profile-edit-btn'])) {
        header('Location: profileupdate.php');
    }



    //  Log out btn action (user profile)

    if (isset($_POST['logout-btn'])) {
        header('Location: login.php');
        session_unset();
        session_destroy();
    }


    //---------------------------     Confirm Update profile button (user profile)     -------------------

    if (isset($_POST['profile-update-btn'])) {
        // session_start();

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


                // Collecting the image name from the database ##
                $user_data = mysqli_fetch_assoc($result_user_credentials);
                $userImage = $user_data['Image'];


                if ($user_found > 0 && $upEmail != $userEmail) {
                    echo '<script>
                            alert("Email Already in use!!");
                            window.location.href = "profileupdate.php";
                        </script>';
                }

                // All the cases passed

                else {

                    // checking if profile image is selected or not ##
                    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] != 4) {

                        // Getting the file extension of the uploaded file
                        // $originalExtension = pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);

                        $uploadDirectory = 'C:/xampp/htdocs/website/Melodise/Resources/UserImages/';
                        $oldImagePath = $uploadDirectory . $userImage;
                        // $newImageName = $upEmail . '.' . $originalExtension;                                                   // New image name
                        $newImageName = $upEmail;                                              // New image name
                        $newImagePath = $uploadDirectory . $newImageName;

                        // Delete the old image 
                        if (file_exists($oldImagePath) && $userImage != 'unknown.jpg') {
                            unlink($oldImagePath);
                        }


                        // Moving file to the resources folder
                        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $newImagePath)) {


                            // Update query with image
                            $update_user_credentials = "UPDATE `users` SET `Name` = '$upName', `Email` = '$upEmail', `DateOfBirth` = '$upDOB', `Gender` = '$upGender', `Country` = '$upCountry', `Image` = '$newImageName' WHERE `users`.`Email` = '$userEmail';";
                        }
                    } else {


                        // update query without image
                        $update_user_credentials = "UPDATE `users` SET `Name` = '$upName', `Email` = '$upEmail', `DateOfBirth` = '$upDOB', `Gender` = '$upGender', `Country` = '$upCountry' WHERE `users`.`Email` = '$userEmail';";
                    }

                    $result_user_credentials = mysqli_query($conn, $update_user_credentials);
                    if ($result_user_credentials) {
                        if (isset($_SESSION['adminname']) && !isset($_SESSION['userid'])) {
                            echo '<script>
                                alert("Profile Updated!");
                                window.location.href = "../AdminEnd/user-update.php";
                                </script>';
                        } else {
                            // updating the ssions
                            $_SESSION['username'] = $upName;
                            $_SESSION['email'] = $upEmail;
                            echo '<script>
                                    alert("Profile Updated. Login to view updated profile!");
                                    window.location.href = "userprofile.php";
                                    </script>';
                        }
                    }
                }
            }
        }
    }

    //Delete account button 

    if (isset($_POST['profile-delete-btn'])) {

        $userEmail = $_SESSION['email'];

        $delete_userAccount_query = "DELETE FROM users WHERE  `users`.`Email` = '$userEmail'";
        $result_delete_userAccount = mysqli_query($conn, $delete_userAccount_query);
        if ($result_delete_userAccount) {
            echo '<script>
                            alert("User Account Deleted");
                            window.location.href = "login.php";
                            </script>';
        }
    }




    // Button forward to payment page

    if (isset($_POST['payment-btn'])) {
        header('Location: payment.php');
    }



    //  Confirm Purchase btn




    if (isset($_POST['confirm-purchase-btn'])) {

        // Storing information

        $userID = $_SESSION['userid'];
        $paymentAmount = $_POST['price-box'];
        $password = $_POST['password'];


        $select_user_pass = "SELECT * FROM `users` WHERE UserID = '$userID'";                    // Query to search for login email in data base
        $result_user_pass = mysqli_query($conn, $select_user_pass);
        $user_pass = mysqli_fetch_assoc($result_user_pass);
        $userPassword = $user_pass['Password'];

        // Checking if the password is correct
        if ($userPassword == $password) {
            // Query to find package id
            $select_package = "SELECT * FROM `subscription_types` WHERE Price = '$paymentAmount'";                    // Query to search for login email in data base
            $result_select_package = mysqli_query($conn, $select_package);
            if ($result_select_package) {
                $packageData = mysqli_fetch_assoc($result_select_package);
                // Getting the appropriate package code
                $packageCode = $packageData['PackageCode'];
                // Geeting the package duration in months
                $packageDuration = $packageData['Duration'];
                $currentDate = new DateTime();
                if ($packageDuration < 12) {
                    $currentDate->modify("+{$packageDuration} months");
                } else {
                    // Duration convert to year
                    $packageDuration = $packageDuration / 12;
                    $currentDate->modify("+{$packageDuration} years");
                }
                // Formatted date for mysql query
                $futureDate = $currentDate->format('Y-m-d');

                // updating the subscription records
                $update_subscription = "INSERT INTO `subscription_records` (`SubscriptionID`, `SubscriptionType`, `UserID`, `StartDate`, `EndDate`) VALUES (NULL, '$packageCode', '$userID', current_timestamp(), '$futureDate');";
                $result_select_package = mysqli_query($conn, $update_subscription);

                if ($result_select_package) {
                    $_SESSION['usertype'] = $packageCode;
                    echo '<script>
                                alert("Subscription Purchased Enjoy Unlimited Music!!");
                                window.location.href = "userprofile.php";
                            </script>';
                }
            } else {
                echo "There was a problem!!!";
            }
        } else {
            echo '<script>
                    alert("Password is incorrect!!");
                </script>';
        }
    }
}
