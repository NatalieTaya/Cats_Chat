function sendMessage(event) {

    event.preventDefault();
    // Получаем значение из поля ввода
    const inputMsg = document.getElementById('newMessage')
    const messageBlock = document.getElementById('messageBlock')
    const sender_id = window.sender;
    const receiver_id = window.receiver;

    const newMessage = inputMsg.value;
    inputMsg.value = "";

    let xhr = new XMLHttpRequest();
    xhr.open('POST','sendMessage.php',true);

    const formData = new FormData();
    formData.append('sender_id', sender_id);
    formData.append('receiver_id', receiver_id);
    formData.append('message', newMessage);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Выводим ответ сервера в div с id="messageBlock"
            messageBlock.innerHTML += xhr.responseText;
            // Прокручиваем к последнему сообщению
            messageBlock.scrollTop = messageBlock.scrollHeight;
        }
    }
    xhr.send(formData);
}