<?php
session_start();
include('connect.php');

if (isset($_POST['add-album'])) {
    $albumName = mysqli_real_escape_string($conn, $_POST['albumName']);
    $releaseDate = mysqli_real_escape_string($conn, $_POST['releaseDate']);
    $artistID = $_SESSION['artistid'];

    // Handle file upload
    if (isset($_FILES['albumCover']) && $_FILES['albumCover']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../Resources/AlbumCovers/";
        $fileName = time() . "_" . basename($_FILES['albumCover']['name']); // Add timestamp to avoid name conflicts
        $targetFilePath = $targetDir . $fileName;

        // Ensure the directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['albumCover']['tmp_name'], $targetFilePath)) {
            // Insert album details into the database
            $sql = "INSERT INTO albums (Title, ReleaseDate, AlbumCover, ArtistID) 
                    VALUES ('$albumName', '$releaseDate', '$fileName', '$artistID')";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Album added successfully!";
            } else {
                $_SESSION['error'] = "Error adding album: " . mysqli_error($conn);
            }
        } else {
            $_SESSION['error'] = "Failed to upload album cover.";
        }
    } else {
        $_SESSION['error'] = "No album cover uploaded.";
    }

    header("Location: addAlbum.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Album - MELODISE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('../Resources/DesignElements/ProfileEditBack.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #1B8673;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #1B8673;
            border-radius: 0;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #1B8673;
        }

        .btn-custom {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
        }

        .btn-submit {
            background-color: #1B8673;
            color: white;
        }

        .btn-submit:hover {
            background-color: #145a50;
        }
    </style>
</head>

<body>
    <div class="form-card text-center">
        <div class="logo mb-3">MELODISE</div>
        <h2 class="mb-4">Add New Album</h2>

        <!-- Display Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success text-center">
                <?php 
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Album Add Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" class="form-control" name="albumName" placeholder="Enter Album Name" required>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" name="releaseDate" required>
            </div>
            <div class="mb-3">
                <label for="albumCover" class="form-label">Upload Album Cover</label>
                <input type="file" class="form-control" name="albumCover" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-custom btn-submit w-100 mt-3" name="add-album">Add Album</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
