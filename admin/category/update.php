<?php
include('./common.php');
if (is_array($category)) {
    extract($category);
}
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Quản lý danh mục</li>
            <li class="breadcrumb-item" aria-current="page">Cập nhật danh mục</li>
        </ol>
    </nav>
    <a class="text-light text-decoration-none btn btn-primary btn-sm mb-3" href="index.php?req=category">
        <i class="fa-solid fa-list-ul"></i> Danh sách danh mục
    </a>
    <form action="index.php?req=category-update" method="POST">
        <div class="form-group">
            <input type="hidden" name="id" id="id" class="form-control" value="<?= isset($id) && $id > 0 ? $id : '' ?>">
            <label for="categoryName">Tên danh mục</label>
            <input type="text" name="categoryName" id="categoryName" class="form-control form-control-sm" value="<?= isset($name) && !empty($name) ? $name : '' ?>">
        </div>
        <?php
        if (isset($message_success) && !empty($message_success)) {
            displayToastrMessageSuccess($message_success);
        }
        ?>
        <input type="submit" class="btn btn-primary btn-block" name="submit" value="CẬP NHẬT" />
        <!-- <div class="mb-3">
            <label for="formFile" class="form-label">Chọn ảnh danh mục</label>
            <input class="form-control" type="file" id="formFile">
        </div> -->
    </form>
</div>