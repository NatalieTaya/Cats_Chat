<?php 
    session_start();
    include('lib/libDB.php');


    // Меню под шапкой сайта
    if (isset($_POST['submitExit'])) {
        setcookie('key', '', 0);
        header('Location: /index.php');
    } 
        
    $sender_id=$_SESSION['user_id'];
    $receiver_id=1;

    if (isset($_POST['submitMsg'])) {
        $message_text=($_POST['newMessage']);
        $created_at=null;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/personal.css">
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


        <div id="messageBlock">  
            <?php
            $allmessages = getMessages($sender_id);
            foreach($allmessages as $message){
                printf('<div class="message_sender">  
                                %s
                </div>', $message['message_text']);
            }
            ?>
        </div>
            <form action="" method="post" onsubmit="sendMessage(event)">
                <input type="text" name="newMessage" id="newMessage">
                <button type="submit" name="submitMsg">Send</button>
             </form>
        </main>
        <script>
            // передача данных через AJAX
            window.sender = <?php echo json_encode($sender_id, JSON_UNESCAPED_UNICODE) ?>;
            window.receiver = <?php echo json_encode($receiver_id, JSON_UNESCAPED_UNICODE) ?>;
        </script>
        <script src="sendMessage.js">
        </script>


</body>
</html>