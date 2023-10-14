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
function bill_insert($username, $address, $phone, $note, $email, $pay_method, $order_date, $total_order)
{
    $sql = "INSERT INTO bill(bill_name, bill_address, bill_phone, bill_note, bill_email, bill_pay_method,order_date,total) VALUES ('$username', '$address', '$phone', '$note', '$email', '$pay_method','$order_date', '$total_order')";
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
