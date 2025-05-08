function sendPost(event) {

    event.preventDefault();
    // Получим значения с полей ввода
    let inputText = document.getElementById("inputText")
    let inputFile = document.getElementById("inputFile")
    let PostsPosted = document.getElementById("PostsPosted")

    const sender_id = window.sender_id
    const inputMsg = inputText.value 
    inputText.value = ""

    let xhr = new XMLHttpRequest();
    xhr.open('POST','sendPost.php',true)

    const formData = new FormData()
    formData.append('sender_id',sender_id)
    formData.append('text',inputMsg)

    xhr.onreadystatechange = function (){
        if (xhr.readyState === 4 && xhr.status === 200) {
            PostsPosted.innerHTML += xhr.responseText;
        }
    }
    xhr.send(formData)

}