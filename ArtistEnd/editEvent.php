<?php
session_start(); // Ensure the session is started

// Include your database connection configuration
include "connect.php";

// Check if the artist is logged in
if (!isset($_SESSION['artistid'])) {
    header("Location: artistlogin.php"); // Redirect to login page if not logged in
    exit();
}

$artistId = $_SESSION['artistid']; // Get artist ID from session

// Check if the event ID is provided in the URL
if (isset($_GET['event_id'])) {
    $eventId = $_GET['event_id']; // Get the event ID from the URL

    // Fetch event details
    $query = "SELECT * FROM upcoming_events WHERE EventID = ? AND ArtistID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $eventId, $artistId); // Bind the event ID and artist ID to the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc(); // Fetch the event details
    } else {
        echo "Event not found or access denied.";
        exit();
    }
} else {
    header("Location: viewEvents.php"); // Redirect if no event ID is provided
    exit();
}

// Handle form submission for updating the event
if (isset($_POST['update-event'])) {
    $eventName = $_POST['event_name'];
    $eventDate = $_POST['event_date'];
    $eventLocation = $_POST['event_location'];
    $eventDescription = $_POST['event_description'];

    // Validate the inputs
    if (!empty($eventName) && !empty($eventDate) && !empty($eventLocation)) {
        $updateQuery = "UPDATE upcoming_events SET EventTitle = ?, EventDate = ?, EventLocation = ?, EventDescription = ? WHERE EventID = ? AND ArtistID = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssii", $eventName, $eventDate, $eventLocation, $eventDescription, $eventId, $artistId);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Event updated successfully!";
            header("Location: viewEvents.php"); 
            exit();
        } else {
            $error = "Failed to update event. Please try again.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary, .btn-secondary {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Edit Event</h2>

    <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form action="editEvent.php?event_id=<?php echo $eventId; ?>" method="POST">
        <div class="form-group">
            <label for="event_name">Event Name</label>
            <input type="text" name="event_name" id="event_name" class="form-control" 
                   value="<?php echo htmlspecialchars($event['EventTitle']); ?>" placeholder="Enter event name" required>
        </div>
        <div class="form-group">
            <label for="event_date">Event Date</label>
            <input type="date" name="event_date" id="event_date" class="form-control" 
                   value="<?php echo htmlspecialchars($event['EventDate']); ?>" required>
        </div>
        <div class="form-group">
            <label for="event_location">Event Location</label>
            <input type="text" name="event_location" id="event_location" class="form-control" 
                   value="<?php echo htmlspecialchars($event['EventLocation']); ?>" placeholder="Enter event location" required>
        </div>
        <div class="form-group">
            <label for="event_description">Event Description</label>
            <textarea name="event_description" id="event_description" class="form-control" rows="4" 
                      placeholder="Enter event description"><?php echo htmlspecialchars($event['EventDescription']); ?></textarea>
        </div>
        <button type="submit" name="update-event" class="btn btn-primary">Update Event</button>
        <a href="viewEvents.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
