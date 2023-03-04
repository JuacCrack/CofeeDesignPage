const email = "user@master";
const password = "$1m0nB2&c";

const loginBtn = document.getElementById("login-btn");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const popup = document.querySelector(".popup");
const popupText = document.getElementById("popup-text");
const overlay = document.querySelector(".overlay");
const closeBtn = document.getElementById("close-btn");

loginBtn.addEventListener("click", function() {
	if (emailInput.value === email && passwordInput.value === password) {
		window.location.href = "home.php";
	} else {
		popupText.textContent = "Incorrect email or password";
		overlay.style.display = "flex";
		popup.style.animation = "popupOpen 0.5s forwards";
	}
});

closeBtn.addEventListener("click", function() {
	overlay.style.display = "none";
	popup.style.animation = "popupClose 0.5s forwards";
});








