<!DOCTYPE html>
<html lang="en">

<head>
    <title>تأیید کد ورود | برگستان</title>
    <link rel="stylesheet" href="{{ asset('css/otp.css') }}">
</head>

<body dir="rtl">
    <div class="main">

        <form id="form-otp" onsubmit="validateLoginForm(event);" method="POST"  action="{{ url('/verifyOtp') }}">
            @csrf


            <img
                src="{{ asset('img/logoGreen.svg') }}"
                width="40%"
                class="img-fluid"
            />

            <div id="titr">
                <h1 id="titrpp">ورود کد تأیید</h1>
            </div>

            <div>
                <input type="hidden"  name="phoneNumbers" value="{{ session('user_signup_data')['phoneNumbers'] }}">
                <p>{{ session('user_signup_data')['phoneNumbers'] }}</p>

                <label style="display: none;" for="otp">کد تایید</label>
                <input type="text" id="otp" name="otp" placeholder="کد تایید را وارد کنید">
                <span id="otpError" class="error-message"></span>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger error-message" style="margin-bottom: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" id="verify-otp">تایید کد</button>
        </form>
    </div>
    <script src="{{ asset('js/otp.js') }}"></script>
</body>
</html>




