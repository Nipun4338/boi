<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">EDIT Brand Details
            </h6>
        </div>

        <div class="card-body">
            <?php
            $connection = mysqli_connect("localhost", "root", "", "carhub");
            if (isset($_POST["edit_btn_brand"])) {
                $id = $_POST["edit_id_brand"];
                $query = "SELECT * FROM brand WHERE brand_id='$id' ";
                $query_run = mysqli_query($connection, $query);
                foreach ($query_run as $row) { ?>
            <form action="scripts.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="edit_id_brand" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label> Brand name </label>
                    <input type="text" name="edit_brand_name" value="<?php echo $row[
                        "brand_name"
                    ]; ?>"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="number" name="edit_status" value=<?php echo $row[
                        "status"
                    ]; ?> class="form-control"
                        required>
                </div>

                <a href="brand.php" class="btn btn-danger"> CANCEL </a>
                <button type="submit" name="updatebtnbrand" class="btn btn-primary">UPDATE</button>
            </form>
            <?php }
            }
            ?>
        </div>
    </div>

</div>

<?php
include "scripts.php";
include "includes/footer.php";

?>
