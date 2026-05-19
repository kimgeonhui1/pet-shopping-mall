<?php
include 'dbconn.php';

$current_user = isset($_SESSION['name']) ? $_SESSION['name'] : '';

// 관리자 권한 확인
if (!isAdmin($conn, $current_user)) {
    echo "<script>alert('관리자만 사용 가능합니다.'); window.location.href = 'noticelist.php';</script>";
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM notice WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute() === TRUE) {
    echo "<script>alert('공지사항이 삭제되었습니다.'); window.location.href = 'noticelist.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
