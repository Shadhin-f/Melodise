<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Plans</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Page background and theme colors */
        body {
            background: url('../Resources/DesignElements/ProfileEditBack.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        .subscription-container {
            background: rgba(25, 135, 84, 0.85);
            padding: 50px;
            border-radius: 10px;
        }

        .subscription-card {
            background-color: #fff;
            border: none;
            border-radius: 8px;
            color: #333;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .subscription-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .subscription-card h5 {
            color: #198754;
        }

        .subscription-card .fas {
            color: #198754;
        }

        .btn-success {
            background-color: #198754;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-success:hover {
            background-color: #146c43;
        }

        .btn-back {
            background-color: #198754;
            color: white;
            margin-top: 20px;
        }

        /* Card content styling */
        .benefits-list {
            list-style: none;
            padding: 0;
            text-align: left;
        }

        .benefits-list li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .benefits-list li .fas {
            margin-right: 10px;
        }

        /* Flex layout for responsive card widths */
        .cards-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .cards-row .card-container {
            flex: 0 1 23%;
            max-width: 23%;
            margin-bottom: 20px;
        }

        @media (max-width: 991px) {
            .cards-row .card-container {
                flex: 0 1 48%;
                max-width: 48%;
            }
        }

        @media (max-width: 575px) {
            .cards-row .card-container {
                flex: 0 1 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="subscription-container text-center w-100">
            <h2 class="mb-4">Choose Your Subscription Plan</h2>
            <div class="cards-row">
                <!-- Subscription Card 1 -->
                <div class="card-container">
                    <div class="card subscription-card">
                        <h5 class="card-title">Free Plan</h5>
                        <p class="card-text">Get started with melodise</p>
                        <ul class="benefits-list">
                            <li><i class="fas fa-check-circle"></i> Unlimited music play</li>
                            <li><i class="fas fa-check-circle"></i> Explore artists and albums</li>
                            <li><i class="fas fa-check-circle"></i> Free account</li>
                        </ul>
                        <button class="btn btn-success mt-auto">Free</button>
                    </div>
                </div>

                <!-- Subscription Card 2 -->
                <div class="card-container">
                    <div class="card subscription-card">
                        <h5 class="card-title">M+ Monthly Plan</h5>
                        <p class="card-text">Explore and Guide your play choice</p>
                        <ul class="benefits-list">
                            <li><i class="fas fa-check-circle"></i> Unlimited music play</li>
                            <li><i class="fas fa-check-circle"></i> Explore artists and albums</li>
                            <li><i class="fas fa-check-circle"></i> Create Playlists</li>
                            <li><i class="fas fa-check-circle"></i> Follow Your favourite artists</li>
                            <li><i class="fas fa-check-circle"></i> 1 Premium Account</li>
                        </ul>
                        <button class="btn btn-success mt-auto">60tk/month</button>
                    </div>
                </div>

                <!-- Subscription Card 3 -->
                <div class="card-container">
                    <div class="card subscription-card">
                        <h5 class="card-title">M+ Family Plan</h5>
                        <p class="card-text">Explore the world of melody with your close ones</p>
                        <ul class="benefits-list">
                            <li><i class="fas fa-check-circle"></i> Unlimited music play</li>
                            <li><i class="fas fa-check-circle"></i> Explore artists and albums</li>
                            <li><i class="fas fa-check-circle"></i> Create Playlists</li>
                            <li><i class="fas fa-check-circle"></i> Follow Your favourite artists</li>
                            <li><i class="fas fa-check-circle"></i> 4 Premium Accounts</li>
                        </ul>
                        <button class="btn btn-success mt-auto">100tk/month</button>
                    </div>
                </div>

                <!-- Subscription Card 4 -->
                <div class="card-container">
                    <div class="card subscription-card">
                        <h5 class="card-title">M+ Yearly Plan</h5>
                        <p class="card-text">Purchase once a year and get a huge discount!</p>
                        <ul class="benefits-list">
                            <li><i class="fas fa-check-circle"></i> Unlimited music play</li>
                            <li><i class="fas fa-check-circle"></i> Explore artists and albums</li>
                            <li><i class="fas fa-check-circle"></i> Create Playlists</li>
                            <li><i class="fas fa-check-circle"></i> Follow Your favourite artists</li>
                            <li><i class="fas fa-check-circle"></i> 1 Premium Account</li>
                        </ul>
                        <button class="btn btn-success mt-auto">600/year</button>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="d-flex justify-content-center">
                <button onclick="history.back()" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Previous Page</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Font Awesome JavaScript dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>