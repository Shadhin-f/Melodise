<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MELODISE ARTIST</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        /* Background image for the whole page */
        body {
            background-image: url('../Resources/DesignElements/ProfileEditBack.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Centered form card style */
        .form-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Logo and title styling */
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #1B8673;
        }

        /* Input field styling */
        .form-control {
            border: none;
            border-bottom: 2px solid #1B8673;
            border-radius: 0;
            box-shadow: none;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #1B8673;
        }

        /* Button styling */
        .btn-custom {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
        }

        .btn-login {
            background-color: #1B8673;
            color: white;
        }

        .btn-login:hover {
            background-color: #145a50;
        }

        .toggle-btn {
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .toggle-btn:hover {
            /* Change to desired hover background color */
            color: #1B8673;
            /* Change to desired hover text color */
        }
    </style>
</head>

<body>


    <div class="form-card text-center">
        <div class="logo mb-3">MELODISE ARTIST</div>
        <h2 id="form-title" class="mb-4">Login</h2>

        <!-- Login Form -->
        <form id="login-form" action="artistActions.php" method="post">
            <div class="mb-3">
                <input type="email" class="form-control" id="loginEmail" placeholder="Enter email" name="loginEmail" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="loginPassword" required>
            </div>
            <button type="submit" class="btn btn-custom btn-login w-100" name="login-button">Login</button>
        </form>

        <!-- Registration Form -->
        <form id="registration-form" class="d-none" action="artistActions.php" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" id="regName" placeholder="Enter full name" name="username" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" id="regEmail" placeholder="Enter email" name="email" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" id="regBio" placeholder="Enter bio" name="bio" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" id="regDob" placeholder="Enter Date of Birth" name="dob" required>
            </div>
            <!-- Gender radio buttons -->
            <div class="mb-3 text-start">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderMale" name="gender" value="Male" required>
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderFemale" name="gender" value="Female" required>
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderOther" name="gender" value="Others" required>
                    <label class="form-check-label" for="genderOther">Other</label>
                </div>
            </div>
            <div class="mb-3">
                <select id="regCountry" class="form-select form-control" name="country">
                    <option value="Bangladesh">Select Country</option>
                    <option value="USA">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="UK">United Kingdom</option>
                    <option value="Australia">Australia</option>
                    <option value="India">India</option>
                    <option value="Bangladesh">Bangladesh</option>
                </select>
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="regPassword" placeholder="Password" name="password" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="re-regPassword" placeholder="Confirm Password" name="re-password" required>
            </div>

            <button type="submit" class="btn btn-custom btn-login w-100" name="registration-button">Register</button>
        </form>

        <p class="text-center mt-3">
            <span id="toggle-text">Don't have an account? </span>
            <span id="toggle-btn" class="toggle-btn">Register</span>
        </p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Javascript to toggle register and login btn -->
    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            const loginForm = document.getElementById('login-form');
            const regForm = document.getElementById('registration-form');
            const formTitle = document.getElementById('form-title');
            const toggleText = document.getElementById('toggle-text');
            const toggleBtn = document.getElementById('toggle-btn');

            if (loginForm.classList.contains('d-none')) {
                loginForm.classList.remove('d-none');
                regForm.classList.add('d-none');
                formTitle.textContent = 'Login';
                toggleText.textContent = "Don't have an account? ";
                toggleBtn.textContent = 'Register';
            } else {
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
