
document.addEventListener("DOMContentLoaded", function(){
    const deleteButtons = document.querySelectorAll('#delete-category');
    const forms = document.querySelectorAll('#delete-category-form');


        deleteButtons.forEach((button, index) => {
            button.addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "حذف دسته بندی",
                text: "آیا از حذف دسته بندی مطمئن هستید؟ امکان بازیابی وجود ندارد",
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

