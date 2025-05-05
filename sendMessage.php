<?php
include('lib/libDB.php');
$sender_id= $_POST['sender_id'] ?? '[]';
$receiver_id= $_POST['receiver_id'] ?? '[]';
$message= $_POST['message'] ?? '[]';
$created_at=null;
createNewMessage($sender_id ,$receiver_id ,$message,$created_at);

$html = '';
$html .= '<div class = "message_sender">'. $message .'</div>';

echo $html;
?>