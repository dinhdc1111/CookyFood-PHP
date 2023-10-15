<?php
include('./common.php');
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý đơn hàng</li>
        </ol>
    </nav>
    <!-- Search by order id -->
    <div class="mb-2">
        <form class="form-inline" action="index.php?req=order" method="POST">
            <input type="text" name="keyword" class="form-control form-control-sm mr-1 " placeholder="Tìm kiếm đơn hàng theo mã..." style="width: 220px">
            <input type="submit" name="search" class="btn btn-primary btn-sm mr-3" value="Tìm kiếm" />
        </form>
    </div>
    <?php if (isset($list_bill) && is_array($list_bill) && !empty($list_bill)) : ?>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="font-weight-bold w-20px" scope="col">#</th>
                    <th class="font-weight-bold" scope="col">Mã đơn hàng</th>
                    <th class="font-weight-bold" scope="col">Tên khách hàng</th>
                    <th class="font-weight-bold" scope="col">Ngày đặt hàng</th>
                    <th class="font-weight-bold" scope="col">Phương thức thanh toán</th>
                    <th class="font-weight-bold" scope="col">Trạng thái đơn hàng</th>
                    <th class="font-weight-bold" scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_bill as $bill) : ?>
                    <?php
                    extract($bill);
                    $order_status = get_order_status($bill['bill_status']);
                    $classNameStatus = get_order_status_class($bill['bill_status']);
                    ?>
                    <tr class="text-center">
                        <td scope="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                            </div>
                        </td>
                        <th><?= $bill['id'] ?></th>
                        <td class="text-primary"><?= $bill['bill_name'] ?></td>
                        <td><?= $bill['order_date'] ?></td>
                        <td class="<?= $classNameStatus ?>"><?= $order_status ?></td>
                        <td class="text-info"><?= $bill['bill_pay_method'] == 1 ? 'Thanh toán khi nhận hàng' : 'Thanh toán online' ?></td>
                        <td>
                            <a href="index.php?req=order-delete&id=<?= $bill['id'] ?>" title="Xóa" class="btn btn-outline-danger btn-sm border border-0 delete-order-button" data-order-id="<?= $bill['id'] ?>"><i class="fa-regular fa-trash-can"></i></a>
                            <a href="index.php?req=order-detail&id=<?= $bill['id'] ?>" title="Sửa" class="btn btn-outline-info btn-sm border border-0"><i class="fa-regular fa-pen-to-square"></i></a>
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
    function confirmDelete(orderId) {
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
                window.location.href = 'index.php?req=order-delete&id=' + orderId;
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-order-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const orderId = button.getAttribute('data-order-id');
                confirmDelete(orderId);
            });
        });
    });
</script>