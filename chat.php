<?php
include "includes/auth/security.php";
include "includes/config/dbconfig.php";

if (isset($_POST["user_id"]) && isset($_POST["name"])) {
    $_SESSION["receive"] = $_POST["user_id"];
    $_SESSION["receive_name"] = $_POST["name"];
}

if (!isset($_SESSION["receive"])) {
    header("Location: messages");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with <?php echo htmlspecialchars($_SESSION["receive_name"]); ?> | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #f0f2f5; height: 100vh; display: flex; flex-direction: column; }
        .chat-header {
            background: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            z-index: 10;
        }
        #chat-window {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .chat-input-area {
            background: #fff;
            padding: 15px;
            border-top: 1px solid #dee2e6;
        }
        .message-bubble {
            max-width: 75%;
            padding: 10px 15px;
            border-radius: 18px;
            font-size: 0.95rem;
            position: relative;
            word-wrap: break-word;
        }
        .message-sent {
            align-self: flex-end;
            background-color: #0084ff;
            color: white;
            border-bottom-right-radius: 4px;
        }
        .message-received {
            align-self: flex-start;
            background-color: #e4e6eb;
            color: black;
            border-bottom-left-radius: 4px;
        }
        .message-time {
            font-size: 0.75rem;
            opacity: 0.7;
            margin-top: 4px;
            display: block;
        }
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 100;
            top: 0;
            right: 0;
            background-color: #fff;
            overflow-x: hidden;
            transition: 0.3s;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            padding-top: 60px;
        }
        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 1.1rem;
            color: #4b4b4b;
            display: block;
            transition: 0.2s;
        }
        .sidebar a:hover { background-color: #f8f9fa; color: #0084ff; }
        .sidebar .closebtn {
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 30px;
            color: #999;
        }
        #commenton {
            border-radius: 20px;
            resize: none;
            max-height: 120px;
        }
        .btn-send {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php include "includes/components/nav.php"; ?>

    <div class="chat-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="messages" class="btn btn-link text-dark me-2"><i class="fas fa-arrow-left"></i></a>
            <div>
                <h5 class="mb-0 fw-bold"><?php echo htmlspecialchars($_SESSION["receive_name"]); ?></h5>
                <small class="text-success"><i class="fas fa-circle font-size-xs me-1"></i> Active Now</small>
            </div>
        </div>
        <button class="btn btn-outline-secondary btn-sm rounded-circle" onclick="toggleSidebar()">
            <i class="fas fa-ellipsis-v"></i>
        </button>
    </div>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="toggleSidebar()">×</a>
        <div class="px-4 py-3 border-bottom mb-2">
            <h6 class="fw-bold text-muted mb-0">Chat Options</h6>
        </div>
        <a href="filter?user=<?php echo urlencode($_SESSION["receive"]); ?>"><i class="fas fa-book me-2"></i> Books by User</a>
        <a href="#" id="btn-clear-chat" class="text-danger"><i class="fas fa-trash-alt me-2"></i> Clear Messages</a>
        <a href="contact?report=<?php echo urlencode($_SESSION["receive"]); ?>"><i class="fas fa-flag me-2"></i> Report User</a>
    </div>

    <div id="chat-window">
        <!-- Messages will be loaded here via AJAX -->
        <div id="display_message"></div>
    </div>

    <div class="chat-input-area">
        <form id="message_form">
            <div class="input-group">
                <textarea class="form-control" name="commenton" id="commenton" placeholder="Type a message..." rows="1" required></textarea>
                <button type="submit" id="submit" class="btn btn-primary btn-send ms-2">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("mySidebar");
            if (sidebar.style.width === "250px") {
                sidebar.style.width = "0";
            } else {
                sidebar.style.width = "250px";
            }
        }

        $(document).ready(function() {
            function load_messages(scroll = false) {
                $.ajax({
                    url: "actions/messages/fetch_message.php",
                    method: "GET",
                    success: function(data) {
                        try {
                            var messages = JSON.parse(data);
                            $('#display_message').html(messages);
                            if (scroll) {
                                $("#chat-window").scrollTop($("#chat-window")[0].scrollHeight);
                            }
                        } catch(e) { /* silent fail */ }
                    }
                });
            }

            // Real-time update
            setInterval(function() {
                load_messages(false);
            }, 3000);

            load_messages(true);

            // Send message
            $('#message_form').on('submit', function(e) {
                e.preventDefault();
                var msg = $('#commenton').val().trim();
                if (msg === "") return;

                $.ajax({
                    url: "actions/messages/add_message.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#commenton').val('');
                        load_messages(true);
                    }
                });
            });

            // Enter key to send
            $('#commenton').on('keydown', function(e) {
                if (e.which === 13 && !e.shiftKey) {
                    e.preventDefault();
                    $('#message_form').submit();
                }
            });

            // Clear chat
            $('#btn-clear-chat').on('click', function(e) {
                e.preventDefault();
                if (confirm('Delete all messages with this user?')) {
                    $.ajax({
                        url: "actions/messages/delete_message.php",
                        method: "POST",
                        success: function() {
                            load_messages(true);
                            toggleSidebar();
                        }
                    });
                }
            });

            // Auto-resize textarea
            $('#commenton').on('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    </script>
</body>
</html>
