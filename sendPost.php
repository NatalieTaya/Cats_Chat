<?php
include('lib/libDB.php');
$sender_id = $_POST['sender_id'] ?? '';
$text = $_POST['text'] ?? '';
$pic_id = 1;
$created_at = date('Y-m-d H:i:s');

createNewPost($sender_id ,$text ,$pic_id,$created_at);

$html = '';
$html .= '<div class = "post">'. $text .'</div>';

echo $html;

?>