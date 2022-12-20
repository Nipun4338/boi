<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">EDIT Car Data
            </h6>
        </div>

        <div class="card-body">
            <?php
            $connection = mysqli_connect("localhost", "root", "", "carhub");
            if (isset($_POST["edit_btn_car"])) {
                $id = $_POST["edit_id_car"];
                $query = "SELECT * FROM cars WHERE car_id='$id' ";
                $query_run = mysqli_query($connection, $query);
                foreach ($query_run as $row) { ?>
            <form action="scripts.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="edit_id_car" value="<?php echo $row[
                    "car_id"
                ]; ?>">
                <input type="hidden" name="edit_image" value="<?php echo $row[
                    "car_image"
                ]; ?>">
                <div class="form-group">
                    <label> Car name </label>
                    <input type="text" name="edit_car_name" value="<?php echo $row[
                        "car_name"
                    ]; ?>"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <input type="text" name="edit_brand" value="<?php echo $row[
                        "car_brand_id"
                    ]; ?>"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Model</label>
                    <input type="text" name="edit_car_model" value="<?php echo $row[
                        "car_model"
                    ]; ?>"
                        class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Upload Car Picture</label>
                    <input type="file" name="file_upload" value="<?php echo $row[
                        "car_image"
                    ]; ?>"
                        class="form-control" />
                </div>
                <div class="form-group">
                    <label>Car Seats</label>
                    <input type="number" name="edit_car_seats" value="<?php echo $row[
                        "car_seats"
                    ]; ?>"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Car Build Date</label>
                    <input type="datetime" name="edit_car_build" value="<?php echo $row[
                        "car_build"
                    ]; ?>"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Car Cost</label>
                    <input type="number" name="edit_car_cost" value="<?php echo $row[
                        "car_cost"
                    ]; ?>"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="edit_car_color" value="<?php echo $row[
                        "car_color"
                    ]; ?>"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Details</label>
                    <input type="text" name="edit_car_details" cols="100" value="<?php echo $row[
                        "car_details"
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

                <a href="registercar.php" class="btn btn-danger"> CANCEL </a>
                <button type="submit" name="updatebtncar" class="btn btn-primary">UPDATE</button>
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
