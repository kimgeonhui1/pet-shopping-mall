<?php
$server = "localhost";
$user = "root";
$pwd = "";
$dbname = "project";

$conn = new mysqli($server, $user, $pwd, $dbname);
if($conn->connect_error) {
    die("DB 접속 오류: " . $conn->connect_error);
}

if (!$conn->set_charset("utf8")) {
    die("Error loading character set utf8: " . $conn->error);
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function isAdmin($conn, $current_user) {
    $sql = "SELECT name FROM member WHERE name = 'admin' AND name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $current_user);
    $stmt->execute();
    $stmt->store_result();

    return $stmt->num_rows > 0;
}
?>
