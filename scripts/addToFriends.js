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
                  // Получаем данные формы
                const formDataInput = new FormData(event.target);
                const sender_id = formDataInput.get('sender_id'); 
                const user_id = formDataInput.get('user_id'); 
                console.log('ID:', user_id); // Используем в JavaScript

        let formData = new FormData();
        formData.append('sender_id',sender_id)
        formData.append('user_id',user_id)
        formData.append('status', friendship_status)

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