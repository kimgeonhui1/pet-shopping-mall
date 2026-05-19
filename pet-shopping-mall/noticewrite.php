<?php
include 'dbconn.php';

$current_user = isset($_SESSION['name']) ? $_SESSION['name'] : '';

// 관리자 권한 확인
if (!isAdmin($conn, $current_user)) {
    echo "<script>alert('관리자만 사용 가능합니다.'); window.location.href = 'noticelist.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>공지 작성</title>
    <link rel="stylesheet" href="noticeStyle.css">
</head>
<body>
<div class="container">
    <h1>공지 작성</h1>
    <form action="noticewriteproc.php" method="post">
        <label for="title">제목:</label>
        <input type="text" id="title" name="title">
        <label for="content">내용:</label>
        <textarea id="content" name="content"></textarea>
        <input type="submit" value="작성">
    </form>
</div>
</body>
</html>
