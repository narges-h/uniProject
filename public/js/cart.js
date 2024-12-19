$(document).ready(function () {
    // دکمه افزایش
    $('.custom-btn-increase').on('click', function (e) {
        e.preventDefault();

        let button = $(this);
        let form = button.closest('form');
        let quantityDisplay = form.siblings('.quantity-display');
        let totalPriceElement = document.getElementById('totalPrice');
        let finalPriceElement = document.getElementById('finalPrice');

        button.prop('disabled', true);
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function (response) {
                quantityDisplay.text(response.newQuantity);
                totalPriceElement.innerText = "مجموع قیمت کالاها: " + response.totalPrice.toLocaleString() + " تومان";
                finalPriceElement.innerText = "مجموع کل: " + response.finalPrice.toLocaleString() + " تومان";

                button.prop('disabled', false);
            },
            error: function () {
                button.prop('disabled', false);
                alert('خطایی رخ داد. لطفاً دوباره تلاش کنید.');
            }
        });
    });

    // دکمه کاهش (مشابه افزایش)
    $('.custom-btn-decrease').on('click', function (e) {
        e.preventDefault();

        let button = $(this);
        let form = button.closest('form');
        let quantityDisplay = form.siblings('.quantity-display');
        let totalPriceElement = document.getElementById('totalPrice');
        let finalPriceElement = document.getElementById('finalPrice');

        button.prop('disabled', true);
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function (response) {
                quantityDisplay.text(response.newQuantity);
                totalPriceElement.innerText = "مجموع قیمت کالاها: " + response.totalPrice.toLocaleString() + " تومان";
                finalPriceElement.innerText = "مجموع کل: " + response.finalPrice.toLocaleString() + " تومان";

                button.prop('disabled', false);
            },
            error: function () {
                button.prop('disabled', false);
                alert('خطایی رخ داد. لطفاً دوباره تلاش کنید.');
            }
        });
    });
});



document.addEventListener("DOMContentLoaded", function(){
    const deleteButtons = document.querySelectorAll('#delete-cart');
    const forms = document.querySelectorAll('#delete-cart-form');

        deleteButtons.forEach((button, index) => {
            button.addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "حذف محصول",
                text: "آیا از حذف محصول از سبد خرید اطمینان دارید؟",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "لفو",
                confirmButtonText: "بله، حذف کن"
              }).then((result) => {
                if (result.isConfirmed) {
                    forms[index].submit();
                }
                });
            });
        });
    });
