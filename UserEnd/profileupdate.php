<?php
include('connect.php');          // Include database connection
session_start();                 // Start session
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
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

        .btn-delete {
            background-color: tomato;
            color: white;
        }

        .btn-update:hover {
            background-color: #145a50;
        }

        .btn-delete:hover {
            background-color: #145a50;
        }
    </style>
</head>

<body>
    <?php
    // Session check
    if (!isset($_SESSION['email'])) {
        echo '<script>
                alert("Login to access this page!!");
                window.location.href = "login.php";
            </script>';
    } else {
        // Get the user's email from session
        $userEmail = $_SESSION['email'];

        // Fetch user information from the database
        $select_user = "SELECT * FROM users WHERE Email = '$userEmail'";
        $result_user = mysqli_query($conn, $select_user);
        $user_data = mysqli_fetch_assoc($result_user);


        $userName = $user_data['Name'];
        $userDOB = $user_data['DateOfBirth'];
        $userGender = $user_data['Gender'];
        $userCountry = $user_data['Country'];
        $userImage = $user_data['Image'];
    }
    ?>

    <div class="form-card text-center">
        <div class="logo mb-3">MELODISE</div>
        <h2 class="mb-4">Update Profile</h2>

        <form form action="user-actions.php" method="post" enctype="multipart/form-data">
            <!-- Name field -->
            <div class="mb-3">
                <input type="text" class="form-control" id="name" name="updated-name" placeholder="Name" value="<?php echo htmlspecialchars($userName); ?>" required>
            </div>

            <!-- Email field -->
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="updated-email" placeholder="Email" value="<?php echo htmlspecialchars($userEmail); ?>" required>
            </div>

            <!-- Date of Birth field -->
            <div class="mb-3">
                <input type="date" class="form-control" id="dob" name="updated-dob" value="<?php echo htmlspecialchars($userDOB); ?>" required>
            </div>

            <!-- Gender radio buttons -->
            <div class="mb-3 text-start">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderMale" name="updated-gender" value="Male" <?php if ($userGender == 'Male') echo 'checked'; ?> required>
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderFemale" name="updated-gender" value="Female" <?php if ($userGender == 'Female') echo 'checked'; ?> required>
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderOther" name="updated-gender" value="Others" <?php if ($userGender == 'Others') echo 'checked'; ?> required>
                    <label class="form-check-label" for="genderOther">Other</label>
                </div>
            </div>

            <!-- Country selection box -->
            <div class="mb-3">
                <select class="form-select form-control" id="country" name="updated-country" required>
                    <option value="USA" <?php if ($userCountry == 'USA') echo 'selected'; ?>>USA</option>
                    <option value="UK" <?php if ($userCountry == 'UK') echo 'selected'; ?>>UK</option>
                    <option value="Canada" <?php if ($userCountry == 'Canada') echo 'selected'; ?>>Canada</option>
                    <option value="Australia" <?php if ($userCountry == 'Australia') echo 'selected'; ?>>Australia</option>
                    <option value="India" <?php if ($userCountry == 'India') echo 'selected'; ?>>India</option>
                    <option value="Bangladesh" <?php if ($userCountry == 'Bangladesh') echo 'selected'; ?>>Bangladesh</option>
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
                <button type="button" class="btn btn-custom btn-cancel" onclick="window.location.href='userprofile.php'">Cancel</button>
                <button type="submit" class="btn btn-custom btn-update" name='profile-update-btn'>Update</button>
                <button type="submit" class="btn btn-custom btn-delete" name='profile-delete-btn'>Delete Account</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>