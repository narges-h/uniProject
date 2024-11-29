

const nums = document.querySelectorAll('.num');

nums.forEach(input => {
  input.addEventListener('input', function (e) {
    this.value = this.value.replace(/[^0-9]/g, '');
  });
});

document.getElementById('rating').addEventListener('input', function (e) {
  if (this.value > 5) {
    this.value = 5;
  }
});
document.getElementById('price').addEventListener('input', function (e) {
    if (this.value > 999999) {
      this.value = 999999;
    }
  });

  document.getElementById('number_of_page').addEventListener('input', function (e) {
    if (this.value > 10000) {
      this.value = 10000;
    }
  });
  document.getElementById('stock').addEventListener('input', function (e) {
    if (this.value > 1000) {
      this.value = 1000;
    }
  });
const inputs = document.querySelectorAll('.form-control');

inputs.forEach(input => {
      input.addEventListener('invalid', function () {
        this.setCustomValidity('لطفاً این مقدار را پر کنید.');
  });

  input.addEventListener('input', function () {
    this.setCustomValidity('');
  });
});


const select = document.getElementById('category_id');

select.addEventListener('invalid', function () {
  this.setCustomValidity('لطفاً یک گزینه را انتخاب کنید.');
});

select.addEventListener('change', function () {
  this.setCustomValidity('');
});
