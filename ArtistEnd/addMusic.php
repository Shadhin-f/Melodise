<?php
// Include database connection file
include('connect.php');

// Start the session to get the logged-in user's data
session_start();

// Assuming you have set the ArtistID in session after login
$artistID = $_SESSION['artistid']; // Change 'ArtistID' if your session variable is named differently

// Fetch albums from the database where the ArtistID matches
$albumQuery = "SELECT AlbumID, Title FROM albums WHERE ArtistID = $artistID";
$albumResult = mysqli_query($conn, $albumQuery);

// Fetch genres from the database (no need to filter by ArtistID)
$genreQuery = "SELECT GenreID, Title FROM genres";  // Correct column name for genre
$genreResult = mysqli_query($conn, $genreQuery);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Release Form - MELODISE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        /* Background image for the whole page */
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

        /* Centered form card style */
        .form-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Logo and title styling */
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #1B8673;
        }

        /* Input field styling */
        .form-control, .form-select {
            border: none;
            border-bottom: 2px solid #1B8673;
            border-radius: 0;
            box-shadow: none;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: none;
            border-color: #1B8673;
        }

        /* Button styling */
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
        <h2 class="mb-4">Music Release Form</h2>

        <!-- Music Release Form -->
        <form method="POST" action="artistActions.php" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" class="form-control" id="songTitle" name="songTitle" placeholder="Enter song title" required>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" id="releaseDate" name="releaseDate" placeholder="Select release date" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="duration" name="duration" placeholder="Enter duration (e.g., 3:45)" required>
            </div>
            <div class="mb-3">
                <select id="album" name="album" class="form-select" required>
                    <option selected disabled>Select album</option>
                    <?php
                    echo "<option value='NULL'>None</option>";
                    // Check if there are albums for the logged-in artist
                    if (mysqli_num_rows($albumResult) > 0) {
                        // Loop through each album and create an option
                        while ($album = mysqli_fetch_assoc($albumResult)) {
                            echo "<option value='" . $album['AlbumID'] . "'>" . $album['Title'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No albums available</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <select id="genre" name="genre" class="form-select" required>
                    <option selected disabled>Select genre</option>
                    <?php
                    // Check if there are genres
                    if (mysqli_num_rows($genreResult) > 0) {
                        // Loop through each genre and create an option
                        while ($genre = mysqli_fetch_assoc($genreResult)) {
                            echo "<option value='" . $genre['GenreID'] . "'>" . $genre['Title'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No genres available</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                    <label for="mp3File" class="form-label">Upload MP3 File</label>
                    <input type="file" class="form-control" id="mp3File" name="mp3File" required>
            </div>
            <div class="mb-3 text-start">
                <label for="colorCode" class="form-label">Color Code</label>
                <input type="color" class="form-control form-control-color" id="colorCode" name="colorCode" value="#1B8673" required>
                <input type="text" id="colorHex" class="form-control mt-2" readonly>
            </div>

            <button type="submit" name = "add-music-button" class="btn btn-custom btn-submit w-100 mt-3">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for showing hex code -->
    <script>
        const colorCodeInput = document.getElementById('colorCode');
        const colorHexInput = document.getElementById('colorHex');

        // Set initial color hex value
        colorHexInput.value = colorCodeInput.value;

        // Update hex code display when color is changed
        colorCodeInput.addEventListener('input', () => {
            colorHexInput.value = colorCodeInput.value;
        });
    </script>
</body>

</html>
