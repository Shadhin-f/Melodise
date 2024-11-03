<?php
include('connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">
    <style>
        /* .bg-image { */
        /* Add the blur effect */
        /* filter: blur(8px); */
        /* -webkit-filter: blur(8px); */
        /* } */
        .custom-btn {
            color: #1B8673;
            border-color: #1B8673;
            background-color: transparent;
        }

        .custom-btn:hover {
            background-color: #1B8673;
            color: #ffffff;
        }

        .p-card-background {
            background: rgb(213, 249, 139);
            background: linear-gradient(207deg, rgba(213, 249, 139, 1) 0%, rgba(207, 243, 255, 1) 100%);
        }
    </style>
</head>

<body>

    <?php
    if (!isset($_SESSION['username'])) {
        echo '<script>
                alert("Login to view your profile!!");
                window.location.href = "login.php";
            </script>';
    } else {


        // $_SESSION['username'] = $user_data['Name'];
        // $_SESSION['email'] = $user_data['Email'];
        // $_SESSION['usertype'] = $userType;



        $userEmail = $_SESSION['email'];                        // Key for user
        $userName = $_SESSION['username'];
        $userType = $_SESSION['usertype'];                      // store the subscriotin type number 


        // Fetching user information from the server

        $select_user = "SELECT * FROM `users` WHERE Email = '$userEmail'";                   // query to select user information
        $result_user = mysqli_query($conn, $select_user);
        $user_data = mysqli_fetch_assoc($result_user);


        $user_country = $user_data['Country'];
        $user_image = $user_data['Image'];
        echo "
            <section class='vh-100 bg-image' style='background-image: url(\"../Resources/DesignElements/ProfileBack.jpg\"); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;''>
                    <div class='container py-5 h-100'>
                        <div class='row d-flex justify-content-center align-items-center h-100'>
                            <div class='col-md-12 col-xl-4 '>



                                <!--  Card Container -->



                                <div class='card p-card-background' style='border-radius: 15px;'>
                                    <div class='card-body text-center'>
                                        <div class='mt-3 mb-4'>
                                            <div class=' artist-img-circle mx-auto rounded-circle mt-2' style='width: 10rem; height: 10rem; background-image: url(\"../Resources/UserImages/$user_image\"); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;'>
                    </div>
                    </div>
                    <h4 class='mb-2'>$userName</h4>
                    <p class='text-muted mb-4'>$user_country <span class='mx-2'>|</span> $userEmail </p>

                    <form action='user-actions.php' method='post' class='d-flex flex-column justify-content-center align-items-center mt-5 mb-2'>
                        <button type='submit' data-mdb-button-init data-mdb-ripple-init  class='btn btn-primary btn-rounded btn-md d-block w-75 mb-3 custom-btn' name='profile-edit-btn'>Edit Profile</button>";
        if ($userType == 1) {
            // Subscription buy button active if the user is free
            echo "
                            <button type='submit' data-mdb-button-init data-mdb-ripple-init class='btn btn-primary btn-rounded btn-md d-block w-75 mb-3 custom-btn'>Buy Melodise+</button>";
        }
        echo "
                        <button type='submit' data-mdb-button-init data-mdb-ripple-init class='btn btn-primary btn-rounded btn-md d-block w-75 custom-btn' name='logout-btn'>Log out</button>
                    </form>
                    <div class='d-flex justify-content-around text-center mt-5 mb-2'>
                        <div>
                            <p class='mb-2 h5'>8471</p>
                            <p class='text-muted mb-0'>Followers</p>
                        </div>
                        <!-- <div class='px-3'>
                            <p class='mb-2 h5'>8512</p>
                            <p class='text-muted mb-0'>Income amounts</p>
                          </div> -->
                        <div>
                            <p class='mb-2 h5'>30</p>
                            <p class='text-muted mb-0'>Playlists Created</p>
                        </div>
                    </div>
                    <div>
                        <form action='user-actions.php' method='get' class='d-block'>
                            <button type='submit' class='btn themed-btn btn-rounded custom-btn px-3 py-2' name='back-to-home-btn'>Home</button>
                        </form>
                    </div>
                    </div>
                    </div>

                    </div>
                    </div>
                    </div>
                </section>
        ";
    }

    ?>


    <!-- Modal overlay to update user info -->


    <!-- Modal -->





    <!-- <form action='user-actions.php' method='post'></form> -->




    <!-- Social icon Saved for later use cases -->



    <!-- <div class="mb-4 pb-2">
            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-floating">
                <i class="fab fa-facebook-f fa-lg"></i>
            </button>
            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-floating">
                <i class="fab fa-twitter fa-lg"></i>
            </button>
            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-floating">
                <i class="fab fa-skype fa-lg"></i>
            </button>
        </div> -->


</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
</html>