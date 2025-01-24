<?php
include('connect.php');          // Include database connection
session_start();                 // Start session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Artist Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        /* Centered card style */
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
        .form-control {
            border: none;
            border-bottom: 2px solid #1B8673;
            border-radius: 0;
            box-shadow: none;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #1B8673;
        }

        /* Button styling */
        .btn-custom {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
        }

        .btn-cancel {
            background-color: #ccc;
            color: #333;
        }

        .btn-update {
            background-color: #1B8673;
            color: white;
        }

        .btn-update:hover {
            background-color: #145a50;
        }
    </style>
</head>

<body>
    <?php
    // Session check
    if (!isset($_SESSION['artistname'])) {
        echo '<script>
                alert("Login to access this page!!");
                window.location.href = "artistlogin.php";
            </script>';
    } else {
        // Get the artist's email from session
        $artistName = $_SESSION['artistname'];

        // Fetch artist information from the database
        $select_artist = "SELECT * FROM artists WHERE Name = '$artistName'";
        $result_artist = mysqli_query($conn, $select_artist);
        $artist_data = mysqli_fetch_assoc($result_artist);

        $artistEmail = $artist_data['Email'];
        $artistDOB = $artist_data['Dob'];
        $artistGender = $artist_data['Gender'];
        $artistBio = $artist_data['Bio'];
        $artistCountry = $artist_data['Country'];
        $artistImage = $artist_data['Image'];
    }
    ?>

    <div class="form-card text-center">
        <div class="logo mb-3">MELODISE</div>
        <h2 class="mb-4">Update Artist Profile</h2>

        <form action="artistActions.php" method="post" enctype="multipart/form-data">
            <!-- Name field -->
            <div class="mb-3">
                <input type="text" class="form-control" id="name" name="updated-name" placeholder="Name" value="<?php echo htmlspecialchars($artistName); ?>" required>
            </div>

            <!-- Email field -->
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="updated-email" placeholder="Email" value="<?php echo htmlspecialchars($artistEmail); ?>" required>
            </div>

            <!-- Date of Birth field -->
            <div class="mb-3">
                <input type="date" class="form-control" id="dob" name="updated-dob" value="<?php echo htmlspecialchars($artistDOB); ?>" required>
            </div>

            <!-- Gender radio buttons -->
            <div class="mb-3 text-start">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderMale" name="updated-gender" value="Male" <?php if ($artistGender == 'Male') echo 'checked'; ?> required>
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderFemale" name="updated-gender" value="Female" <?php if ($artistGender == 'Female') echo 'checked'; ?> required>
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderOther" name="updated-gender" value="Others" <?php if ($artistGender == 'Others') echo 'checked'; ?> required>
                    <label class="form-check-label" for="genderOther">Other</label>
                </div>
            </div>

            <!-- Bio field -->
            <div class="mb-3">
                <textarea class="form-control" id="bio" name="updated-bio" placeholder="Bio" rows="3" required><?php echo htmlspecialchars($artistBio); ?></textarea>
            </div>

            <!-- Country selection box -->
            <div class="mb-3">
                <select class="form-select form-control" id="country" name="updated-country" required>
                    <option value="USA" <?php if ($artistCountry == 'USA') echo 'selected'; ?>>USA</option>
                    <option value="UK" <?php if ($artistCountry == 'UK') echo 'selected'; ?>>UK</option>
                    <option value="Canada" <?php if ($artistCountry == 'Canada') echo 'selected'; ?>>Canada</option>
                    <option value="Australia" <?php if ($artistCountry == 'Australia') echo 'selected'; ?>>Australia</option>
                    <option value="India" <?php if ($artistCountry == 'India') echo 'selected'; ?>>India</option>
                    <option value="Bangladesh" <?php if ($artistCountry == 'Bangladesh') echo 'selected'; ?>>Bangladesh</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <!-- Image input -->
            <div class="mb-3">
                <label class="form-label">Profile Image (Optional)</label>
                <input type="file" class="form-control" id="profileImage" name="profileImage" accept="image/*">
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-custom btn-cancel" onclick="window.location.href='history.back()'">Cancel</button>
                <button type="submit" class="btn btn-custom btn-update" name="profile-update-btn">Update</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

