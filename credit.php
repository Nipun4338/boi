<!DOCTYPE html>
<html>

<head>
    <title>Credit | বই</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet"
        href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a265bf9905.js" crossorigin="anonymous"></script>
    <link rel="icon" href="Iconsmind-Outline-Books-2.ico">

    <style>
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
        margin: 120px 0 120px 0;
    }

    .web {
        color: black;
    }

    .web:hover {
        color: blue;
    }
    </style>
    <script src="carousel.js"></script>
</head>

<body style="background:#fff">
    <?php include "includes/nav.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <img style="width: 100%;object-fit: cover;margin-bottom: 30px"
                    class="card-img card-img-bottom img-fluid" src="images/Nipun_Paul.jpg" alt="Nipun Paul">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                <h4 style="text-align:center;font-weight:bold; margin-bottom:15px">Nipun Paul</h4>
                <div class="container">
                    <h6 style="">I am fond of reading books, that's why tried to create a project like this. Doing
                        something big without enough backend is tough. So I couldn't manage
                        enough database space. Even the chating system would be great without the database query limit.
                        But that's why anything free has it's own limit, isn't it?</h6>
                    <br>
                    <div class="container">
                        <h5 style="font-weight:bold;color:#df4759">Who I am?</h5>
                        <a href="https://github.com/Nipun4338"><span><i class="web fab fa-github fa-3x"></i></span></a>
                        <a href="https://www.linkedin.com/in/nipunpaul4338/"><span><i
                                    class="web fab fa-linkedin-in fa-3x"></i></span></a>
                        <a href="https://www.facebook.com/nipun.paul.33/"><span><i
                                    class="web fab fa-facebook fa-3x"></i></span></a>
                        <a href="https://nipun4338.github.io/"><span><i
                                    class="web fab fa-edge-legacy fa-3x"></i></span></a>
                        <a href="mailto:nipun4338@gmail.com"><span><i class="web far fa-envelope fa-3x"></i></span></a>


                        <p></p><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>


<div class="progress-container fixed-bottom">
    <div class="progress-bar" id="myBar">
    </div>
</div>
<?php include "includes/footer.php";
?>
