<?php
include "security.php";
include "database/dbconfig.php";
if (isset($_POST["user_id"]) && isset($_POST["name"])) {
    $_SESSION["receive"] = $_POST["user_id"];
    $_SESSION["receive_name"] = $_POST["name"];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chat | বই</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="message.css">
    <link rel="icon" href="Iconsmind-Outline-Books-2.ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <style type="text/css">
    /*Setting Basic Dimensions to give
        gallary view */
    .container {
        margin: 0 auto;
        width: 90%;
    }

    .main_view {
        width: 80%;
        height: 25rem;
    }

    .main_view img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .side_view {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .side_view img {
        width: 9rem;
        height: 7rem;
        object-fit: cover;
        cursor: pointer;
        margin: 0.5rem;
    }

    ul.info {
        list-style: none;
        border-top: 1px dotted #AAA;
        margin: 60px 0 20px;
        font-size: 20px;
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

    .header1 {
        background-color: #666;
        padding: 30px;
        text-align: center;
        font-size: 35px;
        color: white;
    }


    .container1 {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
        float: left;
        clear: both;
        max-width: 70%;
        overflow-wrap: anywhere;
    }

    .container2 {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
        float: right;
        clear: both;
        max-width: 70%;
        overflow-wrap: anywhere;
    }

    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .container1::after {
        content: "";
        clear: both;
        display: table;
    }

    .container2::after {
        content: "";
        clear: both;
        display: table;
    }

    .container1 img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    .container1 img.right {
        float: right;
        margin-left: 20px;
        margin-right: 0;
    }

    .time-right {
        float: right;
        color: #aaa;
    }

    .time-left {
        float: left;
        color: #999;
    }

    .hello {
        margin: 0px 0 20px 0;
    }

    .sidenav {
        width: 130px;
        position: fixed;
        z-index: 1;
        overflow-x: hidden;

        padding: 8px 0;
    }

    .conversation {
        height: calc(100% - var(--number));
        position: relative;
    }

    .sidebar {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidebar a:hover {
        color: #f1f1f1;
    }

    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    .openbtn {
        font-size: 15px;
        cursor: pointer;
        background-color: #111;
        color: white;
        padding: 10px 10px;
        border: none;
    }

    .openbtn:hover {
        background-color: #444;
    }

    #main {
        transition: margin-left .5s;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
        .sidebar {
            padding-top: 15px;
        }

        .sidebar a {
            font-size: 18px;
        }
    }

    div.sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        background-color: yellow;
        padding: 50px;
        font-size: 20px;
    }
    </style>
</head>

<body id="main" style="background: whitesmoke;">

    <?php include "includes/nav.php"; ?>
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="#">Books by <?php echo $_SESSION["receive_name"]; ?></a>
        <a id="delete" href="#">Clear Messages</a>
        <a href="#">Repost User</a>
        <a href="#">Contact</a>
    </div>
    <article>
        <div class="hello">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-3" id="" style="border-right: 3px solid #cecece">
                        <div class="sidebar-item">
                            <div class="sidenav">
                                <button id="openclose" class="openbtn sticky d-block fa fa-envelope-open"> <?php echo $_SESSION[
                                    "receive_name"
                                ]; ?></button>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                    $("a").on("click", function(e) {

                        // Id of the element that was clicked
                        var elementId = $(this).attr("id");
                        if (elementId == "delete") {
                            var r = confirm("Confirm delete?");
                            if (r == true) {
                                event.preventDefault();
                                $.ajax({
                                    url: "delete_message.php",
                                    method: "POST",
                                    dataType: "json",
                                    success: function(data) {
                                        if (data.error != '') {
                                            $('input[type="submit"]').attr('disabled', true);
                                            window.scrollTo(0, document.body.scrollHeight);
                                        }
                                    }
                                })
                            } else {

                            }
                        }

                    });
                    </script>
                    <div class="col-md-9 col-sm-12">

                        <div class="content-section">
                            <div id="display_message"></div>
                        </div>
                        <form class="form-container" id="message_form" method="POST">
                            <div class="input-group">
                                <textarea class="form-control conversation" onclick="focusMethod()"
                                    style="--number: 12px" rows="1" name="commenton" id="commenton"
                                    placeholder="Enter text here..."></textarea>
                                <div class="input-group-append">
                                    <input type="submit" name="submit" id="submit" class="btn btn-primary btn-sm"
                                        value="send">
                                </div>
                            </div>
                        </form>

                        <script>
                        function openNav() {
                            document.getElementById("mySidebar").style.width = "250px";
                            document.getElementById("main").style.marginLeft = "250px";
                        }

                        function closeNav() {
                            document.getElementById("mySidebar").style.width = "0";
                            document.getElementById("main").style.marginLeft = "0";
                        }
                        </script>
                        <script>
                        $(document).ready(function() {

                            $('#message_form').on('submit', function(event) {
                                event.preventDefault();
                                var form_data = $(this).serialize();
                                $.ajax({
                                    url: "add_message.php",
                                    method: "POST",
                                    data: form_data,
                                    dataType: "json",
                                    success: function(data) {
                                        if (data.error != '') {
                                            $('#message_form')[0].reset();
                                            $('input[type="submit"]').attr('disabled',
                                            true);
                                            load_message();
                                            window.scrollTo(0, document.body.scrollHeight);
                                        }
                                    }
                                })

                            });
                            load_message();
                            setInterval(function() {
                                load_message1();
                            }, 1000);

                            function load_message() {
                                $.ajax({
                                    url: "fetch_message.php",
                                    method: "GET",
                                    dataType: 'json',
                                    success: function(data) {

                                        $('#display_message').html(data);
                                        window.scrollTo(0, document.body.scrollHeight);
                                    }
                                })
                            }

                            function load_message1() {
                                $.ajax({
                                    url: "fetch_message.php",
                                    method: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#display_message').html(data);
                                    }
                                })
                            }

                            $('#openclose').click(function() {
                                if ($('#openclose').hasClass('fa-envelope-open')) {
                                    openNav();
                                    $('#openclose').removeClass('fa-envelope-open');
                                    $('#openclose').addClass('fa-envelope');
                                } else if ($('#openclose').hasClass('fa-envelope')) {
                                    closeNav();
                                    $('#openclose').removeClass('fa-envelope');
                                    $('#openclose').addClass('fa-envelope-open');
                                }
                            });

                        });
                        </script>
                        <script type="text/javascript">
                        var input = document.getElementById("commenton");
                        input.addEventListener("keyup", function(event) {
                            if (event.keyCode === 13) {
                                event.preventDefault();
                                document.getElementById("submit").click();
                            }
                        });
                        $('textarea').on({
                            input: function() {
                                var totalHeight = $(this).prop('scrollHeight') - parseInt($(this).css(
                                    'padding-top')) - parseInt($(this).css('padding-bottom'));
                                $(this).css({
                                    'height': totalHeight
                                });
                                $('.conversation').get(0).style.setProperty("--number", totalHeight + 'px')
                            }
                        });
                        $(document).ready(function() {
                            $('input[type="submit"]').attr('disabled', true);

                            $('textarea').on('keyup', function() {
                                var textarea_value = $("#commenton").val();


                                if (textarea_value != '' && document.getElementById("commenton").value
                                    .trim().length > 0) {
                                    $('input[type="submit"]').attr('disabled', false);
                                } else {
                                    $('input[type="submit"]').attr('disabled', true);
                                }
                            });
                        });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>
<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<div class="progress-container fixed-bottom">
    <div class="progress-bar" id="myBar">
    </div>
</div>
<script>
// When the user scrolls the page, execute myFunction
window.onscroll = function() {
    myFunction()
};

function myFunction() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;
    document.getElementById("myBar").style.width = scrolled + "%";
}
</script>