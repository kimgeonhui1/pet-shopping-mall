<?php
include 'dbconn.php';

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$sql = "UPDATE notice SET title = ?, content = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $title, $content, $id);

if ($stmt->execute() === TRUE) {
    echo "<script>alert('공지사항이 수정되었습니다.'); window.location.href = 'noticeprint.php?id=$id';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
