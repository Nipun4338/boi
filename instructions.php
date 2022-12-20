<?php
session_start();
include "database/dbconfig.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Instructions | বই</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale = 1.0">

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <link rel="stylesheet"
        href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Iconsmind-Outline-Books-2.ico">


    <style media="screen">
    .mySlides {
        display: none;
    }

    .header {
        position: fixed;
        top: 0;
        z-index: 1;
        width: 100%;
        background-color: #f1f1f1;
    }

    .header h2 {
        text-align: center;
    }

    .progress-container {
        width: 100%;
        height: 4px;
        background: #ccc;
    }

    .progress-bar {
        height: 4px;
        background: #4caf50;
        width: 0%;
    }

    .content {
        padding: 100px 0;
        margin: 50px auto 0 auto;
        width: 80%;
    }

    .hello {
        height: 70vh;
        font-family: 'Roboto', sans-serif;
    }
    </style>

</head>

<body>
    <?php include "includes/nav.php"; ?>
    <div class="hello">
        <h4 style="text-align:center;font-weight:bold">How To Upload Your Book Details</h4>
        <div class="container">
            <h6 style="font-weight:bold">1. Open an account on <a href="subscribe"> Boi</a> .</h6>
            <h6 style="font-weight:bold">2. Go to <a href="sell"> SELL</a> .</h6>
            <h6 style="font-weight:bold">3. Fillup all other options correctly.</h6>
            <h6 style="font-weight:bold">4. Choose image for your book. You can add multiple images, but your first
                image will be used as a cover image.</h6>
            <h6 style="font-weight:bold">5. Submit!</h6><br>
            <h6 style="font-weight:bold">We will review your ad before make it publish. After published or any kind of
                change, you will get an email.</h6><br>
            <h5 style="font-weight:bold;color:#df4759">**Incorrect or inappropriate ad will not be published and the
                user will be banned or get penalty.</h5>
            <p></p><br>


        </div>
    </div>
</body>
<div class="progress-container fixed-bottom">
    <div class="progress-bar" id="myBar">
    </div>
</div>
<?php include "includes/footer.php";
?>
