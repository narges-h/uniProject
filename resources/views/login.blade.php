<!DOCTYPE html>
<html lang="en">

<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معرفی و خرید کتاب | برگستان</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">


</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="main">

        <form id="form-sign" onsubmit="validateLoginForm(event);" method="POST" action="{{ url('/main') }}">
            @csrf


            <img src="{{ asset('img/logoGreen.svg') }}" width="40%" class="img-fluid" />
            <p class="titr">برگستان</p>

            <div id="titr">
                <h1 id="titrpp">ورود</h1>
            </div>

            <div>
                <label style="display: none;" for="phoneNumbers">شماره تلفن</label>
                <input type="tel" id="phoneNumbers" name="phoneNumbers"
                    placeholder="لطفاً شماره موبایل خود را وارد نمایید">
                <span id="phoneNumbersError" class="error-message"></span>
            </div>

            <div id="password">
                <label style="display: none;" for="password">رمز عبور</label>
                <input type="password" id="pass" name="password" placeholder="لطفاً رمز عبور خود را وارد نمایید">
                <span id="passwordError" class="error-massage"></span>

            </div>
{{--
            <div id="password" style="position: relative;">
                <label style="display: none;" for="password">رمز عبور</label>
                <input type="password" id="pass" name="password" placeholder="لطفاً رمز عبور خود را وارد نمایید">
                <span id="togglePassword">
                    👁️
                </span>
                <span id="passwordError" class="error-message"></span>
            </div> --}}


            @if ($errors->any())
                <div class="alert alert-danger error-message" style="margin-bottom: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" name="submit" id="open">ورود</button>

            <p id="sabt">حساب کاربری ندارید؟<a href="{{ url('signup') }}" id="sabtnam">ثبت نام</a></p>

        </form>
    </div>
    @if(session('message'))
        <!-- Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">پیغام سیستم</h5>
                    </div>
                    <div class="modal-body">
                        {{ session('message') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>
    @endif



</body>
<script src="{{ asset('js/login.js') }}"></script>

@if(session('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
@endif

</html>
