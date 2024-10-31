<!DOCTYPE html>
<html lang="en">

<head>
    <title>معرفی و خرید کتاب | برگستان</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>

<body dir="rtl">
    <div class="main">

        <form id="form-sign" onsubmit="validateLoginForm(event);" method="POST" action="{{ url('/api/main') }}">
            @csrf

            <img
            src="{{ asset('img/originalImage.png') }}"
            width="240"
            class="img-fluid"
            />

            <div id="titr">
                <h1 id="titrpp">ورود یا ثبت نام</h1>
            </div>


            {{-- @if (isset($errors) && $errors->any())
             <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}


            <div>
                <label style="display: none;" for="phoneNumbers">شماره تلفن</label>
                <input type="tel" id="phoneNumbers" name="phoneNumbers" placeholder="لطفاً شماره موبایل خود را وارد نمایید">
                <span id="phoneNumbersError" class="error-message"></span>
            </div>

            <div id="password">
                <label style="display: none;" for="password">رمز عبور</label>
                <input type="password" id="password" name="password" placeholder="لطفاً رمز عبور خود را وارد نمایید">
                <span  id="passwordError" class="error-massage"></span>

            </div>

            <button type="submit" name="submit" id="open">ورود</button>

            <p id="sabt">حساب کاربری ندارید؟<a href="{{ route('signup') }}" id="sabtnam">ثبت نام</a></p>

        </form>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
