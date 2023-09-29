<?php
include('./common.php');
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Quản lý danh mục</li>
            <li class="breadcrumb-item" aria-current="page">Thêm mới danh mục</li>
        </ol>
    </nav>
    <a class="text-light text-decoration-none btn btn-primary btn-sm mb-3" href="index.php?req=category">
        <i class="fa-solid fa-list-ul"></i> Danh sách danh mục
    </a>
    <form action="index.php?req=category-add" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="categoryName">Tên danh mục</label>
            <input type="text" name="categoryName" id="categoryName" class="form-control form-control-sm">
        </div>
        <div class="form-group d-flex align-items-center">
            <div>
                <img class='border rounded' id="preview-image" src='https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg' alt='Không có ảnh' height='115' width='115'>
                <input class="form-control form-control-sm d-none" type="file" id="image" name="image" onchange="previewImage(this)">
                <label for="image" class="form-label label-for-file mt-3">
                    <i class="fa-solid fa-file-image"></i>&nbsp;Chọn ảnh
                </label>
            </div>
        </div>
        <?php
        if (isset($message_success) && !empty($message_success)) {
            displayToastrMessageSuccess($message_success);
        }
        ?>
        <input type="submit" class="btn btn-primary btn-block" name="submit" value="THÊM MỚI" />
    </form>
</div>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>