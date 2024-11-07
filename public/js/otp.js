

var inputFields = document.querySelectorAll("#form-otp input");
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
        case 'otp':
            return document.getElementById('otpError');
        default:
            return null;
    }
}

function validateLoginForm(event) {
    var otp = document.getElementById('otp');
    var isValid = true;

    var inputFields = document.querySelectorAll("#form-otp input");
    var errorMessages = document.querySelectorAll("#form-otp .error-message");
    inputFields.forEach(function (field) {
        field.classList.remove("invalid");
    });
    errorMessages.forEach(function (message) {
        message.textContent = "";
    });

    if (otp) {
        var otpValue = otp.value.trim();
        var otpPattern = /^\d{6}$/; // Pattern for 6-digit numeric OTP

        if (!otpPattern.test(otpValue)) {
            otp.classList.add("invalid");
            var otpErrorMessageElement = findErrorMessage('otp');
            otpErrorMessageElement.textContent = 'لطفا OTP معتبر (6 رقمی) وارد کنید';
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
