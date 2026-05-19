<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>GunnyPet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            text-align: center;
        }
        #orderitem {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }
        #orderitem td, #orderitem th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #orderitem tr:nth-child(even){background-color: #f2f2f2;}
        #orderitem tr:hover {background-color: #ddd;}
        #orderitem th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #b87cb9;
            color: white;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 70%;
            opacity: 0.9;
            margin-top: 10px;
        }
        .btn:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <?php
    include_once('dbconn.php');
    if (!isset($_SESSION['uid'])) {
        echo "<script>alert('로그인을 해야합니다.');
              location.href='signin.html';</script>";
        exit();
    }
    if (!isset($_GET['ordno'])) {
        die("주문 번호가 지정되지 않았습니다.");
    }

    $ordno = $_GET['ordno'];
    $sql = "SELECT * FROM orditem WHERE ordno = '$ordno'";
    $result = $conn->query($sql);
    if (!$result) {
        die("SQL 오류에 따라 실행 종료!!");
    }
    if ($result->num_rows > 0) {
        $no = 1;
    ?>
    <h1>주문상세내역</h1>
    <table id="orderitem">
        <tr>
            <th>NO</th>
            <th>제품명</th>
            <th>수량</th>
            <th>가격</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?=$no?></td>
            <td><?=$row['productname']?></td>
            <td><?=$row['qty']?></td>
            <td><?=$row['price']?></td>
        </tr>
        <?php $no++; } ?>
    </table>
    <?php
    } else {
        echo "<p>주문 상세 내역이 없습니다.</p>";
    }
    $conn->close();
    ?>
</body>
</html>
