<?php
// Start the session
session_start();
include('connect.php'); // Include database connection

// Ensure the artist is logged in
if (!isset($_SESSION['artistid'])) {
    header('Location: artistlogin.php'); // Redirect to login page if not logged in
    exit();
}

// Check if event_id is provided via GET
if (isset($_GET['event_id']) && !empty($_GET['event_id'])) {
    $eventID = $_GET['event_id']; // Retrieve the event ID
    $artistID = $_SESSION['artistid']; // Retrieve the logged-in artist's ID

    // Verify database connection
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Delete the event if it belongs to the logged-in artist
    $delete_event = "DELETE FROM `upcoming_events` WHERE `EventID` = ? AND `ArtistID` = ?";
    $stmt = mysqli_prepare($conn, $delete_event);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $eventID, $artistID);
        if (mysqli_stmt_execute($stmt)) {
            // Successful deletion
            echo "<script>alert('Event deleted successfully!'); window.location = 'viewEvents.php';</script>";
        } else {
            // Query execution failed
            echo "<script>alert('Failed to delete the event. Please try again.'); window.location = 'viewEvents.php';</script>";
        }
        mysqli_stmt_close($stmt); // Close statement
    } else {
        // Statement preparation failed
        echo "<script>alert('Error preparing the delete query. Please contact support.'); window.location = 'viewEvents.php';</script>";
    }
} else {
    // Event ID is missing
    echo "<script>alert('No event ID provided. Unable to delete.'); window.location = 'viewEvents.php';</script>";
}

// Close database connection
mysqli_close($conn);
?>
