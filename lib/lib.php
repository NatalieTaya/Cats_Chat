<?php

// Вывод друзей пользователя
function showFriends($userFriends,$userId){
                    foreach($userFriends as $friend) {
                        $friend_id = $friend['friends_with_id'] == $userId 
                        ? $friend['friend_id'] 
                        : $friend['friends_with_id'];

                        if($friend_id==$_SESSION['user_id'] ){
                            printf('
                                <a href="personal.php">
                                    <img class="friends_avatar" src= "%s"> 
                                    <span>%s</span>
                                </a>
                                ', getUserAvatar($friend_id),getUserInfo($friend_id)[0]['username']);
                        } else {
                        printf('
                                <a href="personal_other_users.php?id=%s">
                                    <img class="friends_avatar" src= "%s">
                                    <span>%s</span>
                                </a>
                                ', $friend_id,getUserAvatar($friend_id), getUserInfo($friend_id)[0]['username']);
                        }
                    }
}
                    

            