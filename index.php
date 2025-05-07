<?php 
    session_start();
    include('lib/libDB.php');

    if (isset($_COOKIE['key'])) { 
        $is_auth =true ;
    } else {
        $is_auth =false ;
    }

    $login =  $_POST['login'] ?? '';
    $password =  $_POST['password'] ?? '';
    // получение информации о пользователе 


    if (isset($_POST['submitLogin'])) {
            if ($data!==false) {
                setcookie('key','hahaha');
                $data=getUserInfo($_POST['login']);
                $_SESSION['user_id']=$data[0]['user_id'];
                $_SESSION['username']=$data[0]['username'];

                header('Location: /personal.php');
            } else {
                echo 'wrong login or password';
            }
    } 
    if (isset($_POST['submitRegister'])) { 
        header('Location: /register.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/header.css">

    <title>Document</title>
</head>
<body>
    <?php include('header.php') ?>

    <?php  if ($is_auth):  header('Location: /personal.php');?>
    <?php else: ?>
        <div class="form_contaner">
            <form  method="post">
                <div>
                    <label for="">Авторизация</label>        
                </div>
                <div>
                    <label class="label_log">Логин</label>    <input type="text" name="login" required="true"> <br>
                </div>
                <div>
                    <label class="label_log">Пароль</label> <input type="password" name="password" required="true"> <br>
                </div>
                    <button type="submit" name="submitLogin">Войти</button>
            </form>
            <form  method="post">
                <button type="submit" name="submitRegister">Зарегистрироваться</button>
            </form>
        </div>

    <?php endif; ?>

</body>
</html>