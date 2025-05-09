<?php
include('lib/libDB.php');
$sender_id = $_POST['sender_id'] ?? '';
$text = $_POST['text'] ?? '';
$created_at = date('Y-m-d H:i:s');

$fileData=null;

$pic_blob = $_FILES['image'] ?? '';
if ($pic_blob !== '' ) {
    $fileTmpPath = $pic_blob['tmp_name'];
    $fileData = file_get_contents($fileTmpPath);
    // Читаем временный файл и кодируем в base64
    $fileDataImage = base64_encode(file_get_contents($pic_blob['tmp_name']));
    $mimeType = mime_content_type($pic_blob['tmp_name']);
}

createNewPost($sender_id ,$text ,$fileData,$created_at);

$html = '';
$html .= '<div class = "post">' ;
        if ($pic_blob !== '' ) {
            $html .= ' <img src=" data:'.$mimeType.'  ;base64,    '.$fileDataImage.'   " height = 300px>';
        }
$html .= '<p>'.$text.'</p>
         </div>';


echo $html;

?>