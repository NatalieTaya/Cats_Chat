<?php
include('lib/libDB.php');

$sender_id= $_POST['sender_id'] ?? '[]';
$user_id= $_POST['user_id'] ?? '[]';

removeFriendship($sender_id ,$user_id );

echo $user_id;
//echo "Удален из друзей";

?>