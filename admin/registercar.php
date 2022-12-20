<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";

$host = "localhost";
$user = "root";
$password = "";
$db = "carhub";

$link = mysqli_connect($host, $user, $password, $db);
$sql = "SELECT * FROM brand";
($result = mysqli_query($link, $sql)) or die(mysqli_error($link));
$data = [];
$noOfRows = mysqli_num_rows($result);
if ($noOfRows) {
    while ($row = mysqli_fetch_assoc($result)) {
        /*echo "<pre>";
         print_r($row);*/
        array_push($data, $row);
        //echo "</pre>";
    }
}
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Car Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="scripts.php" enctype="multipart/form-data" method="POST">

                <div class="modal-body">

                    <div class="form-group">
                        <label> Car name </label>
                        <input type="text" name="car_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Brand</label>

                        <select name="brandselect" class="form-select" aria-label="Default select example">
                            <?php foreach ($data as $row) { ?>
                            <option value="<?php echo $row[
                                "brand_id"
                            ]; ?>"><?php echo $row["brand_name"]; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label>Model</label>
                        <input type="text" name="car_model" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Upload Car Picture</label>
                        <input type="file" name="file_upload" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Car Seats</label>
                        <input type="number" name="car_seats" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Car Build Date</label>
                        <input type="datetime" name="car_build" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Car Cost</label>
                        <input type="number" name="car_cost" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" name="car_color" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Details</label>
                        <input type="text" name="car_details" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="number" name="status" class="form-control" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtncar" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Car Details
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Add Cars
                </button>
            </h6>
        </div>

        <div class="card-body">
            <?php
            if (isset($_SESSION["success"]) && $_SESSION["success"] != "") {
                echo "<h2>" . $_SESSION["success"] . "</h2>";
                unset($_SESSION["success"]);
            }
            if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
                echo '<h2 class="bg-info">' . $_SESSION["status"] . "</h2>";
                unset($_SESSION["status"]);
            }
            ?>

            <div class="table-responsive">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "carhub");
                $query = "SELECT * FROM cars";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Car Name </th>
                            <th> Brand </th>
                            <th>Model</th>
                            <th>Image</th>
                            <th>Cost</th>
                            <th>Color</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th>EDIT </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { ?>
                        <tr>
                            <td><?php echo $row["car_id"]; ?></td>
                            <td><?php echo $row["car_name"]; ?></td>
                            <td><?php echo $row["car_brand_id"]; ?></td>
                            <td><?php echo $row["car_model"]; ?></td>
                            <td><img src="../<?php echo $row[
                                "car_image"
                            ]; ?>" height="50px" width="50px" /></td>
                            <td><?php echo $row["car_cost"]; ?></td>
                            <td><?php echo $row["car_color"]; ?></td>
                            <td><?php echo $row["status"]; ?></td>
                            <td><?php echo $row["created_date"]; ?></td>
                            <td><?php echo $row["update_date"]; ?></td>
                            <td>
                                <form action="car_edit.php" method="post">
                                    <input type="hidden" name="edit_id_car" value="<?php echo $row[
                                        "car_id"
                                    ]; ?>">
                                    <button type="submit" name="edit_btn_car" class="btn btn-success"> EDIT</button>
                                </form>
                            </td>
                        </tr>
                        <?php }
                        } else {
                            echo "No Record Found";
                        } ?>
                        <!--<tr>
            <td> 1 </td>
            <td> Funda of WEb IT</td>
            <td> funda@example.com</td>
            <td> *** </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="edit_id" value="">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>-->

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
include "scripts.php";
include "includes/footer.php";

?>
