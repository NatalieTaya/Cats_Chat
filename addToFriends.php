<?php
include('lib/libDB.php');

$sender_id= (int)$_POST['sender_id'] ?? '[]';
$user_id= (int)$_POST['user_id'] ?? '[]';
$status = (int)$_POST['status'] ?? '[]';
$created_at = 1;

if( $status == '1' || $status == 1) {
    updateFriendship($user_id ,$sender_id ,1);
    echo "Заявка принята";
} else {
    createNewFriendship($sender_id ,$user_id ,$status,$created_at);
    echo "Подана заявка в друзья";
}


?>