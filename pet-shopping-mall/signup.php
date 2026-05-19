<?php

include_once("dbconn.php"); 

$email = $_POST['email'];
$name = $_POST['uname'];
$pwd = $_POST['pwd'];
$telno = $_POST['telno'];
$today = date("Y/m/d");  
$point = 5000;

$sql = "insert into member 
        values('$name','$email','$pwd','$telno','$today',$point)";
if($conn->query($sql)) {
    echo "<script>alert('회원가입 성공')</script>";
    echo "<script>location.href='index.php'</script>";
}
else {
    echo "<script>alert('회원가입 실패')</script>";
    echo "<script>location.href='signup.html'</script>";
}
$conn->close();
?>

