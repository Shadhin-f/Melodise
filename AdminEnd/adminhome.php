<?php 
// session_start();
include('connect.php')
?>

<!doctype html>
<html lang="en">

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

    <!-- Master Control Section -->


    <section id="master-control" class="p-3">
        <!-- Title -->
        <div id="master-control-title-container" class="d-flex flex-row justify-content-between align-items-center ">
            <h1>Master Controls</h1>  
             <form action="user-actions.php" method="get">
                 <button type="submit" class="themed-btn bg-transparent border-0" name='all-control-btn'>All Master Control</button>
             </form>
        </div>
        
        
        <!-- Master Control Cards -->
        <div id="control-card-container" class="d-flex flex-row justify-content-start align-items-center gap-5">
            <!-- Update Album Card -->
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://images.unsplash.com/photo-1542208998-f6dbbb27a72f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="width: 18rem; height: 12rem;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Update Album</h5>
                    <p class="card-text">Modify album details, upload cover images, and manage song lists.</p>
                    <a href="#" class="btn btn-primary">Update album</a>
                </div>
            </div>

            <!-- Update Music Card -->
            <div class="card" style="width: 18rem; ">
                <img class="card-img-top" src="https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996"  style="width: 18rem; height: 12rem;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Update Music</h5>
                    <p class="card-text">Add, remove, or edit individual tracks and details.</p>
                    <a href="#" class="btn btn-primary">Update Music</a>
                </div>
            </div>

            <!-- Update Genre Card -->
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://images.unsplash.com/photo-1587731556938-38755b4803a6?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="width: 18rem; height: 12rem;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Update Genre</h5>
                    <p class="card-text">Manage music genres for better categorization.</p>
                    <a href="#" class="btn btn-primary">Update Genre</a>
                </div>
            </div>
            
        </div>
        
    </section>


    <!-- Subsription Control Section -->


    <section id="subscription-control" class="p-3">
        <!-- Title -->
        <div id="subscription-control-title-container" class="d-flex flex-row justify-content-between align-items-center">
            <h1>Subscription Controls</h1>  
            
             <form action="user-actions.php" method="get">
                 <button type="submit" class="themed-btn bg-transparent border-0" name='all-control-btn'>All Subscription Control</button>
             </form>
        </div>
        
        
        <!-- Subsription Control Cards -->
        <div id="control-card-container" class="d-flex flex-row justify-content-start align-items-center gap-5">
            <!-- Update Subsription Card -->
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://plus.unsplash.com/premium_photo-1661963515041-661b417c0b45?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="width: 18rem; height: 12rem;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Update Subsription</h5>
                    <p class="card-text">Adjust subscription plans, pricing, and benefits.</p>
                    <a href="#" class="btn btn-primary">Update Subsription</a>
                </div>
            </div>

            <!-- Subsription Analytics Card -->
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://plus.unsplash.com/premium_photo-1664303403877-7f079e34aec9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="width: 18rem; height: 12rem;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Subsription Analytics</h5>
                    <p class="card-text">View detailed insights on subscription metrics and trends.</p>
                    <a href="#" class="btn btn-primary">Analyze</a>
                </div>
            </div>
            
        </div>
        
    </section>


    <!-- Manage Profiles Section -->


    <section id="profile-control" class="p-3">
        <!-- Title -->
        <div id="profile-control-title-container" class="d-flex flex-row justify-content-between align-items-center">
            <h1>Manage Profiles</h1>  
             <form action="user-actions.php" method="get">
                 <button type="submit" class="themed-btn bg-transparent border-0" name='all-control-btn'>All Profile Control</button>
             </form>
        </div>
        
        
        <!-- Manage Profiles Cards -->
        <div id="control-card-container" class="d-flex flex-row justify-content-start align-items-center gap-5">
            <!-- Update User Info Card -->
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://images.unsplash.com/photo-1483032469466-b937c425697b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="width: 18rem; height: 12rem;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Update User Info</h5>
                    <p class="card-text">Modify user details, access settings, and preferences.</p>
                    <a href="#" class="btn btn-primary">Update</a>
                </div>
            </div>

            <!-- Update Artist Info Card -->
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://img.freepik.com/free-photo/youth-group-with-pop-inspired-background_23-2151494787.jpg?t=st=1730347228~exp=1730350828~hmac=71391efa595cd178e4c77bae9e7c3fd8f49a7a80d200498605ddb229652ffe5a&w=1060" style="width: 18rem; height: 12rem;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Update Artist Info</h5>
                    <p class="card-text">Edit artist profiles, bios, and featured content.</p>
                    <a href="#" class="btn btn-primary">Update</a>
                </div>
            </div>
            
        </div>
        
    </section>

</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>