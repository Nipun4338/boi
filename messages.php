<?php
include "includes/auth/security.php";
include "includes/config/dbconfig.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Chats | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #f8f9fa; }
        .chat-list-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .contact-item {
            transition: background 0.2s;
            border-left: 4px solid transparent;
            cursor: pointer;
        }
        .contact-item:hover {
            background-color: #f1f4f9;
        }
        .contact-item.online {
            border-left-color: #198754;
        }
        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        .status-online { background-color: #198754; }
        .status-offline { background-color: #dc3545; }
        .avatar-circle {
            width: 50px;
            height: 50px;
            background-color: #e9ecef;
            color: #495057;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border-radius: 50%;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <?php include "includes/components/nav.php"; ?>

    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="home" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">Messages</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">Messages</h2>
                    <span class="badge bg-primary rounded-pill px-3 py-2">Recent Contacts</span>
                </div>

                <div class="card chat-list-card">
                    <div class="list-group list-group-flush">
                        <?php
                        $user_id = $_SESSION["user_id"];
                        $message_table = "zmessage_" . $user_id;

                        // Check if table exists (redundant but safe)
                        $sqlCheck = "SHOW TABLES LIKE '$message_table'";
                        $exists = mysqli_query($link, $sqlCheck);
                        
                        if (mysqli_num_rows($exists) > 0) {
                            $stmt = mysqli_prepare($connection, "SELECT sendto, MAX(date) as last_date FROM $message_table GROUP BY sendto ORDER BY last_date DESC");
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $contact_id = $row["sendto"];
                                    $stmt2 = mysqli_prepare($link, "SELECT name, image, active_status, active_status_date FROM user WHERE user_id = ?");
                                    mysqli_stmt_bind_param($stmt2, "i", $contact_id);
                                    mysqli_stmt_execute($stmt2);
                                    $res_user = mysqli_stmt_get_result($stmt2);
                                    
                                    if ($contact = mysqli_fetch_assoc($res_user)) {
                                        $is_online = ($contact["active_status"] == "Online");
                                        ?>
                                        <div class="list-group-item contact-item p-3 <?php echo $is_online ? 'online' : ''; ?>" onclick="document.getElementById('chat_form_<?php echo $contact_id; ?>').submit();">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3 position-relative">
                                                    <?php if($contact['image']): ?>
                                                        <img src="<?php echo htmlspecialchars($contact['image']); ?>" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;" alt="">
                                                    <?php else: ?>
                                                        <div class="avatar-circle"><?php echo strtoupper(substr($contact['name'], 0, 1)); ?></div>
                                                    <?php endif; ?>
                                                    <span class="position-absolute bottom-0 end-0 p-1 border border-light rounded-circle <?php echo $is_online ? 'bg-success' : 'bg-danger'; ?>" style="width: 14px; height: 14px;"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="mb-1 fw-bold"><?php echo htmlspecialchars($contact["name"]); ?></h5>
                                                        <small class="text-muted"><?php echo date("M j, g:i A", strtotime($row["last_date"])); ?></small>
                                                    </div>
                                                    <div class="d-flex align-items-center small mt-1">
                                                        <span class="status-indicator <?php echo $is_online ? 'status-online' : 'status-offline'; ?>"></span>
                                                        <span class="text-muted"><?php echo $is_online ? 'Online' : 'Last seen ' . date("M j, g:i A", strtotime($contact["active_status_date"])); ?></span>
                                                    </div>
                                                </div>
                                                <div class="ms-3">
                                                    <i class="fas fa-chevron-right text-light"></i>
                                                </div>
                                            </div>
                                            <form action="chat" method="POST" id="chat_form_<?php echo $contact_id; ?>" style="display:none;">
                                                <input type="hidden" name="user_id" value="<?php echo $contact_id; ?>">
                                                <input type="hidden" name="name" value="<?php echo htmlspecialchars($contact["name"]); ?>">
                                            </form>
                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                echo '<div class="p-5 text-center"><i class="fas fa-comments fa-3x text-light mb-3"></i><p class="text-muted">No conversations yet.</p></div>';
                            }
                        } else {
                            echo '<div class="p-5 text-center"><p class="text-muted">No messages found.</p></div>';
                        }
                        ?>
                    </div>
                </div>
                <p class="text-center text-muted small mt-4">
                    <i class="fas fa-info-circle me-1"></i> Active status updates during login and logout events.
                </p>
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
