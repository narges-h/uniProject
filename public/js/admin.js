document.getElementById('delete').addEventListener('click', function(event) {
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
            document.getElementById('delete-form').submit();
        }
      });
});
