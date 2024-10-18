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
                                <label for="loginEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="loginEmail" placeholder="Enter email" name="loginEmail">
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="loginPassword">
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="login-button">Login</button>
                        </form>



                        <!-- Registration Form -->


                        <form id="registration-form" class="d-none" action="user-actions.php" method="post">
                            <div class="mb-3">
                                <label for="regName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="regName" placeholder="Enter full name" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="regEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="regEmail" placeholder="Enter email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="regPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="regPassword" placeholder="Password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="re-regPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="re-regPassword" placeholder="Password" name="re-password">
                            </div>

                            <!-- Date of Birth Field -->
                            <div class="mb-3">
                                <label for="regDob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="regDob" placeholder="Enter Date of Birth" name="dob">
                            </div>

                            <!-- Country Field -->
                            <div class="mb-3">
                                <label for="regCountry" class="form-label">Country</label>
                                <select id="regCountry" class="form-select" name="country">
                                    <option selected>Select Country</option>
                                    <option value="USA">United States</option>
                                    <option value="Canada">Canada</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="Australia">Australia</option>
                                    <option value="India">India</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <!-- Add more countries as needed -->
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100" name="registration-buttom">Register</button>
                        </form>

                        <p class="text-center mt-3">
                            <span id="toggle-text">Don't have an account? </span>
                            <span id="toggle-btn" class="toggle-btn">Register</span>
                        </p>



                        <!-- Continue as Guest Button -->



                        <p class="text-center mt-3">
                            <form action="user-actions.php" method="post">
                                <button id="guest-btn" class="btn btn-secondary w-100" name="guest-view-button">Continue as Guest</button>
                            </form>
                        </p>
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

        // Event listener for "Continue as Guest" button
        // document.getElementById('guest-btn').addEventListener('click', function() {
        //     alert('Continuing as Guest...');
        //     // Here you can add logic to redirect the user or perform any other guest action
        //     // For example:
        //     // window.location.href = '/guest-dashboard'; // redirect to guest dashboard
        // });
    </script>

</body>
</html>
