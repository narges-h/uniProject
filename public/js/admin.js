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
// خالی کردن سرچ
document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            document.getElementById('search-input').value = '';
        }
    });
});
