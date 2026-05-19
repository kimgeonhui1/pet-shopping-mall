<!DOCTYPE html>
<html>
<head>
    <title>회원정보수정</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="scripts.js" defer></script>
    <style>
      * {
        box-sizing: border-box;
      }
      body {
        width: 600px;
        margin-left: auto;
        margin-right: auto;
      }
      input[type="text"],
      input[type="password"],
      select,
      textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
      }
      label {
        padding: 12px 12px 12px 0;
        display: inline-block;
      }
      input[type="submit"] {
        background-color: #b87cb9;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
        float: right;
      }
      input[type="submit"]:hover {
        background-color: #45a049;
      }
      .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        margin-top: 30px;
      }
      .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
      }
      .col-75 {
        float: left;
        width: 75%;
        margin-top: 6px;
      }
      .row:after {
        content: "";
        display: table;
        clear: both;
      }
      .topnav {
        display: flex;
        background-color: #b87cb9;
        overflow: hidden;
        justify-content: space-between;
        align-items: center; 
        top: 0; 
        width: 600px; 
        z-index: 1000; 
      }
      .topnav a {
          color: #f2f2f2;
          text-align: center;
          text-decoration: none;
          font-size: 17px;
      }
      .topnav a:hover {
          background-color: #ddd;
          color: black;
      }
      .topnav a.active {
           background-color: #4CAF50;
           color: white;
      }
      .topnav .logo {
          height: 50px;
          margin: 5px 20px;
          background-color: transparent;
      }
      .header-logo {
          margin: 20px 0;
      }
      .header-logo img {
          height: 150px;
      }
    </style>
</head>
<body>
<div class="topnav">
    <a href="index.php">
        <img src="images/logo.png" alt="GunnyPet" class="logo">
    </a>
</div>
<?php
session_start();
$email = $_SESSION['uid'];
include_once("dbconn.php");

$sql = "select * from member where email = '$email'";
$result = $conn->query($sql);
if($result->num_rows > 0) {  
    $row = $result->fetch_assoc();
?>
<h2>회원정보수정</h2>
<hr>
<div class="container">
  <form action="signmodproc.php" method="post">
    <div class="row">
      <div class="col-25">
        <label for="fname">이메일</label>
      </div>
      <div class="col-75">
        <input type="text" name="email" id="email" value="<?=$row['email']?>" readonly>
        <button type="button" id="chkNameBtn" onclick="checkEmail()">중복확인</button>

      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="uname">이름</label>
      </div>
      <div class="col-75">
        <input type="text" name="uname" id="uname" value="<?=$row['name']?>" />
        <button type="button" id="chkNameBtn" onclick="checkName()">중복확인</button>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="pwd">비밀번호</label>
      </div>
      <div class="col-75">
        <input type="password" name="pwd" value="<?=$row['pwd']?>"/>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="telno">전화번호</label>
      </div>
      <div class="col-75">
        <input type="text" name="telno" value="<?=$row['telno']?>"/>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit" />
    </div>
  </form>
</div>
<?php } ?>
</body>
</html>
