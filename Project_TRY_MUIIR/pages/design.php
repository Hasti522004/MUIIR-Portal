<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <?php include_once('../assets/include/head_link.php'); ?>
</head>
</head>

<body>
    <?php
        if(isset($_REQUEST['msg'])){
            ?>
    <script>
    alert("<?php echo $_REQUEST['msg']; ?>");
    </script>
    <?php
        }
        ?>
    <section>
        <?php include_once('../assets/include/header.php'); ?>
    </section>

    <section class="team section" id="team">
        <div class="container">
            <div class="row">
                <div class="col-12 wow zoomIn">
                    <div class="section-title">
                        <h2 style="color: red;">Design</h2>
                        <hr style="color: red; height:5px;">
                        <p>‘Design’ means only the features of shape, configuration,
                            pattern or ornament or composition of lines or colour or
                            combination thereof applied to any article whether two
                            dimensional or three dimensional or in both forms, by any
                            industrial process or means, whether manual, mechanical or
                            chemical, separate or combined, which in the finished article
                            appeal to and are judged solely by the eye, but does not include
                            any mode or principle or construction or anything which is in
                            substance a mere mechanical device, and does not include any trade
                            mark, as define in clause (v) of sub-section of Section 2 of the
                            Trade and Merchandise Marks Act, 1958, property mark or artistic
                            works as defined under Section 2(c) of the Copyright Act, 1957.</p>
                        <br>
                        <p>Object of the Designs Act is to protect new or original designs so created to be applied or
                            applicable to particular article to be manufactured by Industrial Process or means.
                            Sometimes purchase of articles for use is influenced not only by their practical efficiency
                            but also by their appearance. The important purpose of design Registration is to see that
                            the artisan, creator, originator of a design having aesthetic look is not deprived of his
                            bonafide reward by others applying it to their goods.</p>
                        <p>For Further Process <a href="../forms/design/design_form.php">Click here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="contact">
        <?php include_once('../assets/include/footer.php'); ?>
    </section>


</body>

</html>