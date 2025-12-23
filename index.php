<?php
session_start();
include "includes/config/dbconfig.php";

$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
if ($page < 1) $page = 1;
$limit = 16;
$offset = ($page - 1) * $limit;

$data = [];
$total_rows = 0;

if (isset($_GET["advancesearch"])) {
    $book = isset($_GET["book"]) ? $_GET["book"] : "";
    $author = isset($_GET["author"]) ? $_GET["author"] : "";
    $min = isset($_GET["min"]) ? (float)$_GET["min"] : 0;
    $max = isset($_GET["max"]) ? (float)$_GET["max"] : 999999;

    $query = "SELECT * FROM books WHERE status = 1 AND price BETWEEN ? AND ?";
    $params = [$min, $max];
    $types = "dd";

    if ($book != "") {
        $query .= " AND name LIKE ?";
        $params[] = "%$book%";
        $types .= "s";
    }
    if ($author != "") {
        $query .= " AND author LIKE ?";
        $params[] = "%$author%";
        $types .= "s";
    }

    $stmt = mysqli_prepare($link, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        $total_rows = count($data);
    }
} else {
    // Default fetch
    $stmt = mysqli_prepare($link, "SELECT * FROM books WHERE status = 1 LIMIT ?, ?");
    mysqli_stmt_bind_param($stmt, "ii", $offset, $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    $count_result = mysqli_query($link, "SELECT COUNT(*) as count FROM books WHERE status = 1");
    $total_rows = mysqli_fetch_assoc($count_result)['count'];
}

$total_pages = ceil($total_rows / $limit);
shuffle($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.ico">

    <!-- Primary Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
    <script src="carousel.js"></script>



    <!-- <a href="https://www.jqueryscript.net/tags.php?/Carousel/">Carousel</a> Extension -->

    <style>
    .center {
        text-align: center;
    }

    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        margin: 0 4px;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }

    /*----  Main Style  ----*/
    #cards_landscape_wrap-2 {
        text-align: center;
        background: #F7F7F7;
    }

    #cards_landscape_wrap-2 .container {
        padding-top: 80px;
        padding-bottom: 100px;
    }

    #cards_landscape_wrap-2 a {
        text-decoration: none;
        outline: none;
    }

    #cards_landscape_wrap-2 .card-flyer {
        border-radius: 5px;
    }

    #cards_landscape_wrap-2 .card-flyer .image-box {
        background: #ffffff;
        overflow: hidden;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.50);
        border-radius: 5px;
    }

    #cards_landscape_wrap-2 .card-flyer .image-box img {
        -webkit-transition: all .9s ease;
        -moz-transition: all .9s ease;
        -o-transition: all .9s ease;
        -ms-transition: all .9s ease;
        width: 100%;
        height: 200px;
    }

    #cards_landscape_wrap-2 .card-flyer:hover .image-box img {
        opacity: 0.7;
        -webkit-transform: scale(1.15);
        -moz-transform: scale(1.15);
        -ms-transform: scale(1.15);
        -o-transform: scale(1.15);
        transform: scale(1.15);
    }

    #cards_landscape_wrap-2 .card-flyer .text-box {
        text-align: center;
    }

    #cards_landscape_wrap-2 .card-flyer .text-box .text-container {
        padding: 30px 18px;
    }

    #cards_landscape_wrap-2 .card-flyer {
        background: #FFFFFF;
        margin-top: 50px;
        -webkit-transition: all 0.2s ease-in;
        -moz-transition: all 0.2s ease-in;
        -ms-transition: all 0.2s ease-in;
        -o-transition: all 0.2s ease-in;
        transition: all 0.2s ease-in;
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.40);
    }

    #cards_landscape_wrap-2 .card-flyer:hover {
        background: #fff;
        box-shadow: 0px 15px 26px rgba(0, 0, 0, 0.50);
        -webkit-transition: all 0.2s ease-in;
        -moz-transition: all 0.2s ease-in;
        -ms-transition: all 0.2s ease-in;
        -o-transition: all 0.2s ease-in;
        transition: all 0.2s ease-in;
        margin-top: 50px;
    }

    #cards_landscape_wrap-2 .card-flyer .text-box p {
        margin-top: 10px;
        margin-bottom: 0px;
        padding-bottom: 0px;
        font-size: 14px;
        letter-spacing: 1px;
        color: #000000;
    }

    #cards_landscape_wrap-2 .card-flyer .text-box h6 {
        margin-top: 0px;
        margin-bottom: 4px;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        font-family: 'Roboto Black', sans-serif;
        letter-spacing: 1px;
        color: #00acc1;
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
    </style>
    <script src="carousel.js"></script>
</head>


