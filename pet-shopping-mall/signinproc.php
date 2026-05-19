<?php
include 'dbconn.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$email = $_POST['email'];
$password = $_POST['pwd'];

$sql = "SELECT email, name FROM member WHERE email = ? AND pwd = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($email, $name);
    $stmt->fetch();
    $_SESSION['uid'] = $email;
    $_SESSION['name'] = $name;
    echo "<script>alert('로그인 성공!'); window.location.href = 'index.php';</script>";
} else {
    echo "<script>alert('로그인 실패: 이메일 또는 비밀번호를 확인하세요.'); window.location.href = 'signin.html';</script>";
}

$stmt->close();
$conn->close();
?>
