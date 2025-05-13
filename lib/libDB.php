<?php 

function getAllUsers()  {  
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM users ');
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;                          
}
    // получение информации о пользователе 
function getUserInfo($user_id)  {  
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM users WHERE
                                `user_id` = :user_id');
    $query->bindParam(':user_id',$user_id);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;    
}
// получение информации о пользователе 
function getUserInfoByUsername($username)  {  
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM users WHERE
                                `username` = :username');
    $query->bindParam(':username',$username);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;    
}
// получение аватарки пользователя 
function getUserAvatar($avatar_id)  {  
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM avatars WHERE
                                `avatar_id` = :avatar_id');
    $query->bindParam(':avatar_id',$avatar_id);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data[0]['avatar_image'];    
}
// получение сообщений пользователя 
function getMessages($sender_id)  {  
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM messages WHERE
                                `sender_id` = :sender_id');
    $query->bindParam(':sender_id',$sender_id);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;                          
}
function getMessagesToMe($sender_id,$receiver_id)  {  
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM messages WHERE
                                `sender_id` = :sender_id AND`receiver_id` = :receiver_id');
    $query->bindParam(':sender_id',$sender_id);
    $query->bindParam(':receiver_id',$receiver_id);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;                          
}



// Создание нового пользователя в БД
function createNewMessage($sender_id ,$receiver_id ,$message_text,$created_at)     {
    include('db.php');
    $query = $dbh->prepare('INSERT INTO messages
                    (`sender_id`,`receiver_id`,`message_text`,`created_at`)
                    VALUES ( :sender_id, :receiver_id, :message_text, :created_at)');
    $status = $query->execute([ 
        ':sender_id' => $sender_id,
        ':receiver_id' => $receiver_id,
        ':message_text' => $message_text,
        ':created_at' => $created_at
        ]);
    $query = null; $dbh = null;

}
// Создание нового поста в БД
function createNewPost($sender_id ,$text ,$image_blob,$created_at)     {
    include('db.php');
    $query = $dbh->prepare('INSERT INTO posts
                    (`sender_id`,`text`,`image_blob`,`created_at`)
                    VALUES ( :sender_id, :text, :image_blob, :created_at)');
    $status = $query->execute([ 
        ':sender_id' => $sender_id,
        ':text' => $text,
        ':image_blob' => $image_blob,
        ':created_at' => $created_at
        ]);
    $query = null; $dbh = null;
}
// Создание новой дружеской связи
function createNewFriendship($friend_id ,$friends_with_id ,$status,$created_at)     {
    include('db.php');
    $query = $dbh->prepare('INSERT INTO friendships
                    (`friend_id`,`friends_with_id`,`status`,`created_at`)
                    VALUES ( :friend_id, :friends_with_id, :status, :created_at)');
    $status = $query->execute([ 
        ':friend_id' => $friend_id,
        ':friends_with_id' => $friends_with_id,
        ':status' => $status,
        ':created_at' => $created_at
        ]);
    $query = null; $dbh = null;
}
function updateFriendship($friend_id ,$friends_with_id ,$status)     {
    include('db.php');
    $query = $dbh->prepare('UPDATE friendships SET `status` = :new_status WHERE                     
                                  (`friend_id` = :friend_id AND `friends_with_id` = :friends_with_id)
                                  OR
                                  (`friend_id` = :friends_with_id AND `friends_with_id` = :friend_id)');
    $status = $query->execute([ 
        ':friend_id' => $friend_id,
        ':friends_with_id' => $friends_with_id,
        ':status' => $status,
        ]);
    $query = null; $dbh = null;
}
// Удаление новой дружеской связи
function removeFriendship($friend_id ,$friends_with_id )     {
    include('db.php');
    $query = $dbh->prepare('DELETE FROM friendships WHERE
                    (`friend_id` = :friend_id AND `friends_with_id` = :friends_with_id)
                    OR
                    (`friend_id` = :friends_with_id AND `friends_with_id` = :friend_id)');
    $query ->execute([
    ':friend_id' => $friend_id,
    ':friends_with_id' => $friends_with_id]);
    $query = null; $dbh = null;
}
function getFriendship($friend_id ,$friends_with_id )     {
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM friendships WHERE
                    (`friend_id` = :friend_id AND `friends_with_id` = :friends_with_id)
                    OR
                    (`friend_id` = :friends_with_id AND `friends_with_id` = :friend_id)');
    $query->bindParam(':friend_id',$friend_id);
    $query->bindParam(':friends_with_id',$friends_with_id);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;                             
}
function getAllFriendshipsRequests($friend_id, $status)     {
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM friendships WHERE
                    (`friend_id` = :friend_id AND `status` = :status)
                    OR
                    (`friends_with_id` = :friend_id AND `status` = :status)');
    $query->bindParam(':friend_id',$friend_id);
    $query->bindParam(':friends_with_id',$friend_id);
    $query->bindParam(':status',$status);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;                             
}
// Получение всех постов пользователя 
function getUsersPosts($sender_id) {
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM posts WHERE
                            `sender_id` = :sender_id ');
    $query->bindParam(':sender_id',$sender_id);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;                             

}
function getUsersFriends($friend_id,$status) {
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM friendships WHERE
                            (`friend_id` = :friend_id OR `friends_with_id` = :friends_with_id) AND `status` = :status');
    $query->bindParam(':friend_id',$friend_id);
    $query->bindParam(':friends_with_id',$friend_id);
    $query->bindParam(':status',$status);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;                             

}
