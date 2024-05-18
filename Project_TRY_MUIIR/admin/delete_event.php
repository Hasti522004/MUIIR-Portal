<?php
// Start output buffering
ob_start();

// Check if the id parameter is set in the URL
if(isset($_GET['id'])){
    // Connect to the database
    require_once "config.php";
    
    // Get the event record from the database
    $stmt = $conn->prepare("SELECT * FROM event_detail WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch();

    // Delete the event record from the database
    $stmt = $conn->prepare("DELETE FROM event_detail WHERE id = ?");
    $stmt->execute([$_GET['id']]);

    // Delete the image file from the folder
    if (file_exists($row['image_url'])) {
        if (unlink($row['image_url'])) {
            // Redirect to the dashboard page with a success message
            header("Location: dashboard.php?msg=Event deleted successfully");
            exit();
        } else {
            // Redirect to the dashboard page with an error message
            header("Location: dashboard.php?msg=Error deleting image file");
            exit();
        }
    } else {
        // Redirect to the dashboard page with an error message
        header("Location: dashboard.php?msg=Image file not found");
        exit();
    }
}

// Flush output buffer and display any messages
ob_end_flush();
?>
