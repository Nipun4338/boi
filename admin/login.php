<?php
if (!isset($_SESSION)) {
    session_start();
}
// Clear existing session for fresh login if redirection from logout happened
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['success'] = "You have been logged out successfully.";
}

include "../includes/config/dbconfig.php";
include "includes/header.php";
?>

<div class="container py-5">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card o-hidden border-0 shadow-lg my-5 rounded-lg overflow-hidden">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <div class="mb-3">
                                        <i class="fas fa-book-reader fa-3x text-primary border p-3 rounded-circle bg-light"></i>
                                    </div>
                                    <h1 class="h4 text-gray-900 font-weight-bold">Boi Admin Portal</h1>
                                    <p class="text-muted small">Please sign in to access your dashboard</p>
                                </div>

                                <?php 
                                if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
                                    echo '<div class="alert alert-danger shadow-sm border-left-danger animated shake">' . htmlspecialchars($_SESSION["status"]) . "</div>";
                                    unset($_SESSION["status"]);
                                }
                                if (isset($_SESSION["success"]) && $_SESSION["success"] != "") {
                                    echo '<div class="alert alert-success shadow-sm border-left-success">' . htmlspecialchars($_SESSION["success"]) . "</div>";
                                    unset($_SESSION["success"]);
                                } 
                                ?>

                                <form class="user" action="code.php" method="POST">
                                    <div class="form-group mb-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-white border-right-0 rounded-left-pill px-3">
                                                    <i class="fas fa-envelope text-gray-400"></i>
                                                </span>
                                            </div>
                                            <input type="email" name="email" class="form-control form-control-user border-left-0 rounded-right-pill bg-light" placeholder="Admin Email Address" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-white border-right-0 rounded-left-pill px-3">
                                                    <i class="fas fa-lock text-gray-400"></i>
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control form-control-user border-left-0 rounded-right-pill bg-light" placeholder="Account Password" required>
                                        </div>
                                    </div>

                                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block shadow-sm py-2 font-weight-bold mt-4">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Authorized Login
                                    </button>
                                </form>
                                <hr class="my-4">
                                <div class="text-center small">
                                    <a class="text-secondary" href="../index.php"><i class="fas fa-home mr-1"></i> Back to Main Site</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center text-muted small">&copy; <?php echo date("Y"); ?> Boi - Your Book Companion</p>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
include "scripts.php";
?>
