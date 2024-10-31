<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MELODISE</title>
    
    <!-- Bootsttrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->

    <style>
        .form-container {
            margin-top: 50px;
        }
        .toggle-btn {
            cursor: pointer;
            color: #007bff;
        }
        .toggle-btn:hover {
            text-decoration: underline;
        }
        .toggle-btn:focus {
            outline: none;
        }
        .header {
            text-align: center;
            margin-top: 20px;
        }
        .header h1 {
            font-size: 2rem;
            color: #007bff;
        }
        .header p {
            font-size: 1rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <!-- Header Section -->


    <div class="header">
        <h1>Welcome to MELODISE</h1>
        <p>Your personal music streaming platform</p>
    </div>

    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 id="form-title" class="text-center mb-4">Login</h3>

                        <!-- Login Form -->


                        <form id="login-form" action="user-actions.php" method="post">
                            <div class="mb-3">
                                <label for="loginID" class="form-label">Admin ID</label>
                                <input type="text" class="form-control" id="loginID" placeholder="Enter ID" name="loginID">
                            </div>
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="loginEmail" placeholder="Enter email" name="loginEmail">
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="loginPassword">
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="login-button">Login</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybXTdE6jSHH4LlbA6b1CZCEN57TZzS0uT1GFqsZV5ZCfl2TO5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-qWz6jrpIpLwS05XX39A6/pQUjjfC9uOO+V52PUvF+MUCf/UFAfIPAOIMSOFprRIp" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            const loginForm = document.getElementById('login-form');
            const regForm = document.getElementById('registration-form');
            const formTitle = document.getElementById('form-title');
            const toggleText = document.getElementById('toggle-text');
            const toggleBtn = document.getElementById('toggle-btn');
            
            if (loginForm.classList.contains('d-none')) {
                // Switch to Login Form
                loginForm.classList.remove('d-none');
                regForm.classList.add('d-none');
                formTitle.textContent = 'Login';
                toggleText.textContent = "Don't have an account? ";
                toggleBtn.textContent = 'Register';
            } else {
                // Switch to Registration Form
                loginForm.classList.add('d-none');
                regForm.classList.remove('d-none');
                formTitle.textContent = 'Register';
                toggleText.textContent = 'Already have an account? ';
                toggleBtn.textContent = 'Login';
            }
        });

    </script>

</body>
</html>
