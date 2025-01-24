<?php 
session_start();
include('connect.php');

// Check if the artist is logged in
if (!isset($_SESSION['artistid'])) {
    header('Location: artistlogin.php');
    exit();
}

$artistID = $_SESSION['artistid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .card {
            position: relative;
            width: 25rem;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <!-- Header Section -->
    <section id="section-header" class="px-5 my-5 d-flex justify-content-between align-items-center">
        <!-- Back Button -->
        <form action="artistActions.php" method="get" class="d-inline-block">
            <button type="submit" class="themed-btn bg-transparent border-0" name="back-to-dashboard-btn">
                <i class="fa-solid fa-arrow-left h1"></i>
            </button>
        </form>
        <!-- Page Title -->
        <h1 class="d-inline-block">Your Upcoming Events</h1>
        <!-- Add New Event Button -->
        <a href="addEvent.php" class="btn btn-primary">Add New Event</a>
    </section>
    
    <?php
    // Map of city names to PHP timezones
    $cityToTimezone = [
        'Dhaka' => 'Asia/Dhaka',
        'New York' => 'America/New_York',
        'London' => 'Europe/London',
        'Tokyo' => 'Asia/Tokyo',
        'Sydney' => 'Australia/Sydney',
    ];

    // Input city (you can replace this with dynamic user input if needed)
    $city = 'Dhaka';
    $timezone = isset($cityToTimezone[$city]) ? $cityToTimezone[$city] : 'UTC';
    date_default_timezone_set($timezone);

    // Get today's date
    $today = date('Y-m-d');

    // Fetch events along with follower counts for the logged-in artist
    $fetch_events = "SELECT e.*, IFNULL(COUNT(f.userid), 0) AS FollowerCount
    FROM `upcoming_events` e
    LEFT JOIN `event_followers` f ON e.EventID = f.EventID
    WHERE e.ArtistID = '$artistID'
    GROUP BY e.EventID
    ORDER BY e.EventDate";

    $result_events = mysqli_query($conn, $fetch_events);

    if ($result_events && mysqli_num_rows($result_events) > 0) {
        echo '<div class="row">';
        while ($row_event = mysqli_fetch_assoc($result_events)) {
            $eventID = $row_event['EventID'];
            $eventTitle = htmlspecialchars($row_event['EventTitle']);
            $eventDescription = htmlspecialchars($row_event['EventDescription']);
            $eventDate = htmlspecialchars($row_event['EventDate']);
            $eventTime = htmlspecialchars($row_event['EventTime']);
            $eventLocation = htmlspecialchars($row_event['EventLocation']);
            $eventImage = !empty($row_event['EventImage']) ? $row_event['EventImage'] : 'default-event.jpg';
            $followerCount = $row_event['FollowerCount'];

            // Correct path for displaying the image
            $eventImagePath = "../Resources/EventImages/" . $eventImage;

            // Check if the event date has expired
            $isExpired = $eventDate < $today;
            $expiryLabel = $isExpired ? "<span class='text-danger'>Expired</span>" : "";

            echo "
            <div class='col-md-4 mb-4'>
                <div class='card shadow-sm'>
                    <img src='$eventImagePath' class='card-img-top' alt='Event Image' style='height: 200px; object-fit: cover;'>
                    <div class='card-body'>
                        <h5 class='card-title'>$eventTitle $expiryLabel</h5>
                        <p class='card-text'>
                            <strong>Date:</strong> $eventDate<br>
                            <strong>Time:</strong> $eventTime<br>
                            <strong>Location:</strong> $eventLocation<br>
                            <strong>Event Followers:</strong> $followerCount
                        </p>
                        <p class='card-text'>$eventDescription</p>
                        <a href='editEvent.php?event_id=$eventID' class='btn btn-primary btn-sm'>Edit</a>
                        <a href='deleteEvent.php?event_id=$eventID' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this event?\");'>Delete</a>
                    </div>
                </div>
            </div>";
        }
        echo '</div>';
    } else {
        echo "<div class='alert alert-info'>No upcoming events found. <a href='addEvent.php'>Click here</a> to add one.</div>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
