document.getElementById('inputFile').addEventListener('change', function(e) {
    if (this.files.length > 0) {
        document.getElementById("inputLabelFile").classList.add('file-loaded'); // Добавляем класс при выборе файла
    } else {
        document.getElementById("inputLabelFile").classList.remove('file-loaded'); // Убираем класс если файл сброшен
    }
});

function sendPost(event) {

    event.preventDefault();
    // Получим значения с полей ввода
    let inputText = document.getElementById("inputText")
    let inputFile = document.getElementById("inputFile")
    let PostsPosted = document.getElementById("PostsPosted")
    let file = inputFile.files[0];

    const sender_id = window.sender_id
    const inputMsg = inputText.value 
    inputText.value = ""

    let xhr = new XMLHttpRequest();
    xhr.open('POST','sendPost.php',true)

    const formData = new FormData()
    formData.append('image', file);
    formData.append('sender_id',sender_id)
    formData.append('text',inputMsg)
    inputFile.value = ""

    xhr.onreadystatechange = function (){
        if (xhr.readyState === 4 && xhr.status === 200) {
            // вставляем в начало 
            PostsPosted.insertAdjacentHTML('afterbegin', xhr.responseText);
           // PostsPosted.innerHTML += xhr.responseText;
        }
    }
    xhr.send(formData)

}