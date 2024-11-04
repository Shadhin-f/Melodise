<?php 
// session_start();
include('connect.php')
?>

<!doctype html>
<html lang="en">

<style>
.access {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            min-height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.85);
            border: 2px solid #1B8673;
            border-radius: 10px;
            padding: 2rem;
            max-width: 400px; /* Set maximum width */
            width: 100%; /* Full width up to max */
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            text-align: center; /* Center text */
        }

        /* Title styling */
        .container h1 {
            color: #1B8673; /* Change this to your desired color */
            margin-bottom: 1rem; /* Space below title */
            font-size: 2rem; /* Adjust font size */
        }

        /* Error message styling */
        .container h4 {
            color: #1B8673; /* Match your code's primary color */
            margin: 1rem 0; /* Space above and below */
        }

        /* Button styling */
        .btn-custom {
            background-color: #1B8673;
            color: white;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            margin-top: 1rem; /* Space above button */
        }

        .btn-custom:hover {
            background-color: #145a50; /* Darker shade on hover */
        }


</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home Page</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navigation bar -->

    <?php 
        include('navbar.php')
    ?>

<!-- Admin Session Check-->
<?php 
    if(isset($_SESSION['adminname'])) {
        echo "
            <section>

    <!-- Master Control Section -->

    <section id='master-control' class='p-3'>
        <!-- Title -->
        <div id='master-control-title-container' class='d-flex flex-row justify-content-between align-items-center '>
            <h1>Master Controls</h1>  
        </div>
        
        
        <!-- Master Control Cards -->
        <div id='control-card-container' class='d-flex flex-row justify-content-start flex-wrap align-items-center gap-5'>
            <!-- Update Album Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1542208998-f6dbbb27a72f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Album</h5>
                    <p class='card-text'>Modify album details, upload cover images, and manage song lists.</p>
                    <a href='#' class='btn btn-primary'>Update album</a>
                </div>
            </div>

            <!-- Update Music Card -->
            <div class='card' style='width: 18rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996'  style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Music</h5>
                    <p class='card-text'>Add, remove, or edit individual tracks and details.</p>
                    <a href='#' class='btn btn-primary'>Update Music</a>
                </div>
            </div>

            <!-- Update Genre Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1587731556938-38755b4803a6?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Genre</h5>
                    <p class='card-text'>Manage music genres for better categorization.</p>
                    <a href='#' class='btn btn-primary'>Update Genre</a>
                </div>
            </div>

            <!-- Update Genre Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1587731556938-38755b4803a6?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Genre</h5>
                    <p class='card-text'>Manage music genres for better categorization.</p>
                    <a href='#' class='btn btn-primary'>Update Genre</a>
                </div>
            </div>
            
            <!-- Update Genre Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1587731556938-38755b4803a6?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Genre</h5>
                    <p class='card-text'>Manage music genres for better categorization.</p>
                    <a href='#' class='btn btn-primary'>Update Genre</a>
                </div>
            </div>
            
            


            
        </div>
        
    </section>


    <!-- Subsription Control Section -->


    <section id='subscription-control' class='p-3'>
        <!-- Title -->
        <div id='subscription-control-title-container' class='d-flex flex-row flex-wrap justify-content-between align-items-center'>
            <h1>Subscription Controls</h1>  
        </div>
        
        
        <!-- Subsription Control Cards -->
        <div id='control-card-container' class='d-flex flex-row justify-content-start flex-wrap align-items-center gap-5'>
            <!-- Update Subsription Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://plus.unsplash.com/premium_photo-1661963515041-661b417c0b45?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Subsription</h5>
                    <p class='card-text'>Adjust subscription plans, pricing, and benefits.</p>
                    <a href='#' class='btn btn-primary'>Update Subsription</a>
                </div>
            </div>

            <!-- Subsription Analytics Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://plus.unsplash.com/premium_photo-1664303403877-7f079e34aec9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Subsription Analytics</h5>
                    <p class='card-text'>View detailed insights on subscription metrics and trends.</p>
                    <a href='#' class='btn btn-primary'>Analyze</a>
                </div>
            </div>
            
        </div>
        
    </section>


    <!-- Manage Profiles Section -->


    <section id='profile-control' class='p-3'>
        <!-- Title -->
        <div id='profile-control-title-container' class='d-flex flex-row justify-content-between flex-wrap align-items-center'>
            <h1>Manage Profiles</h1>  
        </div>
        
        
        <!-- Manage Profiles Cards -->
        <div id='control-card-container' class='d-flex flex-row justify-content-start flex-wrap align-items-center gap-5'>
            <!-- Update User Info Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1483032469466-b937c425697b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update User Info</h5>
                    <p class='card-text'>Modify user details, access settings, and preferences.</p>
                    <a href='#' class='btn btn-primary'>Update</a>
                </div>
            </div>

            <!-- Update Artist Info Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/youth-group-with-pop-inspired-background_23-2151494787.jpg?t=st=1730347228~exp=1730350828~hmac=71391efa595cd178e4c77bae9e7c3fd8f49a7a80d200498605ddb229652ffe5a&w=1060' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Artist Info</h5>
                    <p class='card-text'>Edit artist profiles, bios, and featured content.</p>
                    <a href='#' class='btn btn-primary'>Update</a>
                </div>
            </div>
            
        </div>
        
    </section>

    <!-- Session Check Ends here -->
</section>
        ";
    } 
    else {
        echo " 
        <section class='access'>
        <div class='container'>
        <h1 class='w3-jumbo w3-animate-top'>Access Denied</h1>
        <hr class='w3-border-white' style='margin:auto;width:50%'>
        <h2 class='w3-center w3-animate-right'>You don't have permission to view this site.</h3>
        <h3 class='w3-center w3-animate-zoom'>🚫🚫🚫🚫</h3>
        <h4 class='w3-center w3-animate-zoom'>Error code: 403 forbidden</h6>
        
        </div>
        </section>
        ";
    }
    ?>


</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>