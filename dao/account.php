<?php
require_once 'pdo.php';

function account_insert($email, $username, $password)
{
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO account(email, username, password,created_at) VALUES ('$email', '$username', '$password', '$created_at')";
    pdo_execute($sql);
}
