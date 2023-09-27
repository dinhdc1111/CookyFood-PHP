<?php
include('./common.php');
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý danh mục</li>
        </ol>
    </nav>
    <div class="d-flex align-items-center mb-3">
        <div class="form-check ml-3">
            <input class="form-check-input" type="checkbox" value="" id="checkbox-all">
            <label class="form-check-label" for="checkbox-all">
                Chọn tất cả
            </label>
        </div>
        <div class="btn-add ml-3">
            <a class="text-light text-decoration-none btn btn-primary btn-sm" href="index.php?req=category-add">
                Thêm mới danh mục
            </a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="font-weight-bold w-20px" scope="col">#</th>
                <th class="font-weight-bold" scope="col">ID</th>
                <th class="font-weight-bold" scope="col">Tên danh mục</th>
                <th class="font-weight-bold" scope="col">Hình ảnh</th>
                <th class="font-weight-bold" scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($list_category as $category) {
                extract($category);
                $remove_category = "index.php?req=category-delete&id=" . $id;
                $update_category = "index.php?req=category-update&id=" . $id;
                echo '
                    <tr>
                        <td scope="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                        </div>
                        </td>
                        <th>' . $id . '</th>
                        <td>' . $name . '</td>
                        <td><img src="https://picsum.photos/200" alt="Danh mục"/></td>
                        <td>
                            <a href="' . $remove_category . '" title="Xóa" class="btn btn-outline-danger btn-sm border border-0 delete-category-button" data-category-id="' . $id . '"><i class="fa-regular fa-trash-can"></i></a>
                            <a href="' . $update_category . '" title="Sửa" class="btn btn-outline-info btn-sm border border-0"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                    ';
            }
            ?>
        </tbody>
    </table>

</div>
<script>
    function confirmDelete(categoryId) {
        Swal.fire({
            title: 'Bạn có chắc chắn xóa?',
            text: 'Bạn sẽ không thể khôi phục lại!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Xác nhận',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php?req=category-delete&id=' + categoryId;
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-category-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const categoryId = button.getAttribute('data-category-id');
                confirmDelete(categoryId);
            });
        });
    });
</script>