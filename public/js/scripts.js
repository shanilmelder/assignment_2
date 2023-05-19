$(function() {
    $('.btn-link[aria-expanded="true"]').closest('.accordion-item').addClass('active');
  $('.collapse').on('show.bs.collapse', function () {
	  $(this).closest('.accordion-item').addClass('active');
	});

  $('.collapse').on('hidden.bs.collapse', function () {
	  $(this).closest('.accordion-item').removeClass('active');
	});
});

const form = document.getElementById("register-form");
const passwordField = form.elements["password"];
const confirmPasswordField = form.elements["confirm-password"];
var passwordErrorNotMatched = document.getElementById("password-error-not-matched");
var passwordErrorNotPattern = document.getElementById("password-error-not-pattern");
var regex = new RegExp("^(?=.*[A-Z].*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{5,10}$");


passwordField.addEventListener("keyup", function(event) {
  validatePassword(event);
});

confirmPasswordField.addEventListener("keyup", function(event) {
	validatePassword(event);
});

function validatePassword(event) {
	//If the passwords don't match, prevent form submission and display an error message
	if (passwordField.value !== confirmPasswordField.value) {
		event.preventDefault();
		passwordErrorNotMatched.classList.remove("d-none");
	}else {
		passwordErrorNotMatched.classList.add("d-none");
	}
	console.log(regex.test())
	if (!regex.test()) {
		event.preventDefault();
		passwordErrorNotPattern.classList.remove("d-none");
	}else {
		passwordErrorNotPattern.classList.add("d-none");
	}
}