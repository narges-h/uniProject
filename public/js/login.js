var inputFields = document.querySelectorAll("#form-sign input");
inputFields.forEach(function (field) {
    field.addEventListener('input', function () {
        if (this.value !== '') {
            this.classList.remove("invalid");
        } else {
            this.classList.add("invalid");
        }
    });
});

function findErrorMessage(fieldId) {
    switch (fieldId) {
        case 'phoneNumbers':
            return document.getElementById('phoneNumbersError');
        case 'password':
          return document.getElementById('passwordError');
        default:
            return null;
    }
}

function validateLoginForm(event) {
    var phone = document.getElementById('phoneNumbers');
    var password = document.getElementById('password');
    var isValid = true;

    var inputFields = document.querySelectorAll("#form-sign input");
    var errorMessages = document.querySelectorAll("#form-sign .error-message");
    inputFields.forEach(function (field) {
        field.classList.remove("invalid");
    });
    errorMessages.forEach(function (message) {
        message.textContent = "";
    });

    if (phone) {
        var phoneNumberValue = phone.value.trim();
        var phoneNumberPattern = /^0\d{10}$/;
        if (!phoneNumberPattern.test(phoneNumberValue)) {
            phone.classList.add("invalid");
            var errorMessageElement = findErrorMessage('phoneNumbers');
            errorMessageElement.textContent = 'لطفا شماره تلفن معتبر وارد کنید';
            isValid = false;
        }
    }

    if (password) {
        var passwordValue = password.value.trim();
        var passwordPattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}/;
        if (!passwordPattern.test(passwordValue)) {
          password.classList.add("invalid");
          var existingErrorMessage = findErrorMessage(password);
          if (!existingErrorMessage) {
            var errorMessage = document.createElement('span');
            errorMessage.textContent = 'لطفا یک رمز عبور معتبر وارد کنید';
            errorMessage.style.color = "red";
            errorMessage.classList.add('error-message');
            password.parentElement.appendChild(errorMessage);
          }
          isValid = false;
        }
      }

    if (isValid) {
        event.target.submit();
    }else{

        event.preventDefault();

    }

    return isValid;
}
