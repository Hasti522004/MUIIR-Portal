<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <?php include_once('../assets/include/head_link.php'); ?>
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
                        <h2 style="color: red;">Copyright</h2>
                        <hr style="color: red; height:5px;">
                        <p>A copyright is the exclusive legal right over how original content or materials you’ve made get copied, shared, reproduced, printed, performed, or published by others.

                            In other words, copyright provides you with exclusive rights to:

                            Reproduce your work
                            Distribute or sell your work
                            Display or perform your work publicly
                            Create derivative works based on the original work
                            It also allows you to authorize or restrict others in exercising these rights, further protecting your original works if they’re ever stolen or plagiarized.
                            <br><br>
                            A copyright usually consists of the following four components, which we’ll discuss in more detail later in the article:
                            <br><br>
                            <b>Copyright symbol © or the word “copyright”</b><br><br>
                            Year the material was published
                            Name of the copyright owner
                            What rights are retained by the copyright
                            Some examples of copyrighted works include:

                            Art,
                            Literature,
                            Videos,
                            Images,
                            Photography,
                            Choreography,
                            Music,
                            Sound clips
                            <p>For Further Process <a href="../forms/copyright/copyright1.php">Click here</a></p>
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