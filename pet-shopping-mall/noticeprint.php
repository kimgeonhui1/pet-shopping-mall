<?php
include 'dbconn.php';

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

$current_user = isset($_SESSION['name']) ? $_SESSION['name'] : '';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['title']; ?></title>
    <link rel="stylesheet" href="noticeStyle.css">
</head>
<body>
<div class="container">
    <h1><?php echo $row['title']; ?></h1>
    <p><?php echo $row['content']; ?></p>

    <?php if (isAdmin($conn, $current_user)) { ?>
        <button onclick="location.href='noticemodify.php?id=<?php echo $id; ?>'">수정</button>
        <button onclick="location.href='noticedel.php?id=<?php echo $id; ?>'">삭제</button>
    <?php } ?>
</div>
</body>
</html>
