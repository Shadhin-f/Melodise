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

                    session_start();
                    if (isset($_SESSION['adminname'])) {
                        unset($_SESSION['adminname']);
                    }

                    if (isset($_SESSION['userid'])) {
                        unset($_SESSION['userid']);
                        unset($_SESSION['username']);
                        
                    }
                    
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
    //$artistName = $_SESSION['artistname'];
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
                    // If admin logged in the after updating redirected to artist-update page in admin end
                    if (isset($_SESSION['adminname'])) {
                        echo '<script>
                            alert("Profile Updated!");
                            window.location.href = "../AdminEnd/update-artist-info.php";
                            </script>';
                    }
                    else{
                        //$_SESSION['artistemail'] = $upEmail;
                        //$_SESSION['artistname'] = $upName;
                        echo '<script>
                            alert("Profile Updated! Log in again to view updated profile.");
                            window.location.href = "artistlogin.php";
                          </script>';
                    }
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



// Add Album Action
if (isset($_POST['add-album'])) {
    // Check if ArtistID is set in the session
    if (!isset($_SESSION['artistid'])) {
        $_SESSION['error'] = "Artist not logged in!";
        header("Location: dashboard.php");
        exit();
    }

    // Get form data
    $artistID = $_SESSION['artistid']; // Artist ID from session
    $albumName = $_POST['albumName'];
    $releaseDate = $_POST['releaseDate'];
    $albumCover = $_FILES['albumCover'];

    // Fetch the latest AlbumID and generate new AlbumID
    $query = "SELECT MAX(AlbumID) AS LatestAlbumID FROM albums";
    $result = mysqli_query($conn, $query);
    $latestAlbumID = mysqli_fetch_assoc($result)['LatestAlbumID'] ?? 0;
    $newAlbumID = $latestAlbumID + 1;  // Increment AlbumID

    // Validate file upload
    $targetDir = "C:/xampp/htdocs/website/Melodise/Resources/AlbumCovers/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
    }

    // Validate album cover file
    $fileExtension = strtolower(pathinfo($albumCover['name'], PATHINFO_EXTENSION));

    // Check for valid file types (JPG, JPEG, PNG)
    if (!in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
        $_SESSION['error'] = "Only JPG, JPEG, and PNG files are allowed.";
        header("Location: addAlbum.php");
        exit();
    }

    // Generate the new file name using the AlbumID (rename the file)
    $targetFile = $targetDir . $newAlbumID . "." . $fileExtension; // Rename using AlbumID

    // Move the uploaded file
    if (!move_uploaded_file($albumCover['tmp_name'], $targetFile)) {
        $_SESSION['error'] = "Failed to upload album cover.";
        header("Location: addAlbum.php");
        exit();
    }

    // Insert album details into the database
    $albumCoverName = basename($targetFile); // Use the new file name for the album cover
    $sql = "INSERT INTO `albums` (`AlbumID`, `Title`, `ReleaseDate`, `ArtistID`, `AlbumCover`) 
            VALUES ('$newAlbumID', '$albumName', '$releaseDate', '$artistID', '$albumCoverName')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Album added successfully!";
        header("Location: dashboard.php"); // Redirect to dashboard
        exit(); // Ensure script stops after redirection
    } else {
        $_SESSION['error'] = "Error adding album: " . mysqli_error($conn);
        header("Location: addAlbum.php");
        exit(); // Ensure script stops after redirection
    }
}




//Edit Album


