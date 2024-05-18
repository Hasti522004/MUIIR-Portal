<?php
// Check if the form was submitted
if (isset($_POST['add'])) {
  // Connect to the database
  require_once "config.php";

  // Check if an image was uploaded
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Upload the image file to a folder on your server
    $target_dir = "upload_affiliation/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Get the URL of the uploaded image
    $image_url = "http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/" . $target_file;

    // Check if the caption field is not empty
    if (!empty($_POST['caption'])) {
      // Insert the image URL into the database
      $sql = 'INSERT INTO affiliation_detail (image_url, caption) VALUES (:image_url, :caption)';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':image_url', $image_url);
      $stmt->bindParam(':caption', $_POST['caption']);
      $stmt->execute();

      // Redirect to the dashboard page with a success message
      header("Location:dashboard.php?success=1");
      exit;
    } else {
      // Display an error message if caption field is empty
      $error = 'Please enter a caption for the image.';
    }
  } else {
    // Display an error message if no image was uploaded
    $error = 'Please select an image to upload.';
  }
}

// Display the form
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <section>
    <?php if (isset($error)): ?>
      <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="add_affiliation.php" enctype="multipart/form-data">
      <label for="image">Image:</label>
      <input type="file" name="image" id="image"><br><br>
      <label for="caption">Company Name:</label>
      <input type="text" name="caption" id="caption"><br><br>
      <input type="submit" name="add" value="Add to database">
    </form>
  </section>
</body>
</html>
