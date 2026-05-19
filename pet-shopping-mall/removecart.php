<?php
session_start();
include_once('dbconn.php');

$email = $_SESSION['uid'];
$chk = $_GET['chk'];

foreach($chk as $item){ 
    $pos = strpos($item, '@'); 
    $name = substr($item, 0, $pos); 
    $qty = substr($item, $pos + 1); 

    $sql = "DELETE FROM cart WHERE email = '$email' AND name = '$name' AND qty = '$qty'";
    if($conn->query($sql)){
        
    }else{
        echo "Error: " . mysqli_error($conn);
    }
}

echo "<script>alert('장바구니 삭제 성공');</script>";
echo "<script>location.href = 'showcart.php';</script>";

$conn->close();
?>
