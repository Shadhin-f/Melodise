<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <!-- Font Awesome for icons -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>

    <title>Document</title>
</head>

<body>
    <div class='payment-container'>
        <h2>Melodise Payment Gateway</h2>

        <form id='paymentForm'>
            <!-- Package Selection Dropdown -->
            <div class='form-group'>
                <div class='form-group'>
                    <label for='email'><i class='fas fa-envelope' style='color: #ffc107; margin-right: 8px;'></i> Email</label>
                    <input type='email' id='email' class='form-control' placeholder='user@example.com' disabled
                        style='background-color: #f8d7da; color: #333;'>
                </div>

                <label for='packageName'><i class='fas fa-box'></i> Package Name</label>
                <select id='packageName' class='form-control' onchange='updateAmount()'>
                    <option value='0' data-price='0' disabled selected>Select a Package</option>
                    <option value='M+ Monthly Plan' data-price='60'>M+ Monthly Plan</option>
                    <option value='M+ Family Plan' data-price='100'>M+ Family Plan</option>
                    <option value='M+ Yearly Plan' data-price='600'>M+ Yearly Plan</option>
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
                <input type='password' id='password' class='form-control' placeholder='Enter your password' required>
            </div>

            <!-- Action Buttons -->
            <button type='button' class='btn btn-confirm' onclick='confirmPurchase()'>Confirm Purchase</button>
            <button type='button' class='btn btn-cancel' onclick='history.back()'>Cancel Payment</button>
        </form>
    </div>


</body>

</html>