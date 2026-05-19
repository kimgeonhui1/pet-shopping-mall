<?php
include 'dbconn.php';

$current_user = isset($_SESSION['name']) ? $_SESSION['name'] : '';

// 관리자 권한 확인
if (!isAdmin($conn, $current_user)) {
    echo "<script>alert('관리자만 사용 가능합니다.'); window.location.href = 'noticelist.php';</script>";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM notice WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "공지사항을 찾을 수 없습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>공지 수정</title>
    <link rel="stylesheet" href="noticeStyle.css">
</head>
<body>
<div class="container">
    <h1>공지 수정</h1>
    <form action="noticemodifyproc.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="title">제목:</label>
        <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>">
        <label for="content">내용:</label>
        <textarea id="content" name="content"><?php echo $row['content']; ?></textarea>
        <input type="submit" value="수정">
    </form>
</div>
</body>
</html>
