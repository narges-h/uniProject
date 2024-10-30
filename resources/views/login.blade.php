<!DOCTYPE html>
<html lang="en">

<head>
    <title>معرفی و خرید کتاب | برگستان</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>

<body dir="rtl">
    <div class="main">

        <form id="form-sign" onsubmit="validateLoginForm(event);" method="POST" action="{{ url('/auth') }}">
            @csrf

            <div>
                <img
                src="{{ asset('img/originalImage.png') }}"
                width="240"
                class="img-fluid"
                />

            </div>


            <div id="titr">
                <h1 id="titrpp">ورود یا ثبت نام</h1>
            </div>

            <div>
                <label style="display: none;" for="phoneNumbers">شماره تلفن</label>
                <input type="tel" id="phoneNumbers" name="phoneNumbers" placeholder="لطفاً شماره موبایل خود را وارد نمایید">
                <span id="phoneNumbersError" class="error-message"></span>
            </div>

            <button type="submit" name="submit" id="open">ورود</button>

            <p id="sabt">حساب کاربری ندارید؟<a href="{{ route('signup') }}" id="sabtnam">ثبت نام</a></p>

        </form>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
