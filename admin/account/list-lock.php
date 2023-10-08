<?php
include('./common.php');
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách người dùng bị khóa</li>
        </ol>
    </nav>
    <div class="btn-add mb-3">
        <a class="text-light text-decoration-none btn btn-primary btn-sm" href="index.php?req=account">
            <i class="fa-solid fa-list"></i> Quản lý người dùng
        </a>
    </div>
    <?php if (isset($list_account) && is_array($list_account) && !empty($list_account)) : ?>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="font-weight-bold w-20px" scope="col">#</th>
                    <th class="font-weight-bold" scope="col">ID</th>
                    <th class="font-weight-bold" scope="col">Tên người dùng</th>
                    <th class="font-weight-bold" scope="col">Email</th>
                    <th class="font-weight-bold" scope="col">Số điện thoại</th>
                    <th class="font-weight-bold" scope="col">Địa chỉ</th>
                    <th class="font-weight-bold" scope="col">Vai trò</th>
                    <th class="font-weight-bold" scope="col">Ngày tạo</th>
                    <th class="font-weight-bold" scope="col">Ngày cập nhật</th>
                    <th class="font-weight-bold" scope="col">Trạng thái</th>
                    <th class="font-weight-bold" scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_account as $account) : ?>
                    <?php
                    extract($account);
                    $formatted_date_create = date('d/m/Y', strtotime($created_at));
                    $formatted_date_update = ($updated_at == "0000-00-00 00:00:00")
                        ? "<small class='text-primary'>Chưa cập nhật</small>"
                        : date('d/m/Y', strtotime($updated_at));

                    $formatRole = ($role == 1)
                        ? "<strong class='text-danger text-uppercase'>Quản trị viên</strong>"
                        : "<small class='text-primary text-uppercase'>Người dùng</small>"
                    ?>
                    <tr class="text-center">
                        <td scope="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                            </div>
                        </td>
                        <th><?= $id ?></th>
                        <td class="text-primary"><?= $username ?></td>
                        <td><?= $email ?></td>
                        <td><?= $phone ?></td>
                        <td><?= $address ?></td>
                        <td><?= $formatRole ?></td>
                        <td><?= $formatted_date_create ?></td>
                        <td><?= $formatted_date_update ?></td>
                        <td class="text-danger">Vô hiệu hóa</td>
                        <td>
                            <a href="index.php?req=account-delete&id=<?= $id ?>" title="Xóa" class="btn btn-outline-danger btn-sm border border-0 delete-account-button" data-account-id="<?= $id ?>"><i class="fa-regular fa-trash-can"></i></a>
                            <a href="index.php?req=account-revert&id=<?= $id ?>" title="Hồi phục" class="btn btn-outline-warning btn-sm border border-0"><i class="fa-solid fa-rotate"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="text-center">
            <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695886519/cooky%20market%20-%20PHP/e2i0tysgmmogurexye75.jpg" width="505px" alt="No data" />
        </div>
    <?php endif; ?>
</div>
<script>
    function confirmDelete(accountId) {
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
                window.location.href = 'index.php?req=account-delete&id=' + accountId;
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-account-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const accountId = button.getAttribute('data-account-id');
                confirmDelete(accountId);
            });
        });
    });
</script>