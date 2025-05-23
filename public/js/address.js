$(document).ready(function () {
    $('form').on('submit', function (e) {
        const postCode = $('#postCode').val();

        // بررسی اینکه کد پستی ۱۰ رقمی باشد
        const postCodePattern = /^[0-9]{10}$/;
        if (!postCodePattern.test(postCode)) {
            e.preventDefault();
            Swal.fire({
                title: "خطا",
                text: "کد پستی نامعتبر است",
                icon: "error",
                confirmButtonText: "تایید"
              });
            return false;
        }
    });

    $('.province-select').on('change', function (e) {
        const provinceSelect = document.getElementById("province-select");
        const citySelect = document.getElementById("city-select");
        const form = $(provinceSelect.closest('form'));
        const selectedValue = provinceSelect.value;
        const cityDiv = document.getElementById("city-div");

        // اضافه کردن متن لودینگ
        citySelect.innerHTML = '<option value="">در حال بارگذاری...</option>';
        const loadingSpinner = document.createElement('div');
        loadingSpinner.className = 'loading-spinner';
        cityDiv.appendChild(loadingSpinner);

        $.ajax({
          url: `/checkout/address/cities/${selectedValue}`,
          method: 'POST',
          data: form.serialize(),
          success: function (response) {
              loadingSpinner.remove(); // حذف لودینگ پس از پاسخ
              citySelect.innerHTML = '<option value="">انتخاب شهر</option>'; // ریست کردن شهرها
              response.cities.forEach(city => {
                  citySelect.innerHTML += `<option value="${city.name}">${city.name}</option>`;
              });
          },
          error: function () {
              loadingSpinner.remove(); // حذف لودینگ در صورت خطا
              alert('خطایی رخ داد. لطفاً دوباره تلاش کنید.');
              citySelect.innerHTML = '<option value="">انتخاب شهر</option>';
          }
        });
    });
});
