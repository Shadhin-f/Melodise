<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
        }

        /* Hero Section */
        .hero-section {
            background-color: #1b8673;
            color: white;
            padding: 100px 20px;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 40px;
        }

        .nav-button {
            background-color: white;
            color: #1b8673;
            border: 2px solid #1b8673;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .nav-button:hover {
            background-color: #1b8673;
            color: white;
        }

        /* Features Section */
        .features-section,
        .guidelines-section {
            padding: 60px 20px;
        }

        .features-section h2,
        .guidelines-section h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .feature-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .feature-card:hover {
            border-color: #1b8673;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Setup Guidelines Section */
        .guideline-step {
            border-left: 3px solid #1b8673;
            padding-left: 15px;
            margin-bottom: 20px;
        }

        /* Members Section */
        .credits-section {
            background-color: #f1f1f1;
            padding: 60px 20px;
        }

        .member-card {
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s;
        }

        .member-card:hover {
            border-color: #1b8673;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .member-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Welcome to MELODISE</h1>
        <p>Choose your path: User, Artist, or Admin</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="http://localhost/website/melodise//userend/login.php" class="nav-button"><i class="fas fa-user"></i> User End</a>
            <a href="http://localhost/website/melodise/artistend/artistlogin.php" class="nav-button"><i class="fas fa-microphone"></i> Artist End</a>
            <a href="http://localhost/website/melodise/adminend/adminlogin.php" class="nav-button"><i class="fas fa-user-shield"></i> Admin End</a>
        </div>
    </div>

    <!-- Features Section -->
    <section class="features-section">
        <h2>Key Features</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-music fa-3x mb-3"></i>
                        <h5>User End Features</h5>
                        <p>Discover and listen to your favorite music with an intuitive user interface.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-guitar fa-3x mb-3"></i>
                        <h5>Artist End Features</h5>
                        <p>Manage your songs and albums, and connect with your fans seamlessly.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-cogs fa-3x mb-3"></i>
                        <h5>Admin End Features</h5>
                        <p>Oversee and manage the entire platform with powerful administrative tools.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Setup Guidelines Section -->
    <section class="guidelines-section bg-light">
        <h2>Setup Guidelines</h2>
        <div class="container">
            <div class="guideline-step">
                <h5>Step 1: Setup Database</h5>
                <p>Import the database <code> [melodise_db]</code></p>
            </div>
            <div class="guideline-step">
                <h5>Step 2: Start Server</h5>
                <p>Start <code>Apache & MySQL</code> server</p>
            </div>
            <div class="guideline-step">
                <h5>Step 3: Copy Files</h5>
                <p>Copy all the <code>Project files</code> in the correct folder <code> [ Xampp/htdocs/website ]</code> <i> (Create the website folder inside htdocs)</i></p>
                <p>Paste the <code>Melodise</code> folder inside <code>website</code> folder</p>
            </div>
            <div class="guideline-step">
                <h5>Step 4: Explore Melodise</h5>
                <p>User proper links to nevigate to <code>MELODISE</code> streamimg platform</p>
            </div>
        </div>
    </section>

    <!-- Credits Section -->
    <section class="credits-section">
        <h2 class="text-center">Meet the Team</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="member-card d-flex flex-column align-items-center">
                        <div class="member-img" style="background-image: url('./GroupMates/uma.JPG');"></div>
                        <h5>Uma Banik</h5>
                        <p>Worked on Admin End</p>
                        <p>Contribution: Backend development and database management.</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="member-card d-flex flex-column align-items-center">
                        <div class="member-img" style="background-image: url('./GroupMates/badhon.jpg');"></div>
                        <h5>Badhon Datta</h5>
                        <p>Worked on Artist End</p>
                        <p>Contribution: UI/UX design and front-end development.</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="member-card d-flex flex-column align-items-center">
                        <div class="member-img" style="background-image: url('./GroupMates/tanveer.jpg');"></div>
                        <h5>Tanveer Ahmed</h5>
                        <p>Worked on Artist End</p>
                        <p>Contribution: Project coordination and feature planning.</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="member-card d-flex flex-column align-items-center">
                        <div class="member-img" style="background-image: url('./GroupMates/shadhin.jpg');"></div>
                        <h5>Tahshan Jamil Shadhin</h5>
                        <p>Worked on User End</p>
                        <p>Contribution: Quality assurance and bug testing.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



    <script>
    // Function to check if a page is available
    function checkPage(url, fallbackUrl) {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    // Redirect if the page is not available
                    window.location.href = fallbackUrl;
                }
            })
            .catch(() => {
                // Redirect on network error
                window.location.href = fallbackUrl;
            });
    }

    // Check each link and redirect if necessarys
    checkPage('http://localhost/website/melodise//userend/login.php','http://localhost:8080/website/melodise/userend/login.php');
    checkPage('http://localhost/website/melodise/artistend/artistlogin.php', 'http://localhost:8080/website/melodise/artistend/artistlogin.php');
    checkPage('http://localhost/website/melodise/adminend/adminlogin.php','http://localhost:8080/website/melodise/adminend/adminlogin.php');
</script>
</body>

</html>