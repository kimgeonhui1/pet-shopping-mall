<?php
include 'dbconn.php';

$current_user = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$title = $_POST['title'];
$content = $_POST['content'];

$sql = "INSERT INTO notice (title, content, author) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $content, $current_user);

if ($stmt->execute() === TRUE) {
    echo "<script>alert('공지사항이 작성되었습니다.'); window.location.href = 'noticelist.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
