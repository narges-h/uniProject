<link rel="stylesheet" href="{{ asset('css/add-book.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<h1>افزودن کتاب جدید</h1>


<form action="{{ route('insert') }}" method="POST" class="container">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label for="title" class="form-label">عنوان:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="col-md-6">
            <label for="author" class="form-label">نویسنده:</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="col-md-6">
            <label for="category_id" class="form-label">دسته بندی:</label>
            <select class="form-select" id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="price" class="form-label">قیمت:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="col-12">
            <label for="description" class="form-label">توضیحات:</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="col-md-6">
            <label for="rating" class="form-label">امتیاز:</label>
            <input type="number" class="form-control" id="rating" name="rating" min="0" max="5" step="0.1">
        </div>
        <div class="col-md-6">
            <label for="stock" class="form-label">موجودی:</label>
            <input type="number" class="form-control" id="stock" name="stock" min="0">
        </div>
        <div class="col-md-6">
            <label for="publishDate" class="form-label">تاریخ انتشار:</label>
            <input type="date" class="form-control" id="publishDate" name="publishDate">
        </div>
        <div class="col-md-6">
            <label for="number_of_page" class="form-label">تعداد صفحات:</label>
            <input type="number" class="form-control" id="number_of_page" name="number_of_page" min="1">
        </div>
        <div class="col-12">
            <label for="coveruri" class="form-label">آدرس تصویر جلد:</label>
            <input type="url" class="form-control" id="coveruri" name="coveruri">
        </div>
        <div class="col-12">
            <label for="translator_name" class="form-label">نام مترجم:</label>
            <input type="text" class="form-control" id="translator_name" name="translator_name">
        </div>
        <div class="col-12">
            <label for="lang" class="form-label">زبان:</label>
            <input type="text" class="form-control" id="lagn" name="lagn" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-3">ذخیره</button>
        </div>
    </div>
</form>
