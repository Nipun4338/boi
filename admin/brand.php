<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Brand Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="scripts.php" enctype="multipart/form-data" method="POST">

                <div class="modal-body">

                    <div class="form-group">
                        <label> Brand name </label>
                        <input type="text" name="brand_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <input type="number" name="status" class="form-control" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtnbrand" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Brand Details
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Add Brands
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
                $query = "SELECT * FROM brand";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Brand Name </th>
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
                            <td><?php echo $row["brand_id"]; ?></td>
                            <td><?php echo $row["brand_name"]; ?></td>
                            <td><?php echo $row["status"]; ?></td>
                            <td><?php echo $row["created_date"]; ?></td>
                            <td><?php echo $row["updated_date"]; ?></td>
                            <td>
                                <form action="brand_edit.php" method="post">
                                    <input type="hidden" name="edit_id_brand" value="<?php echo $row[
                                        "brand_id"
                                    ]; ?>">
                                    <button type="submit" name="edit_btn_brand" class="btn btn-success"> EDIT</button>
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
