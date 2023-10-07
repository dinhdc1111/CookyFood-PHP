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
function verify_reset_code($email, $resetCode)
{
    $sql = "SELECT * FROM account WHERE email='" . $email . "' AND reset_code='" . $resetCode . "'";
    $reset_code_check = pdo_query_one($sql);
    return $reset_code_check;
}
function email_check($email)
{
    $sql = "SELECT * FROM account WHERE email='" . $email . "'";
    $email_check = pdo_query_one($sql);
    return $email_check;
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
// Set token
function reset_code_update($reset_code, $email)
{
    $sql = "UPDATE account SET reset_code = '" . $reset_code . "' WHERE email = '" . $email . "'";
    pdo_execute($sql);
}
function password_update($password, $email)
{
    $sql = "UPDATE account SET password = '" . $password . "' WHERE email = '" . $email . "'";
    pdo_execute($sql);
}
function user_send_reset_password($email, $subject, $message)
{
    global $SMTP_USERNAME;
    global $SMTP_PASSWORD;

    $mail = new \PHPMailer\PHPMailer\PHPMailer();
    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $SMTP_USERNAME; // SMTP username
        $mail->Password = $SMTP_PASSWORD; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 465; // TCP port to connect to
        // Config send & receive
        $mail->setFrom($SMTP_USERNAME, 'CookyFood');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
