<?php 
    include('lib/libDB.php');


    if (isset($_POST['submitRegister'])) { 
        $name=htmlspecialchars($_POST['first_name']) ?? '';
        
        // Создание нового пользователя в БД

        // переброс обратно на страницу авторизации               
        header('Location: /index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/register.css">
    <link rel="stylesheet" href="/styles/header.css">

    <title>Document</title>
</head>
<body>
    <?php include('header.php') 
    ?>
    <main>
        <h1>
            Регистрация        
        </h1>
    <form  method="post">
    
        <div class="col">
            <div>
                Заполните информацию о себе      
            </div>
            <div>
                <label for="">Фамилия</label>    <input type="text" name="first_name" required="true"> <br>
            </div>
            <div>
                <label for="">Имя</label>    <input type="text" name="second_name" required="true"> <br>
            </div>
            <div>
                <label for="">Почта</label>    <input type="text" name="email" required="true"> <br>
            </div>
        </div>
        
        <div class="col">
            <div>
                <label for="">Логин</label>    <input type="text" name="login" required="true"> <br>
            </div>
            <div>
                <label for="">Пароль</label> <input type="password" name="password" required="true"> <br>
            </div>
                <button type="submit" name="submitRegister">Зарегистрироваться</button>
        </div>
        
        </form>
    </main>
</body>
</html>