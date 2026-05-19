<?php
include_once("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];

  $sql = "SELECT * FROM member WHERE name = '$name'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo 'exists'; // 이미 사용 중인 이름
  } else {
    echo 'available'; // 사용 가능한 이름
  }
}
$conn->close();
?>
