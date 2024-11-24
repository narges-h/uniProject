document.getElementById('form-register').addEventListener('submit', validateRegisterForm);

var inputFields = document.querySelectorAll("#form-register input");
inputFields.forEach(function (field) {
  field.addEventListener('input', function () {
    if (this.value !== '') {
      this.classList.remove("invalid");
    } else {
      this.classList.add("invalid");
    }
  });
});

document.getElementById('togglePassword').addEventListener('click', function () {
    var passwordField = document.getElementById('pass');
    var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // تغییر آیکون برای نشان دادن حالت فعلی
    this.textContent = type === 'password' ? '👁️' : '🙈';
});

function isValidNationalCode(nationalCode) {
  if (/^[0-9]{10}$/.test(nationalCode)) {
    let sumCodemelliNumber = 0;
    for (let i = 0; i < 9; i++) {
      sumCodemelliNumber += parseInt(nationalCode[i]) * (10 - i);
    }
    let rem = sumCodemelliNumber % 11;
    let lastNationalCodeDigit = parseInt(nationalCode[9]);
    if ((rem > 1 && (11 - rem === lastNationalCodeDigit)) || (rem <= 1 && rem === lastNationalCodeDigit)) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function findErrorMessage(fieldId) {
  switch (fieldId) {
    case 'name':
      return document.getElementById('fullnameError');
    case 'family':
      return document.getElementById('fullnameError');
    case 'pass':
      return document.getElementById('passwordError');
    case 'phoneNumbers':
      return document.getElementById('phoneNumbersError');
    case 'gender':
      return document.getElementById('genderError');
    default:
      return null;
  }
}
var isValid = true;


function validateRegisterForm(event) {

  var name = document.getElementById('name');
  var family = document.getElementById('family');
  var password = document.getElementById('pass');
  var phone = document.getElementById('phoneNumbers');
  var isValid = true;

  var inputFields = document.querySelectorAll("#form-register input");
  var errorMessages = document.querySelectorAll("#form-register .error-message");
  inputFields.forEach(function (field) {
    field.classList.remove("invalid");
  });
  errorMessages.forEach(function (message) {
    message.textContent = "";
  });
  if (name) {
    var fullnameValue = name.value.trim();
    var fullnamePattern = /^(?![0-9])[a-zA-Z0-9\u0600-\u06FF\s]{3,}$/;
    if (!fullnamePattern.test(fullnameValue)) {
        name.classList.add("invalid");
      var existingErrorMessage = findErrorMessage(name);
      if (!existingErrorMessage) {
        var errorMessage = document.createElement('span');
        errorMessage.textContent = 'لطفا یک نام مناسب وارد کنید';
        errorMessage.style.color = "red";
        errorMessage.classList.add('error-message');
        name.parentElement.appendChild(errorMessage);
      }
      isValid = false;
    }
  }

  if (family) {
    var fullnameValue = family.value.trim();
    var fullnamePattern = /^(?![0-9])[a-zA-Z0-9\u0600-\u06FF\s]{3,}$/;
    if (!fullnamePattern.test(fullnameValue)) {
        family.classList.add("invalid");
      var existingErrorMessage = findErrorMessage(family);
      if (!existingErrorMessage) {
        var errorMessage = document.createElement('span');
        errorMessage.textContent = 'لطفا یک نام خانوادگی مناسب وارد کنید';
        errorMessage.style.color = "red";
        errorMessage.classList.add('error-message');
        family.parentElement.appendChild(errorMessage);
      }
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


  if (phone) {
    var phoneNumberValue = phone.value.trim();
    var phoneNumberPattern = /^0\d{10}$/;
    if (!phoneNumberPattern.test(phoneNumberValue)) {
      phone.classList.add("invalid");
      var existingErrorMessage = findErrorMessage(phone);
      if (!existingErrorMessage) {
        var errorMessage = document.createElement('span');
        errorMessage.textContent = 'لطفا شماره تلفن معتبر وارد کنید';
        errorMessage.style.color = "red";
        errorMessage.classList.add('error-message');
        phone.parentElement.appendChild(errorMessage);
      }
      isValid = false;
    }
  }


  var genderOptions = document.querySelectorAll('#form-register input[name="gender"]');
  var isGenderSelected = Array.from(genderOptions).some(option => option.checked);

  if (!isGenderSelected) {
    var errorMessage = document.createElement('span');
    errorMessage.textContent = 'لطفا جنسیت خود را انتخاب کنید';
    errorMessage.style.color = "red";
    errorMessage.classList.add('error-message');
    document.getElementById('genderError').appendChild(errorMessage);
    isValid = false;
  }

  if (educationLevel.value === "") {
    educationLevel.classList.add("invalid");
    var errorMessage = document.createElement('span');
    errorMessage.textContent = 'لطفا مدرک تحصیلی خود را انتخاب کنید';
    errorMessage.style.color = "red";
    errorMessage.classList.add('error-message');
    document.getElementById('educationLevelError').appendChild(errorMessage);
    isValid = false;
  } else {
    educationLevel.classList.remove("invalid");
  }


//   if (isValid) {
//     window.location.href = "login.html";
//   }


  if (isValid) {
    event.target.submit();
  }else{
        event.preventDefault();
    }


  return isValid;
}
