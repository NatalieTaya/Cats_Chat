<?php
include('lib/libDB.php');
$sender_id= $_POST['sender_id'] ?? '[]';
$receiver_id= $_POST['receiver_id'] ?? '[]';
$message= $_POST['message'] ?? '[]';
$created_at=date('Y-m-d H:i:s');

createNewMessage($sender_id ,$receiver_id ,$message,$created_at);

$html = '';
//if ($sender_id==$_SESSION['user_id']) {
    $html .= '<div class = "message_sender">'. $message .'</div>';
//} else {
//    $html .= '<div class = "message_sender">'. $message .'</div>';
//}

echo $html;
?>