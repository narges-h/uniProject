<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معرفی و خرید کتاب | برگستان</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/signup.css') }}" />
</head>

<body dir="rtl">
    <div class="main">
        <form id="form-register" method="post" action="{{ url('/register') }}">
            @csrf

            <img
                src="{{ asset('img/originalImage.png') }}"
                width="240"
                class="img-fluid"
            />

            <div id="titr">
                <h1 id="titrpp">مشخصات خود را کامل کنید:</h1>
            </div>

            <!-- نام و نام خانوادگی -->

            <div id="fullnames">
                <label style="display: none;" for="name">نام </label>
                <input type="text" id="name" name="name" placeholder="نام " title="فقط حروف مجاز است">
                <span id="nameError" class="error-message"></span>
            </div>

            <div id="fullnames">
                <label style="display: none;" for="family">  نام خانوادگی</label>
                <input type="text" id="family" name="family" placeholder=" نام خانوادگی" title="فقط حروف مجاز است">
                <span id="nameError" class="error-message"></span>
            </div>

            <div id="password-forget">
                <label style="display: none;" for="phoneNumbers">شماره تلفن</label>
                <input type="tel" id="phoneNumbers" name="phoneNumbers" placeholder="شماره تلفن"
                    title="لطفاً یک شماره تلفن معتبر (11 رقم که با 0 شروع می شود) وارد کنید">
                <span id="phoneNumbersError" class="error-message"></span>
            </div>

            <div id="password">
                <label style="display: none;" for="pass">رمز عبور</label>
                <input type="password" id="pass" name="password" placeholder="رمز عبور"
                    title="لطفا یک رمز عبور معتبر وارد کنید.(شامل حرف بزرگ،کوچک،عدد و عبارات خاص(@#&) و از 8 یا بیشتر کرکتر باشد)">
                <span id="passwordError" class="error-message"></span>
            </div>

            <select id="educationLevel" name="educationLevel">
                <option value="" disabled selected>مدرک تحصیلی</option>
                <option value="highschool">دیپلم</option>
                <option value="lisans">لیسانس</option>
                <option value="foghlisans">فوق لیسانس</option>
                <option value="doctor">دکترا</option>
            </select>
            <span id="educationLevelError" class="error-message"></span>

            <div id="Gender">
                <label>جنسیت:</label>
                <input type="radio" id="maleGender" name="gender" value="Male">
                <label for="maleGender">مرد</label>
                <input type="radio" id="fameleGender" name="gender" value="Famele">
                <label for="fameleGender">زن</label>
                <p id="genderError"></p>
            </div>

            <div id="rememberMes">
                مرا به خاطر بسپار:
                <input type="checkbox" id="rememberMe" name="rememberMe" value="remembered">
            </div>
            <button name="button" id="sabtnam" type="submit">ثبت نام</button>

        </form>
    </div>
    <script src="{{ asset('js/SignUp.js') }}"></script>
</body>

</html>
