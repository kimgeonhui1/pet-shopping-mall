<?php
include_once("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];

  $sql = "SELECT * FROM member WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo 'exists'; // 이미 사용 중인 이메일
  } else {
    echo 'available'; // 사용 가능한 이메일
  }
}
$conn->close();
?>
