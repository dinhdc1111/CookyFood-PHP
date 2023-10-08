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
    $sql = "SELECT * FROM account WHERE email='" . $email . "' AND password='" . $password . "' AND deleted = 0";
    $account_check = pdo_query_one($sql);
    return $account_check;
}
function email_check($email)
{
    $sql = "SELECT * FROM account WHERE email='" . $email . "'";
    $email_check = pdo_query_one($sql);
    return $email_check;
}
// Xóa mềm người dùng
function account_delete_soft($id)
{
    $updated_at = date("Y-m-d H:i:s");
    $sql = "UPDATE account SET deleted = 1, updated_at ='" . $updated_at . "' WHERE id =" . $id;
    pdo_execute($sql);
}
// Revert tài khoản
function account_revert($id)
{
    $updated_at = date("Y-m-d H:i:s");
    $sql = "UPDATE account SET deleted = 0, updated_at ='" . $updated_at . "' WHERE id =" . $id;
    pdo_execute($sql);
}
// Xóa cứng tài khoản khỏi DB
function account_delete($id)
{
    $sql = "DELETE FROM account WHERE id =" . $id;
    pdo_execute($sql);
}
function account_update($id, $username, $email, $phone, $address)
{
    $sql = "UPDATE account SET username='" . $username . "',email='" . $email . "',phone='" . $phone . "',address='" . $address . "' WHERE id = " . $id;
    pdo_execute($sql);
}
// Danh sách tài khoản chưa xóa mềm
function account_select_all()
{
    $sql = "SELECT * FROM account WHERE deleted = 0 ORDER BY id ASC";
    $list_account = pdo_query($sql);
    return $list_account;
}
// Danh sách tài khoản bị khóa (Xóa mềm)
function account_lock_select_all()
{
    $sql = "SELECT * FROM account WHERE deleted = 1 ORDER BY id ASC";
    $list_account = pdo_query($sql);
    return $list_account;
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
    $sql = "UPDATE account SET password = '" . $password . "', reset_code = '0' WHERE email = '" . $email . "'";
    pdo_execute($sql);
}
function user_send_reset_password($email, $resetCode)
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

        $subject = 'Thiết lập lại mật khẩu đăng nhập CookyFood';
        $message = "<div style='width: 484px; margin: 0 auto; font-size: 15px;'>";
        $message .= "<div style='text-align: center; margin-bottom: 37px;'><img src='https://res.cloudinary.com/do9rcgv5s/image/upload/v1696750251/cooky%20market%20-%20PHP/extwq2ppklepp82jtwfh.png' alt='Cong Dinh' width='179px'/></div>";
        $message .= "Xin chào quý khách, <br><br>";
        $message .= "Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu CookyFood của bạn.<br><br>";
        $message .= 'Mã xác nhận của bạn là: <strong style="color: #f22726">' . $resetCode . '</strong><br><br>';
        $message .= "Nếu bạn không yêu cầu thiết lập lại mật khẩu, vui lòng bỏ qua email này.<br><br>";
        $message .= "Cảm ơn bạn đã tham gia và đồng hành cùng CookyFood.<br><br><br>";
        $message .= "Trân trọng, <br>";
        $message .= "Đội ngũ CookyFood";
        $message .= "</div>";

        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