if (isset($_POST['edit-album'])) {
    // Validate session
    if (!isset($_SESSION['artistid'])) {
        $_SESSION['error'] = "Artist not logged in!";
        header("Location: dashboard.php");
        exit();
    }

    $artistID = $_SESSION['artistid'];
    $albumID = $_POST['albumID'];
    $albumName = mysqli_real_escape_string($conn, $_POST['albumName']);
    $releaseDate = mysqli_real_escape_string($conn, $_POST['releaseDate']);

    // Fetch existing album
    $sql = "SELECT AlbumCover FROM albums WHERE AlbumID = '$albumID' AND ArtistID = '$artistID'";
    $result = mysqli_query($conn, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        $_SESSION['error'] = "Album not found or access denied.";
        header("Location: dashboard.php");
        exit();
    }

    $album = mysqli_fetch_assoc($result);
    $albumCoverName = $album['AlbumCover'];

    // Handle file upload
    if (isset($_FILES['albumCover']) && $_FILES['albumCover']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "C:/xampp/htdocs/website/Melodise/Resources/AlbumCovers/";
        $fileExtension = strtolower(pathinfo($_FILES['albumCover']['name'], PATHINFO_EXTENSION));

        // Validate file type
        if (!in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
            $_SESSION['error'] = "Only JPG, JPEG, and PNG files are allowed.";
            header("Location: editAlbum.php?albumID=$albumID");
            exit();
        }

        // Generate new file name and move the file
        $newFileName = $albumID . "." . $fileExtension;
        $targetFile = $targetDir . $newFileName;

        if (move_uploaded_file($_FILES['albumCover']['tmp_name'], $targetFile)) {
            $albumCoverName = $newFileName; // Update album cover name
        } else {
            $_SESSION['error'] = "Failed to upload new album cover.";
            header("Location: editAlbum.php?albumID=$albumID");
            exit();
        }
    }

    // Update album details
    $sql = "UPDATE albums SET Title = '$albumName', ReleaseDate = '$releaseDate', AlbumCover = '$albumCoverName' WHERE AlbumID = '$albumID' AND ArtistID = '$artistID'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Album updated successfully!";
        header("Location: dashboard.php");
    } else {
        $_SESSION['error'] = "Error updating album: " . mysqli_error($conn);
        header("Location: editAlbum.php?albumID=$albumID");
    }
    exit();
}



// Add Music
if (isset($_POST['add-music-button'])) {
    $regTitle = trim($_POST['songTitle'] ?? '');
    $regsDate = trim($_POST['releaseDate'] ?? '');
    $regDuration = trim($_POST['duration'] ?? '');
    $regAlbum = trim($_POST['album'] ?? '');
    $regGenre = trim($_POST['genre'] ?? '');
    $regColorCode = trim($_POST['colorCode'] ?? '');

    // Validate required fields
    if (empty($regTitle) || empty($regsDate) || empty($regDuration) || empty($regAlbum) || empty($regGenre) || empty($regColorCode)) {
        echo '<script>
                alert("Please fill out all the necessary fields!");
                window.location.href = "addMusic.php";
            </script>';
        exit();
    }

    // Validate uploaded file
    if ($_FILES['mp3File']['error'] != UPLOAD_ERR_OK) {
        echo '<script>
                alert("Please upload a valid audio file!");
                window.location.href = "addMusic.php";
            </script>';
        exit();
    }

    // Validate file type (allow common audio formats)
    $allowedFileTypes = ['mp3', 'wav', 'aac', 'flac', 'ogg', 'm4a'];
    $fileType = strtolower(pathinfo($_FILES['mp3File']['name'], PATHINFO_EXTENSION));
    if (!in_array($fileType, $allowedFileTypes)) {
        echo '<script>
                alert("Only audio files (MP3, WAV, AAC, FLAC, OGG, M4A) are allowed!");
                window.location.href = "addMusic.php";
            </script>';
        exit();
    }

    // Fetch the latest SongID and generate new SongID
    $artistID = $_SESSION['artistid'];
    $query = "SELECT MAX(SongID) AS LatestSongID FROM songs";
    $result = mysqli_query($conn, $query);
    $latestSongID = mysqli_fetch_assoc($result)['LatestSongID'] ?? 0;
    $newSongID = $latestSongID + 1;

    // Rename and move the uploaded file
    $targetDir = "C:/xampp/htdocs/website/Melodise/Resources/Songs/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
    }
    $newFileNameWithExtension = $newSongID . '.' . $fileType;
    $targetFile = $targetDir . $newFileNameWithExtension;

    if (!move_uploaded_file($_FILES['mp3File']['tmp_name'], $targetFile)) {
        echo '<script>
                alert("Failed to upload the audio file.");
                window.location.href = "addMusic.php";
            </script>';
        exit();
    }

    // Insert song details into the database (without the file extension)
    $sql = "INSERT INTO `songs` (`SongID`, `Title`, `Duration`, `ReleaseDate`, `AlbumID`, `GenreID`, `ArtistID`, `ColorCode`, `Audio`) 
            VALUES ('$newSongID', '$regTitle', '$regDuration', '$regsDate', '$regAlbum', '$regGenre', '$artistID', '$regColorCode', '$newSongID')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>
                alert("Music added successfully!");
                window.location.href = "viewAllMusic.php";
            </script>';
    } else {
        echo '<script>
                alert("Error adding music: ' . mysqli_error($conn) . '");
                window.location.href = "addMusic.php";
            </script>';
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
