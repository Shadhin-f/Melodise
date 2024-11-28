<?php 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MELODISE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        /* Background image for the whole page */
        body {
            background-image: url('../Resources/DesignElements/admin-login-img.jpg');
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

        .btn-login {
            background-color: #1B8673;
            color: white;
        }

        .btn-login:hover {
            background-color: #145a50;
        }

    </style>
</head>

<body>

    <div class="form-card text-center">
        <div class="logo mb-3">MELODISE</div>
        <h2 id="form-title" class="mb-4">Login</h2>

        <!-- Login Form -->
        <form id="login-form" action="adminaction.php" method="post">
            <div class="mb-3">
                <input type="email" class="form-control" id="loginEmail" placeholder="Enter email" name="loginEmail" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="loginPassword" required>
            </div>
            <button type="submit" class="btn btn-custom btn-login w-100" name="admin-login-button">Login</button>
        </form>

        
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
</body>

</html>