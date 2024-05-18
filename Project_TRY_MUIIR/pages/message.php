<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <?php include_once('../assets/include/head_link.php'); ?>
    <style>
        @import "compass/css3";
        /* 
html {
  background: #00A4BA;
} */

        h1 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 40px;
        }

        .testimonial-quote {
            font-size: 16px;
        }

        .testimonial-quote blockquote {
            /* Negate theme styles */
            border: 0;
            margin: 0;
            padding: 0;

            background: none;
            color: black;
            font-family: Georgia, serif;
            font-size: 1.5em;
            font-style: italic;
            line-height: 1.4 !important;
            margin: 0;
            position: relative;
            text-shadow: 0 1px white;
            z-index: 600;
        }

        .testimonial-quote blockquote * {
            box-sizing: border-box;
        }

        .testimonial-quote blockquote p {
            color: #000000;
            line-height: 1.4 !important;
        }

        .testimonial-quote blockquote p:first-child:before {
            content: '\201C';
            color: #81bedb;
            font-size: 7.5em;
            font-weight: 700;
            opacity: .3;
            position: absolute;
            top: -.4em;
            left: -.2em;
            text-shadow: none;
            z-index: -300;
        }

        .testimonial-quote img {
            border: 3px solid #9CC1D3;
            border-radius: 50%;
            display: block;
            width: 120px;
            height: 120px;
            position: absolute;
            top: -.2em;
            left: 0;
        }

        .testimonial-quote cite {
            color: gray;
            display: block;
            font-size: .8em;
        }

        .testimonial-quote cite span {
            color: #5e5e5e;
            font-size: 1em;
            font-style: normal;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 0 1px white;
        }

        .testimonial-quote {
            position: relative;
        }

        .testimonial-quote .quote-container {
            padding-left: 160px;
        }

        .testimonial-quote.right .quote-container {
            padding-left: 0;
            padding-right: 160px;
        }

        .testimonial-quote.right img {
            left: auto;
            right: 0;
        }

        .testimonial-quote.right cite {
            text-align: right;
        }
    </style>
</head>

<body>

        <?php include_once('../assets/include/header.php'); ?>
        <div class="section-title" style="margin-top: 40px;">
            <h2 style="color: red;">Messages</h2>
            <hr style="color: red; height:5px;">
        </div>  
    <section>
        <div style="width: 960px; margin: 0 auto; padding-top: 80px; padding-bottom: 80px;">

            <div class="testimonial-quote group">
                <img src="../assets/images/user.jpeg">
                <div class="quote-container">
                    <blockquote>
                        <p>Overall, fantastic! I'd recommend them to anyone looking for a creative, thoughtful, and
                            professional team.”</p>
                    </blockquote>
                    <cite><span>Kristi Bruno</span><br>
                        Social Media Specialist<br>
                        American College of Chest Physicians
                    </cite>
                </div>
            </div>

            <hr style="margin: 60px auto; opacity: .5;">

            <div class="testimonial-quote group right">
                <img src="../assets/images/user.jpeg">
                <div class="quote-container">
                    <div>
                        <blockquote>
                            <p>Overall, fantastic! I'd recommend them to anyone looking for a creative, thoughtful, and
                                professional team.”</p>
                        </blockquote>
                        <cite><span>Kristi Bruno</span><br>
                            Social Media Specialist<br>
                            American College of Chest Physicians
                        </cite>
                    </div>
                </div>
            </div>

            <hr style="margin: 60px auto; opacity: .5;">


            <div class="testimonial-quote group left" style=" margin-right: auto;">
                <img src="../assets/images/user.jpeg">
                <div class="quote-container">
                    <div>
                        <blockquote>
                            <p>Overall, fantastic! I'd recommend them to anyone looking for a creative, thoughtful, and
                                professional team.”</p>
                        </blockquote>
                        <cite><span>Kristi Bruno</span><br>
                            Social Media Specialist<br>
                            American College of Chest Physicians
                        </cite>
                    </div>
                </div>
            </div>

            <hr style="margin: 60px auto; opacity: .5;">

            <div class="testimonial-quote group right" style="margin-left: auto;">
                <img src="../assets/images/user.jpeg">
                <div class="quote-container">
                    <blockquote>
                        <p>Overall, fantastic! I'd recommend them to anyone looking for a creative,<br> thoughtful, and
                            professional team.”</p>
                    </blockquote>
                    <cite><span>Kristi Bruno</span><br>
                        Social Media Specialist<br>
                        American College of Chest Physicians
                    </cite>
                </div>
            </div>

        </div>
    </section>
    <section id="contact">
        <?php include_once('../assets/include/footer.php'); ?>
    </section>


</body>

</html>