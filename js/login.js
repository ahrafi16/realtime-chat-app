const form = document.querySelector(".login form"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-txt");

// Prevent normal form submission
form.onsubmit = (e) => {
    e.preventDefault();
}

// Handle button click
continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/chat_app/php/login.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let data = xhr.response.trim();

            if (data === "success") {
                location.href = "users.php";
            } else {
                errorText.textContent = data;
                errorText.style.display = "block";
            }
        }
    }

    // Send form data via AJAX
    let formData = new FormData(form);
    console.log("hello from login.php ", formData);
    xhr.send(formData);
}
