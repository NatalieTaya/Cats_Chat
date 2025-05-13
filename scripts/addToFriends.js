addToFriendsBtn = document.getElementById("addBtn")
if(friendship.length > 0) {                    
    addToFriendsBtn.innerHTML = "Убрать из друзей"
} else {
    addToFriendsBtn.innerHTML = "Добавить в друзья"
}
                textDiv = document.getElementById("text")
function addToFriends(event) {
    event.preventDefault();

    // Получаем данные о пользователях
        console.log(friendship)

        let formData = new FormData();
        formData.append('sender_id',sender_id)
        formData.append('user_id',user_id)


        let xhr = new XMLHttpRequest();
        if(friendship.length > 0) {
            xhr.open('POST','removeFromFriends.php',true);
            xhr.onreadystatechange = function() {
                if(xhr.readyState === 4  && xhr.status === 200) {
                    text.innerHTML = xhr.responseText;
                }
            } 
        } else {
            xhr.open('POST','addToFriends.php',true);
            xhr.onreadystatechange = function() {
                if(xhr.readyState === 4  && xhr.status === 200) {
                    text.innerHTML = xhr.responseText;
                }  
            }
        } 
       
        xhr.send(formData);

}