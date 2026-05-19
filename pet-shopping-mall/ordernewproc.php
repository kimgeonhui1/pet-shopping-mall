<?php
include_once('dbconn.php');
$conn->autocommit(false);
$ordno = $_POST['ordno'];
$email = $_POST['email'];
$orddate = date("Y/m/d");
$address = $_POST['address'];
$amount = $_POST['amount'];
$delamt = $_POST['delamt'];
$usepoint = isset($_POST['usepoint']) ? $_POST['usepoint'] : 0;
$total = $amount + $delamt - $usepoint;
$point_to_add = $total * 0.1;  

$sql = "INSERT INTO porder (ordno, email, orddate, address, amount, delamt, usepoint, total) VALUES ('$ordno','$email','$orddate','$address', $amount,$delamt,$usepoint,$total)";
if($conn->query($sql)) {
    $seq = 1;
    $sql = "SELECT * FROM cart WHERE email = '$email'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $productname = $row['name'];
        $qty = $row['qty'];
        $price = $row['price'];
        $sql = "INSERT INTO orditem (ordno, seq, productname, qty, price) VALUES ('$ordno',$seq,'$productname',$qty,$price)";
        if($conn->query($sql)) {
            $seq++;
        } else {
            echo "<script>alert('주문상세내역 저장중 오류 발생');</script>";
            $conn->rollback(); 
            exit;
        }
    }

    $sql = "DELETE FROM cart WHERE email = '$email'";
    if($conn->query($sql)) {
        
        $sql = "UPDATE member SET point = point - $usepoint + $point_to_add WHERE email = '$email'";
        if($conn->query($sql)) {
            $conn->commit();   
            $conn->autocommit(true); 
            echo "<script>alert('주문처리가 성공적으로 완료되었습니다. 포인트가 적립되었습니다.');location.href='index.php'</script>";
        } else {
            echo "<script>alert('포인트 처리 중 오류 발생');</script>";
            $conn->rollback(); 
            exit;
        }
    }
} else {
    echo "<script>alert('주문정보 저장중 오류 발생');</script>";
    $conn->rollback();   
}
$conn->close();
?>
