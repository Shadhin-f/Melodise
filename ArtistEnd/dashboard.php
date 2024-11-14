<?php
session_start();
if (!isset($_SESSION['artistname'])) {
    header("Location: artistlogin.php");
    exit();
}

// Sample data - replace with real data from your database as needed
$artistData = [
    'username' => $_SESSION['artistname'],
    'bio' => "An independent artist specializing in soulful music.",
    'totalStreams' => 5000,
    'topSong' => "Echoes of Time",
    'recentFeedback' => [
        ["name" => "Alice", "comment" => "Loved the new track!"],
        ["name" => "Bob", "comment" => "Amazing beats! Keep it up!"]
    ],
    'upcomingEvents' => [
        ["date" => "2024-11-20", "location" => "NYC Jazz Club", "event" => "Jazz Night"],
        ["date" => "2024-12-05", "location" => "LA Theater", "event" => "Soul Fest"]
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .dashboard-header {
            background-color: #343a40;
            color: #ffffff;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Responsive columns */
            gap: 20px;
        }

        .dashboard-section {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .dashboard-section:hover {
            transform: translateY(-5px);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
            border-bottom: 2px solid #1B8673;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .insights-stat {
            font-size: 1.2rem;
            color: #1B8673;
        }

        .feedback-comment {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .feedback-comment strong {
            color: #343a40;
        }

        .upcoming-event {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #e9ecef;
        }

        .btn-custom {
            background-color: #1B8673;
            color: white;
        }

        .btn-custom:hover {
            background-color: #155f50;
            color: white;
        }

        .quick-links {
            display: flex;
            gap: 10px;
        }

        .wide-card {
            grid-column: span 2; /* Makes the card take up the space of two columns */
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <!-- Header Section -->
        <div class="dashboard-header">
            <h1>Welcome, <?php echo htmlspecialchars($artistData['username']); ?>!</h1>
            <p>Here's a quick overview of your artist profile.</p>
        </div>

        <!-- Main Dashboard Container (Irregular Grid Layout) -->
        <div class="dashboard-container">
            <!-- Profile Overview Section -->
            <section class="dashboard-section wide-card">
                <div class="section-title">Profile Overview</div>
                <p><strong>Bio:</strong> <?php echo htmlspecialchars($artistData['bio']); ?></p>
                <a href="edit-profile.php" class="btn btn-custom">Edit Profile</a>
            </section>

            <!-- Recent Releases Section -->
            <section class="dashboard-section">
                <div class="section-title">Recent Releases</div>
                <p>List your recent releases here with links to manage them.</p>
                <a href="add-release.php" class="btn btn-outline-success">Add New Release</a>
            </section>

            <!-- Performance Insights Section -->
            <section class="dashboard-section">
                <div class="section-title">Performance Insights</div>
                <p class="insights-stat"><strong>Total Streams:</strong> <?php echo number_format($artistData['totalStreams']); ?></p>
                <p class="insights-stat"><strong>Top Song:</strong> <?php echo htmlspecialchars($artistData['topSong']); ?></p>
            </section>

            <!-- Feedback/Reviews Section -->
            <section class="dashboard-section">
                <div class="section-title">Feedback</div>
                <?php if (!empty($artistData['recentFeedback'])): ?>
                    <ul class="list-group">
                        <?php foreach ($artistData['recentFeedback'] as $feedback): ?>
                            <li class="list-group-item feedback-comment">
                                <strong><?php echo htmlspecialchars($feedback['name']); ?>:</strong> <?php echo htmlspecialchars($feedback['comment']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No feedback yet.</p>
                <?php endif; ?>
                <a href="feedback.php" class="btn btn-outline-info mt-2">View All Feedback</a>
            </section>

            <!-- Upcoming Events Section -->
            <section class="dashboard-section wide-card">
                <div class="section-title">Upcoming Events</div>
                <?php if (!empty($artistData['upcomingEvents'])): ?>
                    <ul class="list-group">
                        <?php foreach ($artistData['upcomingEvents'] as $event): ?>
                            <li class="list-group-item upcoming-event">
                                <strong><?php echo htmlspecialchars($event['event']); ?></strong> - <?php echo htmlspecialchars($event['date']); ?> at <?php echo htmlspecialchars($event['location']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No upcoming events.</p>
                <?php endif; ?>
                <a href="add-event.php" class="btn btn-outline-success mt-2">Add New Event</a>
            </section>

            <!-- Quick Links Section -->
            <section class="dashboard-section">
                <div class="section-title">Quick Links</div>
                <div class="quick-links">
                    <a href="upload.php" class="btn btn-custom">Upload New Content</a>
                    <a href="settings.php" class="btn btn-secondary">Account Settings</a>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
