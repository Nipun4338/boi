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
                <h5 class="modal-title" id="exampleModalLabel">Member Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="scripts.php" enctype="multipart/form-data" method="POST">

                <div class="modal-body">

                    <div class="form-group">
                        <label> Name </label>
                        <input type="text" name="team_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Aust Id</label>
                        <input type="text" name="aust_id" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Upload Profile Picture</label>
                        <input type="file" name="file_upload" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <input type="number" name="status" class="form-control" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtnteam" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Team Details
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Add Team Member
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
                $query = "SELECT * FROM team";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Name </th>
                            <th> AUST ID </th>
                            <th>Image</th>
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
                            <td><?php echo $row["team_id"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["aust_id"]; ?></td>
                            <td><img src="../<?php echo $row[
                                "image_path"
                            ]; ?>" height="50px" width="50px" /></td>
                            <td><?php echo $row["status"]; ?></td>
                            <td><?php echo $row["created_date"]; ?></td>
                            <td><?php echo $row["updated_date"]; ?></td>
                            <td>
                                <form action="team_edit.php" method="post">
                                    <input type="hidden" name="edit_id_team" value="<?php echo $row[
                                        "team_id"
                                    ]; ?>">
                                    <button type="submit" name="edit_btn_team" class="btn btn-success"> EDIT</button>
                                </form>
                            </td>
                        </tr>
                        <?php }
                        } else {
                            echo "No Record Found";
                        } ?>

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
