<?php
include_once("dbconn.php"); 

$email = $_POST['email'];
$name = $_POST['name'];
$pwd = $_POST['pwd'];
$telno = $_POST['telno'];

$sql = "update member 
        set name = '$name', pwd = '$pwd', telno = '$telno'
        where email = '$email'";
if($conn->query($sql)) {
    echo "<script>alert('회원정보수정 성공')</script>";
    echo "<script>location.href='index.php'</script>";
}
else {
    echo "<script>alert('회원정보수정 실패')</script>";
    echo "<script>location.href='signmod.php'</script>";
}
$conn->close();
?>

