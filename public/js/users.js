
document.addEventListener("DOMContentLoaded", function(){
    const deleteButtons = document.querySelectorAll('#delete-user');
    const forms = document.querySelectorAll('#delete-user-form');


        deleteButtons.forEach((button, index) => {
            button.addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "حذف کاربر",
                text: "آیا از حذف کاربر مطمئن هستید؟ امکان بازیابی وجود ندارد",
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

    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                document.getElementById('search-input').value = '';
            }
        });
    });
