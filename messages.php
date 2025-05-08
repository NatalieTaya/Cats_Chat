<?php 
    session_start();
    include('lib/libDB.php');


    // Меню под шапкой сайта
    if (isset($_POST['submitExit'])) {
        setcookie('key', '', 0);
        header('Location: /index.php');
    } 
    $sender_id=$_SESSION['user_id'];
    if (isset($_POST['submitMsg'])) {
        $message_text=($_POST['newMessage']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/messages.css">

    <title>Document</title>
</head>
<body>
    <?php include('header.php') ?>

    <nav>
        <a href="personal.php">Главная</a>
        <a href="messages.php">Сообщения</a>
    </nav>

        <main>
        <div id="otherUsers">  
        </div>
        <div id="chatsBlock">  
            <form action="" method="post">
                
             </form>
            <?php
            $chats_available = getAllUsers();
            if (isset($_POST['receiver_id'])) {
                $receiver_id = (int)$_POST['receiver_id'];
            } else {
                $receiver_id = null;
            }
            foreach($chats_available as $friend){  
                printf('<form method="POST" action="">
                                    <input type="hidden" name="receiver_id" value="%s">
                                    <button type="submit" class="user_avatar" >%s</button>
                                </form>', $friend['user_id'],$friend['username']);
            }
            
            ?>
        </div>
        <div id="messageBlock">  
            <?php
            if ($receiver_id!=null and $receiver_id!==$sender_id) {
                // сообщения отправителя
                $myMessages = getMessages($sender_id);
                // сообщения получателя
                $receiverMessages=array();
                if ($receiver_id!=$sender_id) {$receiverMessages = getMessages($receiver_id);}
                //объединим их все
                $allMessages =array_merge($myMessages, $receiverMessages);
                // сортируем все сообщения по дате
                usort($allMessages, function($a, $b) {
                    return strtotime($a['created_at']) <=> strtotime($b['created_at']);
                });
                foreach($allMessages as $message){
                    if ($message['sender_id']==$sender_id and $message['receiver_id']!=$sender_id) {
                        printf('<div class="message_sender">  
                                        %s
                        </div>', $message['message_text']);
                    } else if ($message['sender_id']==$receiver_id ){
                        printf('<div class="message_receiver">  
                                        %s
                        </div>', $message['message_text']);
                    }
                }
            } else if($receiver_id!=null and $receiver_id===$sender_id)  {
                // сообщения отправителя самому себе
                $myMessages = getMessagesToMe($sender_id,$receiver_id);
                // сортируем все сообщения по дате
                usort($myMessages, function($a, $b) {
                    return strtotime($a['created_at']) <=> strtotime($b['created_at']);
                });
                foreach($myMessages as $message){
                        printf('<div class="message_sender">  
                                        %s
                        </div>', $message['message_text']);
                    
                }
            }
            
            ?>
        </div>
            <form action="" method="post" onsubmit="sendMessage(event)">
                <input type="text" name="newMessage" id="newMessage">
                <button type="submit" name="submitMsg">Send</button>
             </form>
        </main>
        <script>
            window.receiver = <?php echo json_encode($receiver_id, JSON_UNESCAPED_UNICODE) ?>;
            // передача данных того, кто отправляет сообщение
            window.sender = <?php echo json_encode($sender_id, JSON_UNESCAPED_UNICODE) ?>;
        </script>
        <script src="scripts/sendMessage.js">
        </script>


</body>
</html>