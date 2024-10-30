<!DOCTYPE html>
<html lang="en">

<head>
    <title>تأیید کد ورود | برگستان</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body dir="rtl">
    <div class="main">
        <form id="form-otp" method="POST" action="{{ url('/verify-otp') }}">
            @csrf

            <img src="{{ asset('img/originalImage.png') }}" width="240" class="img-fluid" />

            <div id="titr">
                <h1 id="titrpp">ورود کد تأیید</h1>
            </div>

            <div>
                <label style="display: none;" for="phone">شماره تلفن</label>
                <input type="tel" id="phone" name="phone" placeholder="شماره تلفن خود را وارد کنید" required>
                <span id="phoneError" class="error-message"></span>
            </div>

            <div>
                <label style="display: none;" for="otp">کد تایید</label>
                <input type="text" id="otp" name="otp" placeholder="کد تایید را وارد کنید" required maxlength="6">
                <span id="otpError" class="error-message"></span>
            </div>

            <button type="submit" id="verify-otp">تایید کد</button>
        </form>
    </div>
    <script src="{{ asset('js/otp.js') }}"></script>
</body>

</html>
