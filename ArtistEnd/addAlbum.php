<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Album - MELODISE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->
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
        <form action="artistActions.php" method="post" enctype="multipart/form-data">
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
