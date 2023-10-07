<?php
require_once 'pdo.php';

function account_insert($email, $username, $password)
{
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO account(email, username, password,created_at) VALUES ('$email', '$username', '$password', '$created_at')";
    pdo_execute($sql);
}
function account_check($email, $password)
{
    $sql = "SELECT * FROM account WHERE email='" . $email . "' AND password='" . $password . "'";
    $account_check = pdo_query_one($sql);
    return $account_check;
}
function account_update($id, $username, $email, $phone, $address)
{
    $sql = "UPDATE account SET username='" . $username . "',email='" . $email . "',phone='" . $phone . "',address='" . $address . "' WHERE id = " . $id;
    pdo_execute($sql);
}
function account_select_by_id($id)
{
    $sql = "SELECT * FROM account WHERE id=" . $id;
    return pdo_query_one($sql);
}
