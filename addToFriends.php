<?php
include('lib/libDB.php');

$sender_id= $_POST['sender_id'] ?? '[]';
$user_id= $_POST['user_id'] ?? '[]';
$status = 1;
$created_at = 1;
createNewFriendship($sender_id ,$user_id ,$status,$created_at);

echo "Добавлен в друзья";
?>