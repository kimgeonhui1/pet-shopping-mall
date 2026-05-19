<?php
include 'dbconn.php';

// 세션에 사용자 이름이 없으면 로그인 페이지로 이동
if (!isset($_SESSION['name'])) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href = 'signin.php';</script>";
    exit;
}

$current_user = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>공지사항 리스트</title>
    <link rel="stylesheet" href="noticeStyle.css">
</head>
<body>
<div class="container">
    <h1>공지사항 리스트</h1>
    <button onclick="checkAdmin()">공지 작성</button>

    <script>
        function checkAdmin() {
            <?php if (isAdmin($conn, $current_user)) { ?>
                window.location.href = 'noticewrite.php';
            <?php } else { ?>
                alert('관리자만 사용 가능합니다.');
            <?php } ?>
        }
    </script>

    <ul>
        <?php
        // 공지사항 리스트 가져오기
        $sql = "SELECT id, title FROM notice";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li><a href='noticeprint.php?id=".$row['id']."'>".$row['title']."</a></li>";
            }
        } else {
            echo "공지사항이 없습니다.";
        }
        ?>
    </ul>
</div>
</body>
</html>
