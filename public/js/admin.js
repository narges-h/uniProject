document.addEventListener("DOMContentLoaded", function(){
const deleteButtons = document.querySelectorAll('#delete');
const forms = document.querySelectorAll('#delete-form');


    deleteButtons.forEach((button, index) => {
        button.addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: "حذف کتاب",
            text: "آیا از حذف کتاب مطمئن هستید؟ امکان بازیابی وجود ندارد",
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
