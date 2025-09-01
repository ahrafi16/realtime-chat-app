
console.log("signup.js loaded ✅");


const form = document.querySelector(".signup form"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    console.log("Button clicked ✅");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response.trim();
                console.log(data); // 
                if (data === "success") {
                    location.href = "users.php";
                } else {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}
