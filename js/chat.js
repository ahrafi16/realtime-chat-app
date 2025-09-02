const form = document.querySelector(".typing-area"),
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button");

form.onsubmit = (e) => {
    e.preventDefault();
}

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/chat_app/php/insert-chat.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            inputField.value = "";
        }
    }

    // Send form data via AJAX
    let formData = new FormData(form);
    console.log("hello from login.php ", formData);
    xhr.send(formData);
}