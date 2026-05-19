<?php
session_start();
if (!isset($_SESSION['uid'])) {
    echo "<script>alert('로그인을 해야합니다.'); location.href='signin.html';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>GunnyPet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            text-align: center;
        }
        #order {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
            margin-top : 30px;
        }
        #order td, #order th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #order tr:nth-child(even){background-color: #f2f2f2;}
        #order tr:hover {background-color: #ddd;}
        #order th {
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
    $email = $_SESSION['uid'];
    if (isset($_GET['sdate'])) {
        $sdate = $_GET['sdate'];
        $edate = $_GET['edate'];
        $sql = "SELECT * FROM porder WHERE email = ? AND orddate BETWEEN ? AND ? ORDER BY orddate DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $sdate, $edate);
    } else {
        $sql = "SELECT * FROM porder WHERE email = ? ORDER BY orddate DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) { 
        $no = 1;
    ?>
    <h1>주문내역</h1>
    <hr>
    <table id="order">
        <tr>
            <th>NO</th>
            <th>주문번호</th>
            <th>주문일자</th>
            <th>배송지</th>
            <th>주문금액</th>
            <th>배송비</th>
            <th>사용한 포인트</th>
            <th>결제금액</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?=$no?></td>
            <td><a href='showorderitem.php?ordno=<?=$row['ordno']?>'><?=$row['ordno']?></a></td>
            <td><?=$row['orddate']?></td>
            <td><?=$row['address']?></td>
            <td><?=$row['amount']?></td>
            <td><?=$row['delamt']?></td>
            <td><?=$row['usepoint']?></td>
            <td><?=$row['total']?></td>
        </tr>
        <?php $no++; } ?>
    </table>
    <?php
    } else {
        echo "<p>주문 내역이 없습니다.</p>";
    }
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
