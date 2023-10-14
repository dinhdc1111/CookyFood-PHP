<?php
require_once 'pdo.php';
function getTotalOrder()
{
    $totalAllCart = 0;
    foreach ($_SESSION['cart'] as $cart) {
        $totalMoney = ($cart[3] == 0) ? ($cart[2] * $cart[6]) : ($cart[3] * $cart[6]);
        $totalAllCart += $totalMoney;
    }
    return $totalAllCart;
}
function bill_insert($id_user, $username, $address, $phone, $note, $email, $pay_method, $order_date, $total_order)
{
    $sql = "INSERT INTO bill(id_user, bill_name, bill_address, bill_phone, bill_note, bill_email, bill_pay_method,order_date,total) VALUES ('$id_user','$username', '$address', '$phone', '$note', '$email', '$pay_method','$order_date', '$total_order')";
    return pdo_execute_return_lastInsertId($sql);
}
function cart_insert($id_user, $id_product, $image, $name, $price, $quantity, $into_money, $id_bill)
{
    $sql = "INSERT INTO cart(id_user, id_product, image, name, price,quantity,into_money, id_bill) VALUES ('$id_user', '$id_product', '$image', '$name', '$price', '$quantity', '$into_money', '$id_bill')";
    pdo_execute($sql);
}
function bill_select_by_id_bill($id)
{
    $sql = "SELECT * FROM bill WHERE id =" . $id;
    $bill = pdo_query_one($sql);
    return $bill;
}
function cart_select_by_id_bill($id_bill)
{
    $sql = "SELECT * FROM cart WHERE id_bill =" . $id_bill;
    $cart = pdo_query($sql);
    return $cart;
}
// Lịch sử đơn hàng
function bill_select_all($id_user)
{
    $sql = "SELECT * FROM bill WHERE id_user =" . $id_user;
    $list_bill = pdo_query($sql);
    return $list_bill;
}
// Lấy trạng thái đơn hàng
function get_order_status($bill_status)
{
    switch ($bill_status) {
        case '0':
            $status = "Chờ xác nhận";
            break;
        case '1':
            $status = "Đang xử lý";
            break;
        case '2':
            $status = "Đang giao hàng";
            break;
        case '3':
            $status = "Đã giao hàng";
            break;
        case '4':
            $status = "Đã hủy"; // Khách hàng hủy
            break;
        case '5':
            $status = "Bị hủy bỏ"; // Admin hủy
            break;

        default:
            $status = "Chờ xác nhận";
            break;
    }
    return $status;
}
// Trả về class theo order status
function get_order_status_class($bill_status)
{
    switch ($bill_status) {
        case '0':
            $class = "waiting-confirmation";
            break;
        case '1':
            $class = "processing";
            break;
        case '2':
            $class = "shipping";
            break;
        case '3':
            $class = "delivered";
            break;
        case '4':
            $class = "refuse"; // Khách hàng hủy
            break;
        case '5':
            $class = "canceled"; // Admin hủy
            break;

        default:
            $class = "waiting-confirmation";
            break;
    }
    return $class;
}

