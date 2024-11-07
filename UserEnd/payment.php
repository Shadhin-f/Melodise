<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Background and theme colors */
        body {
            background: url('../Resources/DesignElements/ProfileEditBack.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .payment-container {
            background: rgba(220, 53, 69, 0.85);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .payment-container h2 {
            color: #fff;
            font-weight: 600;
            font-size: 1.5rem;
            text-align: left;
            border-bottom: 2px solid #ffc107;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
            color: #f8d7da;
            display: flex;
            align-items: center;
        }

        .form-group label i {
            font-size: 0.9rem;
            margin-right: 8px;
            color: #ffc107;
        }

        .form-control[disabled] {
            background-color: #f8d7da;
            color: #333;
        }

        /* Button styles */
        .btn-confirm {
            background-color: #dc3545;
            color: white;
            width: 100%;
            margin-top: 15px;
        }

        .btn-confirm:hover {
            background-color: #b02a37;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
            width: 100%;
            margin-top: 10px;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <?php


    // $_SESSION['username'] = $user_data['Name'];
    // $_SESSION['email'] = $user_data['Email'];
    // $_SESSION['usertype'] = $userType;
    // Checking if user is logged in 

    
    if (isset($_SESSION['username'])) {
        $userType = $_SESSION['usertype'];
        // Checking for paid users
        if($userType != 1){
            echo"
            <div class='container d-flex justify-content-center align-items-center min-vh-100'>
                <div class='card text-center p-4' style='max-width: 400px; background-color: #198754; color: #fff; border-radius: 8px;'>
                    <div class='card-body'>
                    <h5 class='card-title'><i class='fas fa-info-circle' style='color: #ffc107; margin-right: 8px;'></i> You are already an M+ user</h5>
                    <p class='card-text mt-2'>It looks like you're already subscribed to the M+ plan. Enjoy unlimited access to your favorite music on Melodise!</p>
                    <button onclick='history.back()' class='btn btn-light mt-3' style='color: #198754;'><i class='fas fa-arrow-left'></i> Back</button>
                </div>
            </div>
        </div>
            ";
        }
        // Free & Logged in users
        else{
            $userEmail = $_SESSION['email'];
            echo "
            <div class='payment-container'>
                <h2>Melodise Payment Gateway</h2>

        <form action='user-actions.php' method='post' id='paymentForm'>
            <!-- Package Selection Dropdown -->
            <div class='form-group'>
                <div class='form-group'>
                    <label for='email'><i class='fas fa-envelope' style='color: #ffc107; margin-right: 8px;'></i> Email</label>
                    <input type='email' id='email' class='form-control' placeholder='$userEmail' disabled
                        style='background-color: #f8d7da; color: #333;'>
                </div>

                <label for='packageName'><i class='fas fa-box'></i> Package Name</label>
                <select id='packageName' class='form-control' onchange='updateAmount()' name='price-box'>
                    <option value='0' data-price='0' disabled selected>Select a Package</option>
                    <option value='60' data-price='60'>M+ Monthly Plan</option>
                    <option value='100' data-price='100'>M+ Family Plan</option>
                    <option value='600' data-price='600'>M+ Yearly Plan</option>
                </select>
            </div>

            <!-- Disabled field for payment amount -->
            <div class='form-group'>
                <label for='paymentAmount'><i class='fas fa-money-bill-wave'></i> Payment Amount</label>
                <input type='text' id='paymentAmount' class='form-control' value='0 tk' disabled>
            </div>

            <!-- Password input field -->
            <div class='form-group'>
                <label for='password'><i class='fas fa-lock'></i> Confirm Password</label>
                <input type='password' id='password' class='form-control' placeholder='Enter your password' name='password' required>
            </div>

            <!-- Action Buttons -->
            <button type='submit' class='btn btn-confirm' name='confirm-purchase-btn'>Confirm Purchase</button>
            <button type='button' class='btn btn-cancel' onclick='history.back()'>Cancel Payment</button>
        </form>
    </div>
            ";
        }
    } 
    else {
        echo "
        <div class='container d-flex justify-content-center align-items-center min-vh-100'>
            <div class='card text-center p-4' style='max-width: 400px; background-color: #ffc107; color: #333; border-bottom: 4px solid #dc3545; border-radius: 8px;'>
                <div class='card-body'>
                    <h5 class='card-title'><i class='fas fa-exclamation-triangle' style='color: #dc3545; margin-right: 8px;'></i> Access Denied</h5>
                    <p class='card-text mt-2'>You can't access this page without logging in. Please log in to continue.</p>
                    <button onclick='history.back()' class='btn btn-dark mt-3'><i class='fas fa-arrow-left'></i> Back</button>
                </div>
            </div>
        </div>
        ";
    }

    ?>

    <!-- Bootstrap JavaScript dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for dynamic amount and confirmation prompt -->
    <script>
        function updateAmount() {
            const packageSelect = document.getElementById('packageName');
            const paymentAmount = packageSelect.options[packageSelect.selectedIndex].getAttribute('data-price');
            document.getElementById('paymentAmount').value = paymentAmount + ' tk';
        }
    </script>
</body>

</html>