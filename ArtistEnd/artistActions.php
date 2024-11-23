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
                    $_SESSION['artistemail'] = $artist_data['Email'];
                    
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


//Edit Profile btn
if (isset($_POST['edit-artist-btn'])){
    $_SESSION['artistid']=$_POST['artist_id'];
    header('Location: editProfile.php');
}


//Edit profile confirm

if (isset($_POST['profile-update-btn'])) {
    $artistEmail = $_SESSION['artistemail'];
    $artistID = $_SESSION['artistid'];

    $upName = $_POST['updated-name'];
    $upEmail = $_POST['updated-email'];
    $upDOB = $_POST['updated-dob'];
    $upCountry = $_POST['updated-country'];
    $upGender = $_POST['updated-gender'];
    $upBio = $_POST['updated-bio'];

    // Empty field check
    if ($upName == '' || $upDOB == '' || $upCountry == '' || $upEmail == '' || $upBio == '') {
        echo '<script>
                alert("Please fill out all the necessary fields!");
                window.location.href = "editprofile.php";
              </script>';
    } else {
        // Checking if email is already in use and fetch the artist's current data
        $select_artist = "SELECT * FROM artists WHERE Email = '$upEmail'";
        $result_artist = mysqli_query($conn, $select_artist);

        if ($result_artist) {
            $artist_found = mysqli_num_rows($result_artist);
            $artist_data = mysqli_fetch_assoc($result_artist);
            $artistImage = $artist_data['Image'];

            if ($artist_found > 0 && $upEmail != $artistEmail) {
                echo '<script>
                        alert("Email already in use!");
                        window.location.href = "editprofile.php";
                      </script>';
            } else {
                // Handle profile image upload
                if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] != 4) {
                    $uploadDirectory = 'C:/xampp/htdocs/website/Melodise/Resources/ArtistImges/';
                    $oldImagePath = $uploadDirectory . $artistImage;
                    $newImageName = $artistID;
                    $newImagePath = $uploadDirectory . $newImageName;

                    // Delete old image if exists and not the default one
                    if (file_exists($oldImagePath) && $artistImage != 'unknown.jpg') {
                        unlink($oldImagePath);
                    }

                    // Move uploaded file to the resources folder
                    if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $newImagePath)) {
                        // Update query with image
                        $update_artist = "UPDATE artists SET Name = '$upName', Email = '$upEmail', Dob = '$upDOB', Gender = '$upGender', Bio = '$upBio', Country = '$upCountry', Image = '$newImageName' WHERE Email = '$artistEmail'";
                    }
                } else {
                    // Update query without image
                    $update_artist = "UPDATE artists SET Name = '$upName', Email = '$upEmail', Dob = '$upDOB', Gender = '$upGender',  Bio = '$upBio', Country = '$upCountry' WHERE Email = '$artistEmail'";
                }

                // Execute update query
                $result_update = mysqli_query($conn, $update_artist);
                if ($result_update) {
                    echo '<script>
                            alert("Profile Updated! Log in again to view updated profile.");
                            window.location.href = "artistlogin.php";
                          </script>';
                } else {
                    echo '<script>
                            alert("Failed to update profile. Please try again.");
                            window.location.href = "editprofile.php";
                          </script>';
                }
            }
        } else {
            echo '<script>
                    alert("Error fetching artist data.");
                    window.location.href = "editprofile.php";
                  </script>';
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


// Redirect to viewAllMusic.php if view-all-music-btn is clicked

if (isset($_GET['view-all-music-btn'])) {
    
    header("Location: viewAllMusic.php");
    exit();
}


// Redirect to dashboard.php if back-to-dashboard-btn is clicked
if (isset($_GET['back-to-dashboard-btn'])) {
    header("Location: dashboard.php");
    exit();
}

// Redirect to viewAllAlbum.php if view-all-album-btn is clicked

if (isset($_GET['view-all-album-btn'])) {
    header("Location: viewAllAlbum.php");
    exit;
}



// Redirect to addAlbum.php if add-album-btn is clicked
if (isset($_GET['add-album-btn'])) {
    header("Location: addAlbum.php");
    exit;
}


if (isset($_POST['delete-music-btn'])) {
    $song_id = $_POST['song_id'];

    // Query to delete the song from the database
    $delete_song = "DELETE FROM songs WHERE SongID = $song_id";
    if (mysqli_query($conn, $delete_song)) {
        echo "<script>alert('Song deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting song: " . mysqli_error($conn) . "');</script>";
    }

    // Redirect back to the All Music page
    echo "<script>window.location.href = 'viewAllMusic.php';</script>";
}

/*
// Redirect to deleteAlbum.php if delete-album-btn is clicked
if (isset($_GET['delete-album-btn'])) {
    header("Location: deleteAlbum.php");
    exit;
}
*/



 // Add music actions
 if (isset($_POST['add-music-button'])) {
    $regTitle = $_POST['songTitle'];
    $regsDate = $_POST['releaseDate'];
    $regDuration = $_POST['duration'];
    $regAlbum = $_POST['album'];
    $regGenre= $_POST['genre'];
    $regDob = $_POST['mp3File'];
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





?>
