<?php 

    // получение информации о пользователе 
function getUserInfoAutorization($username)  {  
    include('db.php');
    $query = $dbh->prepare('SELECT * FROM users WHERE
                                `username` = :username');
    $query->bindParam(':username',$username);
    $query->execute();
    $data = $query->fetchAll();
    $query = null; $dbh = null;
    return $data;    
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
}
