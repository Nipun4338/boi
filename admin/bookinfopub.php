<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";

if (isset($_POST["delete"]) && isset($_POST["book_id"])) {
    $book_id = $_POST["book_id"];
    $stmt = mysqli_prepare($connection, "DELETE FROM books WHERE book_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $book_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["success"] = "Book has been deleted successfully.";
    } else {
        $_SESSION["status"] = "Error deleting book: " . mysqli_error($connection);
    }
}
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Published Books Management (Live Catalog)</h6>
        </div>

        <div class="card-body">
            <?php
            if (isset($_SESSION["success"]) && $_SESSION["success"] != "") {
                echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION["success"]) . "</div>";
                unset($_SESSION["success"]);
            }
            if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
                echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION["status"]) . "</div>";
                unset($_SESSION["status"]);
            }
            ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Book ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Seller ID</th>
                            <th>Location</th>
                            <th>Published On</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM books WHERE status = '1' ORDER BY updated_date DESC";
                        $query_run = mysqli_query($connection, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["book_id"]); ?></td>
                                    <td><strong class="text-dark"><?php echo htmlspecialchars($row["name"]); ?></strong></td>
                                    <td class="text-center">
                                        <img src="../<?php echo htmlspecialchars($row["image"]); ?>" class="rounded" height="50px" width="40px" style="object-fit: cover;">
                                    </td>
                                    <td><?php echo htmlspecialchars($row["author"]); ?></td>
                                    <td><span class="text-primary fw-bold">৳<?php echo htmlspecialchars($row["price"]); ?></span></td>
                                    <td><span class="badge badge-success"><?php echo htmlspecialchars($row["category"]); ?></span></td>
                                    <td><?php echo htmlspecialchars($row["owner_id"]); ?></td>
                                    <td><small><?php echo htmlspecialchars($row["location"]); ?></small></td>
                                    <td><small><?php echo date("M j, Y", strtotime($row["updated_date"])); ?></small></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <form action="book_edit.php" method="post" class="mr-1">
                                                <input type="hidden" name="edit_id_book" value="<?php echo $row["book_id"]; ?>">
                                                <button type="submit" name="edit_btn_book" class="btn btn-sm btn-info" title="Edit Book">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </form>
                                            <form action="bookinfopub.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                                <input type="hidden" name="book_id" value="<?php echo $row["book_id"]; ?>">
                                                <button type="submit" name="delete" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='10' class='text-center py-4'>No published books found.</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include "scripts.php";
include "includes/footer.php";
?>
