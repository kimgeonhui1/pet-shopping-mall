<?php

session_start();
include_once('dbconn.php');
$email = $_SESSION['uid'];
$name = $_POST['name'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$total_price = $price * $qty;

$sql = "INSERT INTO cart (email, name, qty, price) VALUES ('$email', '$name', $qty, $total_price)";

if($conn->query($sql)) {
    echo "<script>alert('장바구니담기 성공')</script>";
    echo "<script>location.href='index.php'</script>";
}
else {
    echo "<script>alert('장바구니담기 실패')</script>";
    echo "<script>location.href='index.php'</script>";
}
$conn->close();
?>