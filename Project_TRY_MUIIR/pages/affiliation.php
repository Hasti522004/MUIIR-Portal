<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider</title>
    <?php include_once("../assets/include/head_link.php");?>
    <style>
    .card {
        display: inline-block;
        margin: 20px;
        position: relative;
        border-radius: 50%;
        overflow: hidden;
        width: 200px;
        height: 200px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .card img {
        display: block;
        width: 50%;
        height: 50%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover img {
        transform: scale(1.5);
    }
    </style>
</head>

<body>
    <section>
        <?php include_once('../assets/include/header.php'); ?>
    </section>


    <section style="margin-top:30px;">
        <div class="col-12 wow zoomIn">
            <div class="section-title">
                <h2 style="color: red;">Affiliation</h2>
                <hr style="color: red; height:5px;">
            </div>
        </div>
        <?php
    // Connect to the database
    require_once "../assets/include/config.php";

    // Fetch image URLs from the database
    $sql = "SELECT image_url, caption FROM affiliation_detail";
    $res = $conn->query($sql);
    if ($res->rowCount() > 0) {
      while ($row = $res->fetch()) {
        $image_url = $row['image_url'];
        $caption = $row['caption'];
        $img_size = getimagesize($image_url);
        $img_width = $img_size[0];
        $img_height = $img_size[1];
        $img_aspect_ratio = $img_width / $img_height;

        // Create HTML card
        echo '<div class="card">';
        echo '<a href="' . $image_url . '" target="_self">';
        echo '<img src="' . $image_url . '" alt="' . $caption . '" style="height: 150px; width: ' . (200 * $img_aspect_ratio) . 'px;">';
        echo '</a>';
        echo '</div>';
      }
    }
  ?>
    </section>
    <section id="contact">
        <?php include_once('../assets/include/footer.php'); ?>
    </section>
</body>

</html>