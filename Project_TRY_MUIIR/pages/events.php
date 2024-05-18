<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slider</title>
  <!-- <link rel="stylesheet" href="./style.css"> -->
  <?php include_once('../assets/include/head_link.php'); ?>
  <style>
  .slider {
  position: relative;
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
}

.slider-images {
  display: flex;
  overflow-x: scroll;
  scroll-snap-type: inline mandatory; /* change to inline mandatory */
  -webkit-overflow-scrolling: touch;
  -ms-overflow-style: none;
  scrollbar-width: none;
  flex-wrap: nowrap;
}

.slider-images img {
  scroll-snap-align: start;
  width: 100%;
  height: auto;
}

.slider-images::-webkit-scrollbar {
  display: block;
}

.slider-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 10px;
}

.slider-prev, .slider-next {
  background: none;
  border: none;
  font-size: 2rem;
  color: #fff;
  cursor: pointer;
  outline: none;
}

.slider-dots {
  position: absolute;
  bottom: 10px;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.slider-dot {
  width: 10px;
  height: 10px;
  padding-bottom: 5px;
  margin: 0 5px;
  border-radius: 50%;
  background: #fff;
  cursor: pointer;
  transition: all 0.3s ease;
}

.slider-dot.active {
  background: #f00;
}

  </style>
</head>

<body>
<section>
        <?php include_once('../assets/include/header.php'); ?>
    </section>
    
    <section style="margin-top: 50px;margin-bottom:50px;">
    <div class="col-12 wow zoomIn" >
        <div class="section-title">
            <h2 style="color: red;">Events</h2>
            <hr style="color: red; height:5px;">
        </div>  
    </div>
    <div class="slider">
        <div class="slider-images">
            <?php
                // Include config.php file for database connection
                require_once "../assets/include/config.php";

                // Query to get latest three images from event_detail table
                $sql = "SELECT image_url FROM event_detail ORDER BY event_date_time DESC LIMIT 3";
                $stmt = $conn->query($sql);

                // Loop through the query result and display images
                if ($stmt->rowCount() > 0) {
                    while($row = $stmt->fetch()) {
                        echo "<img src='".$row["image_url"]."' alt='event image'>";
                    }
                } else {
                    echo "No images found.";
                }
            ?>
        </div>
        <div class="slider-nav">
            <button class="slider-prev">&#8249;</button>
            <button class="slider-next">&#8250;</button>
        </div>
        <div class="slider-dots">
            <span class="slider-dot"></span>
            <span class="slider-dot"></span>
            <span class="slider-dot"></span>
        </div>
    </div>
</section>


    <section class="event">
    <?php
  // Connect to the database
  require_once "../assets/include/config.php";

  // Fetch image URLs from the database
  $sql = "SELECT image_url, caption FROM event_detail";
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
      echo '<img src="' . $image_url . '" alt="' . $caption . '" style="height: 300px; width: ' . (300 * $img_aspect_ratio) . 'px;">';
      echo '</a>';
      echo '<p> <b>Details: </b>' . (strlen($caption) > 50 ? substr($caption, 0, 50) . '...' : $caption) . '</p>';
      if (strlen($caption) > 50) {
        echo '<a href="#" class="read-more">Read More</a>';
        echo '<p class="full-caption">' . $caption . '</p>';
      }
      echo '</div>';
      echo '</div>';
    }
  }
?>

</section>

<style>
  .event {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  .card {
    display: flex;
    flex-direction: column;
    width: 300px;
    margin: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    box-shadow: 2px 2px 4px #ccc;
  }

  .card a {
    display: flex;
    justify-content: center;
  }

  .card-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center;
  }

  .card-content h2 {
    font-size: 1.5em;
    margin: 10px 0;
  }

  .card-content p {
    margin: 10px 0;
  }
</style>
<script>
  // Add click event listener to Read More links
  var readMoreLinks = document.getElementsByClassName('read-more');
  for (var i = 0; i < readMoreLinks.length; i++) {
    readMoreLinks[i].addEventListener('click', function(event) {
      event.preventDefault();
      this.style.display = 'none';
      this.nextElementSibling.style.display = 'block';
    });
  }
</script>

  <section id="contact">
        <?php include_once('../assets/include/footer.php'); ?>
    </section>
  <script>
    const sliderImages = document.querySelector('.slider-images');
const prevBtn = document.querySelector('.slider-prev');
const nextBtn = document.querySelector('.slider-next');
const dots = document.querySelectorAll('.slider-dot');
let slideIndex = 0;
let autoPlay;

// Start auto-play
function startAutoPlay() {
  autoPlay = setInterval(() => {
    slideIndex++;
    showSlide();
  }, 3000);
}

// Stop auto-play
function stopAutoPlay() {
  clearInterval(autoPlay);
}

// Show the current slide
function showSlide() {
  // Loop back to first slide
  if (slideIndex >= sliderImages.children.length) {
    slideIndex = 0;
  }
  // Loop to last slide
  if (slideIndex < 0) {
    slideIndex = sliderImages.children.length - 1;
  }
  // Set scroll position to show the current slide
  sliderImages.scrollLeft = slideIndex * sliderImages.children[0].offsetWidth;
  // Set active class on current dot
  dots.forEach((dot) => dot.classList.remove('active'));
  dots[slideIndex].classList.add('active');
}

// Handle manual navigation
prevBtn.addEventListener('click', () => {
  stopAutoPlay();
  slideIndex--;
  showSlide();
});

nextBtn.addEventListener('click', () => {
  stopAutoPlay();
  slideIndex++;
  showSlide();
});

dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    stopAutoPlay();
    slideIndex = index;
    showSlide();
  });
});

// Define the interval time (in milliseconds)
const intervalTime = 3000;

// Start auto-play
function startAutoPlay() {
  autoPlay = setInterval(() => {
    slideIndex++;
    showSlide();
  }, intervalTime);
}

// Stop auto-play
function stopAutoPlay() {
  clearInterval(autoPlay);
}

// Start auto-play on page load
startAutoPlay();

  </script>
</body>

</html>