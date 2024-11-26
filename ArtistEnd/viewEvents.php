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
</head>
<body>
<div class="container mt-5">
<div style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <h1>Your Upcoming Events</h1>
</div>
    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        <a href="addEvent.php" class="btn btn-primary">Add New Event</a>
    </div>
    <?php
    // Fetch all events for the logged-in artist
    $fetch_events = "SELECT * FROM `upcoming_events` WHERE `ArtistID` = '$artistID' ORDER BY `EventDate`";
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

            // Correct path for displaying the image
            $eventImagePath = "../Resources/EventImages/" . $eventImage;

            echo "
            <div class='col-md-4 mb-4'>
                <div class='card shadow-sm'>
                    <img src='$eventImagePath' class='card-img-top' alt='Event Image' style='height: 200px; object-fit: cover;'>
                    <div class='card-body'>
                        <h5 class='card-title'>$eventTitle</h5>
                        <p class='card-text'><strong>Date:</strong> $eventDate<br>
                        <strong>Time:</strong> $eventTime<br>
                        <strong>Location:</strong> $eventLocation</p>
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