<body>
    <?php include "includes/components/nav.php"; ?>

    <style type="text/css">
    h2 {
        color: #ffff;
    }
    </style>
    <?php
    $stmt = mysqli_prepare($link, "SELECT * FROM category");
    mysqli_stmt_execute($stmt);
    $result1 = mysqli_stmt_get_result($stmt);
    $data1 = [];
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $data1[] = $row1;
    }
    shuffle($data1);
    ?>
    <section id="home-featured" class="py-4">
        <div class="container-fluid">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row w-100 mx-auto">
                            <?php
                            $r = 0;
                            foreach ($data1 as $row1):
                                if ($r > 0 && $r % 6 == 0): ?>
                                    </div></div><div class="carousel-item"><div class="row w-100 mx-auto">
                                <?php endif; ?>
                                <div class="col-lg-2 col-md-4 col-6 text-center">
                                    <div class="p-2">
                                        <img class="img-fluid rounded-circle mb-2" src="<?php echo htmlspecialchars($row1["image"]); ?>" 
                                             style='height: 60px; width: 60px; object-fit: cover; border: 2px solid #eee'>
                                        <div class="small fw-bold text-dark"><?php echo htmlspecialchars($row1["name"]); ?></div>
                                    </div>
                                </div>
                            <?php $r++; endforeach; ?>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="filter-sidebar shadow-sm p-4 bg-white rounded">
                    <h4 class="mb-4 text-center">Search Filter</h4>
                    <form action="home" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Book Name</label>
                            <input type="text" class="form-control" name="book" 
                                   value="<?php echo isset($_GET['book']) ? htmlspecialchars($_GET['book']) : ''; ?>" placeholder="Book Name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Author Name</label>
                            <input type="text" class="form-control" name="author" 
                                   value="<?php echo isset($_GET['author']) ? htmlspecialchars($_GET['author']) : ''; ?>" placeholder="Author Name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price Range</label>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="number" class="form-control" name="min" 
                                           value="<?php echo isset($_GET['min']) ? htmlspecialchars($_GET['min']) : ''; ?>" placeholder="Min">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="max" 
                                           value="<?php echo isset($_GET['max']) ? htmlspecialchars($_GET['max']) : ''; ?>" placeholder="Max">
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" name="advancesearch" value="1" class="btn btn-success">Apply Filters</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="container">
                    <div class="row">
                        <div class="center">
                            <div class="pagination" style="padding: 10px">
                                <?php if ($page > 1): ?>
                                    <a href="home?page=<?php echo $page - 1; ?>">&laquo;</a>
                                <?php endif; ?>
                                
                                <?php for ($b = 1; $b <= $total_pages; $b++): ?>
                                    <a class="<?php echo ($b == $page) ? 'active' : ''; ?>" 
                                       href="home?page=<?php echo $b; ?>" 
                                       style="text-decoration: none">
                                       <?php echo $b; ?>
                                    </a>
                                <?php endfor; ?>
                                
                                <?php if ($page < $total_pages): ?>
                                    <a href="home?page=<?php echo $page + 1; ?>">&raquo;</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container" style="padding:0 0 40px 0">
                    <div class="row">
                        <?php if (empty($data)): ?>
                            <div class="col-12 text-center py-5">
                                <h3>No books found matching your criteria.</h3>
                            </div>
                        <?php else: ?>
                            <?php foreach ($data as $row1): ?>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                    <div id="cards_landscape_wrap-2">
                                        <a href="book?book=<?php echo htmlspecialchars($row1["book_id"]); ?>">
                                            <div class="card-flyer">
                                                <div class="text-box">
                                                    <div class="image-box">
                                                        <img style="width: 100%;object-fit: cover;"
                                                            class="card-img card-img-bottom img-fluid" 
                                                            src="<?php echo htmlspecialchars($row1["image"]); ?>"
                                                            alt="<?php echo htmlspecialchars($row1["name"]); ?>">
                                                    </div>
                                                    <div class="text-container">
                                                        <h6 style="font-weight: bold;"><?php echo htmlspecialchars($row1["name"]); ?></h6>
                                                        <p><?php echo htmlspecialchars($row1["author"]); ?></p>
                                                        <p style="font-weight: bold;">TK. <?php echo htmlspecialchars($row1["price"]); ?></p>
                                                        <p><?php echo htmlspecialchars($row1["location"]); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center pb-4">
        <img src="https://hitwebcounter.com/counter/counter.php?page=7810260&style=0007&nbdigits=5&type=ip&initCount=0"
            title="Free Counter" Alt="web counter" border="0" />
    </div>
</body>


<div class="progress-container fixed-bottom">
    <div class="progress-bar" id="myBar">
    </div>
</div>
<?php include "includes/components/footer.php"; ?>
