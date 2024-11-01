<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">

    <title>Navbar</title>

    <style>
        /* Larger logo */
        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
        }

        /* Larger nav items */
        .nav-link {
            font-size: 1.2rem;
        }

        /* Wider search bar for larger screens */
        .form-control {
            width: 300px;
        }

        /* Username button */
        .username-btn {
            border: none;
            background-color: transparent;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }

        .username-btn:hover {
            color: #1B8673;
            cursor: pointer;
        }

        /* Style for icon inside the button */
        .username-btn i {
            margin-left: 8px;
            font-size: 1.2rem;
            /* Adjust icon size */
        }

        /* Media queries for responsive design */
        @media (max-width: 576px) {

            /* Adjust search bar width on mobile screens */
            .form-control {
                width: 150px;
                /* Smaller width for mobile */
            }

            /* Make sure search bar and button stay on the same line */
            .form-inline {
                flex-direction: row;
                /* Keep elements in a single row */
                width: 100%;
                /* Ensure the form fits within available space */
            }

            /* Collapse username button to a new line on mobile screens */
            .username-btn {
                display: block;
                text-align: center;
                width: 100%;
                /* Full width to ensure it goes to a new line */
                margin-top: 10px;
                /* Add some space between the search bar and username button */
            }

            .username-btn i {
                margin-left: 0;
                /* Align icon with text in center */
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 py-3">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="index.php">MELODISE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                
                
                <div class="ms-auto d-flex align-items-center">   <!-- Spacer to push search and user elements to the right -->
                    
                    <!-- Search bar -->
                    
                    <form class="d-flex" action="user-actions.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search-key">
                        <button class="btn btn-outline-success" type="submit" name="search-btn">Search</button>
                    </form>

                    <!-- Login button or User Profile Button Based on login session -->
                    
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "
                            <button class='btn btn-outline-secondary mx-2' type='button'>Login</button>
                            <button class='btn btn-outline-primary mx-2' type='button'>Register</button>";
                    } else {
                        $firstName = strtok($_SESSION['username'], ' ');
                        echo "
                            <button class='username-btn mx-2'>$firstName <i class='fa-solid fa-user'></i></button>
                        ";
                    }
                    ?>
                </div> 
            </div>
        </div>
    </nav>
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>