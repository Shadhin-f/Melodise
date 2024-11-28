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

    // Fetch the latest EventID and generate new EventID
    $query = "SELECT MAX(EventID) AS LatestEventID FROM upcoming_events";
    $result = mysqli_query($conn, $query);
    $latestEventID = mysqli_fetch_assoc($result)['LatestEventID'] ?? 0;
    $newEventID = $latestEventID + 1;  // Increment EventID

    // Handle event image upload
    if (!empty($_FILES['event_image']['name'])) {
        $eventImage = $_FILES['event_image']['name'];
        $targetDir = "../Resources/EventImages/"; // Correct path for the event images directory
        $targetFile = $targetDir . $newEventID . "." . strtolower(pathinfo($eventImage, PATHINFO_EXTENSION)); // Rename image to EventID

        // Move uploaded file to the correct directory
        if (move_uploaded_file($_FILES['event_image']['tmp_name'], $targetFile)) {
            // Image uploaded and renamed successfully
        } else {
            echo "<script>alert('Error uploading image!');</script>";
        }
    } else {
        $eventImage = null; // No image selected
    }

    // Insert event into the database
    $insert_event = "INSERT INTO upcoming_events (ArtistID, EventTitle, EventDescription, EventDate, EventTime, EventLocation, EventImage)
                     VALUES ('$artistID', '$eventTitle', '$eventDescription', '$eventDate', '$eventTime', '$eventLocation', '$newEventID." . strtolower(pathinfo($eventImage, PATHINFO_EXTENSION)) . "')";

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
    <title>Add Event - MELODISE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        .form-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #1B8673;
        }
        .form-control, .form-select {
            border: none;
            border-bottom: 2px solid #1B8673;
            border-radius: 0;
            box-shadow: none;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: none;
            border-color: #1B8673;
        }
        .btn-custom {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
        }
        .btn-submit {
            background-color: #1B8673;
            color: white;
        }
        .btn-submit:hover {
            background-color: #145a50;
        }
    </style>
</head>
<body>
    <div class="form-card text-center">
        <div class="logo mb-3">MELODISE</div>
        <h2 class="mb-4">Add Event</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" class="form-control" id="event_title" name="event_title" placeholder="Enter event title" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" id="event_description" name="event_description" placeholder="Enter event description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" id="event_date" name="event_date" placeholder="Select event date" required>
            </div>
            <div class="mb-3">
                <input type="time" class="form-control" id="event_time" name="event_time" placeholder="Select event time" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="event_location" name="event_location" placeholder="Enter event location" required>
            </div>
            <div class="mb-3">
                <label for="event_image" class="form-label">Upload Event Image</label>
                <input type="file" class="form-control" id="event_image" name="event_image">
            </div>
            <button type="submit" class="btn btn-custom btn-submit w-100 mt-3">Submit</button>
        </form>
    </div>
</body>
</html>
