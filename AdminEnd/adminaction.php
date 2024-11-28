<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
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
                    $_SESSION['admin-email'] = $admin_data['Email']; // sesssion name changed to adminemail - 'Email' clashes with user side session


                    //  admin login must destroy all the user login session to protect admin permissions and access
                    session_start();
                    if (isset($_SESSION['userid'])) {
                        unset($_SESSION['userid']);
                        unset($_SESSION['username']);
                        
                    }
                    if (isset($_SESSION['artistid'])) {
                        unset($_SESSION['artistid']);
                        unset($_SESSION['artistname']);
                        
                    }


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

    if (isset($_POST['login-btn'])) {
        header('Location: adminlogin.php');
    }

    if (isset($_POST['logout-btn'])) {
        session_start();
        session_unset();
        session_destroy();
        header('Location: adminlogin.php');
    }


    //card buttons to go to the respective page

    //admin user profile update button

    if (isset($_POST['update-userInfo-btn'])) {
        header('Location: user-update.php');
    }

    //admin artist info update button
    if (isset($_POST['update-artistInfo-btn'])) {
        header('Location: update-artist-info.php');
    }

    //admin genre update button 
    if (isset($_POST['update-genre-btn'])) {
        header('Location: genre-update.php');
    }
    //card buttons ends here 
    


    //user profile edit button
    if (isset($_POST['user-profile-edit-btn'])) {
        $userEmail = $_POST['user_email'];
        $_SESSION['email'] = $userEmail;

        header('Location: ..\UserEnd\profileupdate.php');
    }

    //artist profile edit button
    if (isset($_POST['artist-profile-edit-btn'])) {
        $artistName =  $_POST['artist_name'];
        $artistEmail = $_POST['artist_email'];
        $_SESSION['artistname'] = $artistName;
        $_SESSION['artistemail'] = $artistEmail;

        header('Location: ..\ArtistEnd\editProfile.php');
    }

    // user Search Button action

    if (isset($_POST['user-search-btn'])) {
        $user_search_key = $_POST['user-search-key'];
        // echo $user_search_key;
        $_SESSION['user-search-key'] = $user_search_key;
        header('Location: user-update.php');
        exit();
    }

    // artist Search Button action

    if (isset($_POST['artist-search-btn'])) {
        $artist_search_key = $_POST['artist-search-key'];
        $_SESSION['artist-search-key'] = $artist_search_key;
        header('Location: update-artist-info.php');
        exit();
    }


    //add new genre button
    if (isset($_POST['add_new_genre_btn'])) {
  
        $genreTitle = $_POST['genreTitle'];

        $check_genre_exist = "SELECT Title from genres WHERE Title = '$genreTitle' ";
        $result_check_genre = mysqli_query($conn, $check_genre_exist);

        if ($result_check_genre) {
            $genre_found = mysqli_num_rows($result_check_genre);
            if ($genre_found > 0) {
                echo '<script>
                    alert("Genre Already Exists!!");
                    window.location.href = "genre-update.php";
                </script>';
            }
            else{
                $add_new_genre_query = "INSERT INTO `genres`(`GenreID`, `Title`) VALUES (NULL, '$genreTitle')";
                $result_add_new_genre = mysqli_query($conn, $add_new_genre_query);
                header('Location: genre-update.php');
            }
            
        }
             
    }

    //edit genre save button 
    if (isset($_POST['save_button'])) {
        $genreId = $_POST['GenreID'];  // Get GenreID
        $genreTitle = $_POST['genreTitle'];  // Get the new title
    
        // Update query
        $edit_genre_query = "UPDATE genres SET Title = '$genreTitle' WHERE GenreID = '$genreId'";
        $result_edit_genre = mysqli_query($conn, $edit_genre_query);
        header('Location: genre-update.php');
    }
}

    



