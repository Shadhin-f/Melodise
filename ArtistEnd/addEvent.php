<?php
session_start();
include('connect.php');

// Check if the artist is logged in
if (!isset($_SESSION['artistid'])) {
    header('Location: artistlogin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $artistID = $_SESSION['artistid'];
    $eventTitle = mysqli_real_escape_string($conn, $_POST['event_title']);
    $eventDescription = mysqli_real_escape_string($conn, $_POST['event_description']);
    $eventDate = $_POST['event_date'];
    $eventTime = $_POST['event_time'];
    $eventLocation = mysqli_real_escape_string($conn, $_POST['event_location']);

    // Handle event image upload
    if (!empty($_FILES['event_image']['name'])) {
        $eventImage = $_FILES['event_image']['name'];
        $targetDir = "../Resources/EventImages/"; // Correct path for the event images directory
        $targetFile = $targetDir . basename($eventImage);

        // Move uploaded file to the correct directory
        if (move_uploaded_file($_FILES['event_image']['tmp_name'], $targetFile)) {
            // Image uploaded successfully
        } else {
            echo "<script>alert('Error uploading image!');</script>";
        }
    } else {
        $eventImage = null; // No image selected
    }

    // Insert event into the database
    $insert_event = "INSERT INTO upcoming_events (ArtistID, EventTitle, EventDescription, EventDate, EventTime, EventLocation, EventImage)
                     VALUES ('$artistID', '$eventTitle', '$eventDescription', '$eventDate', '$eventTime', '$eventLocation', '$eventImage')";

    if (mysqli_query($conn, $insert_event)) {
        echo "<script>alert('Event added successfully!'); window.location = 'viewEvents.php';</script>";
    } else {
        echo "<script>alert('Error adding event!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Event</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="event_title" class="form-label">Event Title</label>
            <input type="text" class="form-control" id="event_title" name="event_title" required>
        </div>
        <div class="mb-3">
            <label for="event_description" class="form-label">Event Description</label>
            <textarea class="form-control" id="event_description" name="event_description"></textarea>
        </div>
        <div class="mb-3">
            <label for="event_date" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="event_date" name="event_date" required>
        </div>
        <div class="mb-3">
            <label for="event_time" class="form-label">Event Time</label>
            <input type="time" class="form-control" id="event_time" name="event_time">
        </div>
        <div class="mb-3">
            <label for="event_location" class="form-label">Event Location</label>
            <input type="text" class="form-control" id="event_location" name="event_location">
        </div>
        <div class="mb-3">
            <label for="event_image" class="form-label">Event Image</label>
            <input type="file" class="form-control" id="event_image" name="event_image">
        </div>
        <button type="submit" class="btn btn-primary">Add Event</button>
    </form>
</div>
</body>
</html>
