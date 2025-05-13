<?php 
    session_start();
    include('lib/libDB.php');
    include('lib/lib.php');
    $userId =$_SESSION['user_id'];
    // Меню под шапкой сайта
    if (isset($_POST['submitExit'])) {
        setcookie('key', '', 0);
        header('Location: /index.php');
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/personal.css">
    <link rel="stylesheet" href="/styles/header.css">

    <title>Document</title>
</head>
<body>
    <?php include('header.php') ?>

    <nav>
        <a href="personal.php">Главная</a>
        <a href="messages.php">Сообщения</a>
        <a href="friendRequests.php">Заявки в друзья</a>
        <a href="otherUsers.php">Найти друзей</a>
    </nav>
    <?php 
            $userFriends=getUsersFriends($userId,1);
            $user_info=getUserInfo($userId);
            $photoUrl=getUserAvatar($user_info[0]['photo_id']);
            $posts=getUsersPosts($userId);
    ?>

        <main>
            <div class="usersData">
                <div id="usersData">
                    <div class="userAvatar">
                        <?php 
                        // Вывод аватара пользователя
                            printf('<img src= "%s">', $photoUrl)
                        ?>
                    </div>
                    <div class="userNameInfo">
                        <div class="userName">
                            <?php 
                            // Вывод имени и фамилии пользователя
                                printf('%s %s', $user_info[0]['name'], $user_info[0]['surname'])
                            ?>
                        </div>
                        <div class="userInfo">
                        <?php 
                            // Вывод имени и фамилии пользователя
                                printf('%s ', $user_info[0]['user_info'])
                            ?>
                        </div>
                    </div>
                </div>
                <div class="myPosts">
                        <div class="Postsheader">
                            <?php 
                                // Вывод постов пользователя
                                print_r("Мои посты");
                            ?>
                        </div>
                        <form enctype="multipart/form-data" onsubmit="sendPost(event)">
                            <textarea   id="inputText" ></textarea>
                            <input      id="inputFile" name="image" type="file" >
                            <label      id="inputLabelFile" for="inputFile" class="file-input">
                                <img src="img/picInput.png" alt="" width="50px">
                            </label>
                            <button     id="submitPostBtn" type="submit">Отправить</button>
                        </form>
                        <div id="PostsPosted">
                        <?php 
                        // сортируем все посты по дате
                        usort($posts, function($a, $b) {
                            return strtotime($b['created_at']) <=> strtotime($a['created_at']);
                        });
                                foreach($posts as $post) {
                                    printf('<div class = "post">');
                                        if ($post['image_blob'] !== null ) {

                                            $fileDataImage = base64_encode($post['image_blob']);
                                            $finfo = new finfo(FILEINFO_MIME_TYPE);
                                            $mimeType = $finfo->buffer($post['image_blob']);
                                            printf(' <img src=" data:'.$mimeType.'  ;base64,    '.$fileDataImage.'   "  height = 300px>');
                                        }
                                    printf('<p>%s</p>', $post['text']);
                                    printf('</div>');
                                    
                                }
                        ?>
                        </div>
                </div>
            </div>
            <aside class="userFriends">
                    <h2>Мои друзья</h2>
                    <?php 
                    // Вывод друзей пользователя
                    showFriends($userFriends,$userId);
                    ?>
            </aside>
            <script>
                window.sender_id = <?php echo json_encode($user_info[0]['user_id'], JSON_UNESCAPED_UNICODE) ?>;
            </script>
            <script src="scripts/sendPost.js">
            </script>


        </main>


</body>
</html>