$(document).ready(function() {
    $('#logout-button').click(function() {
        if (confirm('آیا مطمئن هستید که می‌خواهید خارج شوید؟')) {
            $.ajax({
                url: '/logout', // آدرس روت برای خروج
                type: 'POST',
                data: {
                    phone: '{{ session("user_signup_data.phoneNumbers") }}', // ارسال شماره تلفن کاربر در درخواست
                    _token: '{{ csrf_token() }}' // توکن CSRF به درخواست اضافه می‌شود
                },
                success: function(response) {
                    alert(response.message);
                    window.location.href = '/login'; // هدایت به صفحه ورود
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        }
    });
});
