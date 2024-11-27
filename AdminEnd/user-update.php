<?php 
include('connect.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle, rgba(232,247,244,1) 0%, rgba(211,231,228,1) 100%);
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container-custom {
            background-color: white;
            border: 2px solid #1B8673;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            max-width: 700px;
            margin-top: 2rem;
        }

        .text-primary-custom {
            color: #1B8673;
        }

        .btn-custom {
            background-color: #1B8673 !important;
            color: white !important;
            border-radius: 50px;
            padding: 0.4rem 1.2rem;
        }

        .edit-btn-custom{
            background-color: #4DAE96 !important;
            border-color: #1B8673 !important;
            color: white !important;
            border-radius: 10px;
            padding: 0.4rem 1.2rem;
        }

        .btn-custom:hover {
            background-color: #145a50 !important;
        }
    </style>
</head>

<body>

    <!-- Navigation bar -->

    <?php 
        include('navbar.php')
    ?>
    
    <!-- Main Search Section -->
    <section class="container container-custom">
        <h2 class="text-primary-custom mb-4">Search Users</h2>
        
        <!-- Search Form -->
        <form action="adminaction.php" method="post">
            <div class="input-group mb-4">
                <input type="text" class="form-control" placeholder="Enter username or email" aria-label="Search" name='user-search-key' required>
                <button class="btn btn-custom" type="submit" name='user-search-btn'>
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>

        <!-- User List Table -->

        <?php 
            if(isset($_SESSION['user-search-key'])){
                $searchKey = $_SESSION['user-search-key'];
                echo "
                  <div class='table-responsive'>
                <table class='table table-bordered align-middle'>
                    <thead class='table-light'>
                    <tr>
                        <th scope='col'>User ID</th>
                        <th scope='col'>User Name</th>
                        <th scope='col'>User Email</th>
                        <th scope='col'>Action</th>
                    </tr>
                </thead>
                <tbody>
                ";

                // Query to search user using name or Email

                $select_users = "SELECT * FROM `users` WHERE Email LIKE '%" . $searchKey . "%' OR Name LIKE '%" . $searchKey . "%'";                   
                $result_users = mysqli_query($conn, $select_users);


                while ($row_data = mysqli_fetch_assoc($result_users)){
                    $userID = $row_data['UserID'];
                    $userName = $row_data['Name'];
                    $userEmail = $row_data['Email'];


                    

                    echo "
                    <tr>
                        <td>$userID</td>
                        <td>$userName</td>
                        <td>$userEmail</td>
                        <td>
                            <form action='adminaction.php' method='post'>
                                <input type='hidden' name='user_email' value='$userEmail'>
                                <button type='submit' class='btn edit-btn-custom' name='user-profile-edit-btn'>Edit</button>
                            </form>
                        </td>
                    </tr>
                    ";

                }
                echo "
                    </tbody>
                    </table>
                </div>
                ";
                

            }
            else{
                echo "No search key";
            }
        ?>


        
    </section>

    <!-- FontAwesome & Bootstrap JS -->
    <script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
