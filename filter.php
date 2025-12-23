<?php
session_start();
include "includes/config/dbconfig.php";

$category = $_GET["category"] ?? "";
$author = $_GET["author"] ?? "";
$user_id = $_GET["user"] ?? "";
$sort_by = "name";
$direction = "ASC";

if (isset($_GET["booksort"])) {
    $sort_by = "name";
    $direction = ($_GET["booksort"] == "desc") ? "DESC" : "ASC";
} elseif (isset($_GET["authorsort"])) {
    $sort_by = "author";
    $direction = ($_GET["authorsort"] == "desc") ? "DESC" : "ASC";
} elseif (isset($_GET["pricesort"])) {
    $sort_by = "price";
    $direction = ($_GET["pricesort"] == "desc") ? "DESC" : "ASC";
}

$query_parts = [];
$params = [];
$types = "";

if (!empty($category)) {
    $query_parts[] = "category = ?";
    $params[] = $category;
    $types .= "s";
}
if (!empty($author)) {
    $query_parts[] = "author = ?";
    $params[] = $author;
    $types .= "s";
}
if (!empty($user_id)) {
    $query_parts[] = "owner_id = ?";
    $params[] = $user_id;
    $types .= "i";
}

$sql = "SELECT * FROM books";
if (!empty($query_parts)) {
    $sql .= " WHERE " . implode(" AND ", $query_parts);
}
$sql .= " ORDER BY $sort_by $direction";

$stmt = mysqli_prepare($connection, $sql);
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
$noOfRows = count($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Results | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #f8f9fa; }
        .filter-sidebar {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            position: sticky;
            top: 90px;
        }
        .filter-link {
            display: block;
            padding: 10px 15px;
            margin-bottom: 5px;
            border-radius: 8px;
            color: #495057;
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .filter-link:hover {
            background-color: #f1f3f5;
            color: #0d6efd;
            border-left-color: #0d6efd;
        }
        .filter-link.active {
            background-color: #e7f1ff;
            color: #0d6efd;
            border-left-color: #0d6efd;
            font-weight: bold;
        }
        .book-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            background: #fff;
            height: 100%;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .book-card img {
            height: 250px;
            object-fit: cover;
        }
        .price-tag {
            background: #0d6efd;
            color: #fff;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <?php include "includes/components/nav.php"; ?>

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active">Catalogue</li>
                    </ol>
                </nav>
                <h2 class="fw-bold">Found <span class="text-primary"><?php echo $noOfRows; ?></span> Results</h2>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar">
                    <h5 class="fw-bold mb-4 border-bottom pb-2">Sorting Options</h5>
                    <?php
                    $base_url = "filter?category=" . urlencode($category) . "&author=" . urlencode($author) . "&user=" . urlencode($user_id);
                    ?>
                    <a href="<?php echo $base_url; ?>&booksort=asc" class="filter-link">Book Name (A-Z)</a>
                    <a href="<?php echo $base_url; ?>&booksort=desc" class="filter-link">Book Name (Z-A)</a>
                    <a href="<?php echo $base_url; ?>&authorsort=asc" class="filter-link">Author Name (A-Z)</a>
                    <a href="<?php echo $base_url; ?>&authorsort=desc" class="filter-link">Author Name (Z-A)</a>
                    <a href="<?php echo $base_url; ?>&pricesort=asc" class="filter-link">Price: Low to High</a>
                    <a href="<?php echo $base_url; ?>&pricesort=desc" class="filter-link">Price: High to Low</a>
                </div>
            </div>

            <!-- Results -->
            <div class="col-lg-9">
                <div class="row g-4">
                    <?php if ($noOfRows > 0): ?>
                        <?php foreach ($data as $book): ?>
                            <div class="col-md-6 col-lg-4">
                                <a href="book?book=<?php echo $book['book_id']; ?>" class="text-decoration-none h-100 d-block">
                                    <div class="card book-card">
                                        <img src="<?php echo htmlspecialchars($book['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['name']); ?>">
                                        <div class="card-body">
                                            <h6 class="fw-bold text-dark mb-1 h-25 overflow-hidden"><?php echo htmlspecialchars($book['name']); ?></h6>
                                            <p class="text-muted small mb-3">by <?php echo htmlspecialchars($book['author']); ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="price-tag">৳<?php echo htmlspecialchars($book['price']); ?></span>
                                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i><?php echo htmlspecialchars($book['location']); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-search fa-4x text-light mb-4"></i>
                            <h4 class="text-muted">No books found matching your criteria.</h4>
                            <a href="home" class="btn btn-primary mt-3">Back to All Books</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="progress-bar fixed-bottom" id="myBar" style="height:4px; background: #0d6efd; width: 0%;"></div>
    <?php include "includes/components/footer.php"; ?>

    <script>
        window.onscroll = function() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
            document.getElementById("myBar").style.width = scrolled + "%";
        };
    </script>
</body>
</html>
