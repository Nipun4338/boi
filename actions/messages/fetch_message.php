<?php
include "../../includes/auth/security.php";
include "../../includes/config/dbconfig.php";

$user_id = $_SESSION["user_id"];
$receiver_id = $_SESSION["receive"];
$receiver_name = $_SESSION["receive_name"];

$m = "zmessage_" . $user_id;
$m1 = "zmessage_" . $receiver_id;
$output = "";

// Fetch messages with prepared statements
$stmt = mysqli_prepare($connection, "SELECT * FROM $m WHERE sendto = ? ORDER BY date ASC");
mysqli_stmt_bind_param($stmt, "i", $receiver_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $message_text = nl2br(htmlspecialchars($row["message"]));
        $formatted_date = date("g:i A", strtotime($row["date"]));
        
        if ($row["type"] == "receive") {
            // Mark as seen in receiver's table
            $stmt_upd = mysqli_prepare($connection, "UPDATE $m1 SET status = 'seen' WHERE sendto = ? AND type = 'send' AND status != 'seen'");
            mysqli_stmt_bind_param($stmt_upd, "i", $user_id);
            mysqli_stmt_execute($stmt_upd);

            $output .= '
                <div class="message-bubble message-received">
                    <div class="small fw-bold mb-1" style="color: #65676b;">' . htmlspecialchars($receiver_name) . '</div>
                    <div class="message-content">' . $message_text . '</div>
                    <span class="message-time">' . $formatted_date . '</span>
                </div>';
        } else {
            $is_seen = ($row["status"] == "seen");
            $check_icon = $is_seen ? '<i class="fas fa-check-double text-primary"></i>' : '<i class="fas fa-check"></i>';
            
            $output .= '
                <div class="message-bubble message-sent">
                    <div class="message-content">' . $message_text . '</div>
                    <div class="d-flex justify-content-end align-items-center gap-1">
                        <span class="message-time">' . $formatted_date . '</span>
                        <span class="message-time" style="font-size: 0.65rem;">' . $check_icon . '</span>
                    </div>
                </div>';
        }
    }
} else {
    $output = '<div class="text-center p-5 text-muted"><p>No messages. Start a conversation!</p></div>';
}

echo json_encode($output);
?>
