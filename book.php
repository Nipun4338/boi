<?php
session_start();
ob_start();
include "includes/config/dbconfig.php";

$book_id = isset($_GET["book"]) ? $_GET["book"] : "";

if ($book_id == "") {
    header("Location: home");
    exit();
}

// Fetch book details
$stmt = mysqli_prepare($link, "SELECT * FROM books WHERE book_id = ?");
mysqli_stmt_bind_param($stmt, "s", $book_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$book_data = mysqli_fetch_assoc($result);

// Check if book exists and is either active OR belongs to the current user
$is_owner = (isset($_SESSION["user_id"]) && $book_data && $_SESSION["user_id"] == $book_data["owner_id"]);

if (!$book_data || ($book_data["status"] != 1 && !$is_owner)) {
    header("Location: 404.php");
    exit();
}

// Fetch book images
$stmt_img = mysqli_prepare($link, "SELECT * FROM images WHERE book_id = ?");
mysqli_stmt_bind_param($stmt_img, "s", $book_id);
mysqli_stmt_execute($stmt_img);
$result_img = mysqli_stmt_get_result($stmt_img);
$images = [];
while ($row_img = mysqli_fetch_assoc($result_img)) {
    $images[] = $row_img;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book_data['name']); ?> | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.svg">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/carousel.js"></script>



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
        margin: 20px 0 20px;
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


    * {
        box-sizing: border-box;
    }

    .row>.column {
        padding: 0 8px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .column {
        float: left;
        width: 25%;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: black;
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 1200px;
    }

    /* The Close Button */
    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    .mySlides {
        display: none;
    }

    .cursor {
        cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    img {
        margin-bottom: -4px;
    }

    .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
    }

    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    img.hover-shadow {
        transition: 0.3s;
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    </style>
</head>


<body style="background:#EEEEEE">
    <?php include "includes/components/nav.php"; ?>
    <?php if (isset($is_owner) && $is_owner && $book_data["status"] != 1): ?>
        <div class="alert alert-warning border-0 rounded-0 text-center mb-0">
            <i class="fas fa-clock me-2"></i> 
            <strong>This book is currently under review.</strong> It will be visible to other users once approved by the admin.
        </div>
    <?php endif; ?>

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Image Gallery -->
                <div class="row g-2 mb-4">
                    <?php 
                    $i = 0;
                    foreach ($images as $img): $i++; ?>
                        <div class="col-3">
                            <img src="<?php echo htmlspecialchars($img["image"]); ?>" 
                                 class="img-fluid rounded shadow-sm hover-shadow cursor" 
                                 onclick="openModal();currentSlide(<?php echo $i; ?>)"
                                 alt="Book Image">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Modal Lightbox -->
                <div id="myModal" class="modal">
                    <span class="close cursor" onclick="closeModal()">&times;</span>
                    <div class="modal-content border-0 bg-transparent">
                        <?php 
                        $j = 0;
                        foreach ($images as $img): $j++; ?>
                            <div class="mySlides text-center">
                                <img src="<?php echo htmlspecialchars($img["image"]); ?>" class="img-fluid rounded mx-auto d-block" style="max-height: 80vh">
                                <div class="text-white mt-3 fw-bold"><?php echo $j; ?> / <?php echo count($images); ?></div>
                            </div>
                        <?php endforeach; ?>
                        
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>
                </div>

                <script>
                function openModal() { document.getElementById("myModal").style.display = "block"; }
                function closeModal() { document.getElementById("myModal").style.display = "none"; }
                var slideIndex = 1;
                showSlides(slideIndex);
                function plusSlides(n) { showSlides(slideIndex += n); }
                function currentSlide(n) { showSlides(slideIndex = n); }
                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    if (n > slides.length) { slideIndex = 1 }
                    if (n < 1) { slideIndex = slides.length }
                    for (i = 0; i < slides.length; i++) { slides[i].style.display = "none"; }
                    if (slides.length > 0) slides[slideIndex - 1].style.display = "block";
                }
                </script>
            </div>

            <div class="col-md-6">
                <div class="bg-white p-5 rounded shadow-sm">
                    <h2 class="fw-bold mb-2"><?php echo htmlspecialchars($book_data["name"]); ?></h2>
                    <p class="text-muted h5 mb-4">by 
                        <a href="filter?author=<?php echo urlencode($book_data["author"]); ?>" class="text-primary text-decoration-none">
                            <?php echo htmlspecialchars($book_data["author"]); ?>
                        </a>
                    </p>
                    <span class="badge bg-secondary mb-4 p-2 px-3"><?php echo htmlspecialchars($book_data["category"]); ?></span>

                    <div class="border-top pt-4">
                        <ul class="list-unstyled">
                            <li class="mb-3 h5">
                                <strong class="text-dark">Location:</strong> 
                                <span class="text-secondary"><?php echo htmlspecialchars($book_data["location"]); ?></span>
                            </li>
                            <li class="mb-3 h5">
                                <strong class="text-dark">Condition:</strong> 
                                <span class="text-secondary"><?php echo htmlspecialchars($book_data["present_condition"]); ?></span>
                            </li>
                            <li class="mb-3 h5 text-success">
                                <strong class="text-dark">Price:</strong> 
                                <span>TK. <?php echo htmlspecialchars($book_data["price"]); ?></span>
                            </li>
                        </ul>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <form action="chat" method="POST">
                            <input type="hidden" name="user_id1" value="<?php echo htmlspecialchars($book_data["owner_id"]); ?>">
                            <?php
                            $_SESSION["receive"] = $book_data["owner_id"];
                            $stmt_owner = mysqli_prepare($link, "SELECT name FROM user WHERE user_id = ?");
                            mysqli_stmt_bind_param($stmt_owner, "s", $book_data["owner_id"]);
                            mysqli_stmt_execute($stmt_owner);
                            $res_owner = mysqli_stmt_get_result($stmt_owner);
                            if ($owner = mysqli_fetch_assoc($res_owner)) {
                                $_SESSION["receive_name"] = $owner["name"];
                                echo '<input type="hidden" name="user_name" value="' . htmlspecialchars($owner["name"]) . '">';
                            }
                            ?>
                            <button type="submit" class="btn btn-danger btn-lg w-100 mb-2">Message to Owner</button>
                        </form>
                        <a href="wishlist?book=<?php echo urlencode($book_id); ?>" class="btn btn-outline-primary btn-lg">Add to Wishlist</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="bg-white p-4 rounded shadow-sm">
                    <h3 class="border-bottom pb-3 mb-4">Comments</h3>
                    <form id="comment_form" class="mb-4">
                        <div class="mb-3">
                            <textarea class="form-control" name="comment" id="comment" placeholder="Leave a comment..." rows="3" required></textarea>
                        </div>
                        <div class="text-end">
                            <input type="hidden" name="comment_id" id="comment_id" value="0" />
                            <input type="hidden" name="book_id" id="book_id" value="<?php echo htmlspecialchars($book_id); ?>">
                            <button type="submit" name="submit" id="submit" class="btn btn-info px-4">Post Comment</button>
                        </div>
                    </form>
                    <div id="comment_message"></div>
                    <div id="display_comment" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#comment_form').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "actions/comments/add_comment.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                success: function(data) {
                    if (data.error != '') {
                        $('#comment_form')[0].reset();
                        $('#comment_message').html(data.error);
                        $('#comment_id').val('0');
                        load_comment();
                    }
                }
            })
        });

        load_comment();

        function load_comment() {
            $.ajax({
                url: "actions/comments/fetch_comment.php",
                method: "POST",
                data: { book_id: "<?php echo $book_id; ?>" },
                dataType: 'json',
                success: function(data) {
                    $('#display_comment').html(data);
                }
            })
        }

        $(document).on('click', '.reply', function() {
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment').focus();
        });
    });
    </script>
</body>

<div class="progress-container fixed-bottom">
    <div class="progress-bar" id="myBar"></div>
</div>
<?php include "includes/components/footer.php"; ?>
