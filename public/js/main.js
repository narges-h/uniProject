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

//کلیک نمایش کتاب
$(document).on('click', '#book-card', function() {
    var bookId = $(this).data('book-id');
    window.location.href = '/books/' + bookId;
});


document.getElementById('logout').addEventListener('click', function(event) {
    event.preventDefault();

    Swal.fire({
        title: "خروج",
        text: "آیا از خروج از حساب کاربری اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "لفو",
        confirmButtonText: "بله، خارج شو"
      }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
      });
});

document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            document.getElementById('search-input').value = '';
        }
    });
});
