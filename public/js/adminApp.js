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
