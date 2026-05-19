<?php
session_start();
if (!isset($_SESSION['uid'])) {
    echo "<script>alert('로그인 후 이용해 주세요.'); location.href='signin.html';</script>";
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
        #pet {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }
        #pet td, #pet th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #pet tr:nth-child(even){background-color: #f2f2f2;}
        #pet tr:hover {background-color: #ddd;}
        #pet th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #b87cb9;
            color: white;
        }
        #pet img {
            width: 120px;
            height: 80px;
        }
        .btn {
            background-color: #b87cb9;
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
<div class="topnav">
        <a href="index.php">
            <img src="images/logo.png" alt="GunnyPet" class="logo">
        </a>

        <div class="nav-links">
                <a href="index.php" title="홈">
                    <p><span class="material-symbols-outlined">home</span></p>
                </a>
                <a href="noticelist.php" title="공지사항">
                    <p><span class="material-symbols-outlined">campaign</span></p>
                </a>
                <a href="showcart.php" title="장바구니">
                    <p><span class="material-symbols-outlined">shopping_cart</span></p>
                </a>
                <a href="showorder.php" title="주문내역">
                    <p><span class="material-symbols-outlined">receipt</span></p>
                </a>
                <a href="signmod.php" title="회원정보수정">
                    <p><span class="material-symbols-outlined">person</span></p>
                </a>
                <a href="signout.php" title="로그아웃">
                    <p><span class="material-symbols-outlined">logout</span></p>
                </a>
        </div>
    </div>

    <?php
        include_once('dbconn.php');

        $email = $_SESSION['uid'];

        $sql = "SELECT * FROM cart WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if(!$result) 
            die("SQL 오류에 따라 실행 종료");
        if($result->num_rows > 0){ 
            $no = 1;
    ?>

    <form action="removecart.php" method="get">
    <table id="pet">
        <h1>쇼핑카트</h1>
        <hr>
        <h1></h1>
        <tr>
            <th></th><th>NO</th> <th>제품명</th> <th>수량</th> <th>가격</th>
        </tr>
        <?php
        while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td><input type="checkbox" name="chk[]" value="<?=$row['name']?>@<?=$row['qty']?>"></td>
            <td><?=$no?></td>
            <td><?=$row['name']?></td>
            <td><?=$row['qty']?></td>
            <td><?=$row['price']?></td>
        </tr>
        <?php $no++; } ?>    
        </table>
        <button type="submit" class="btn">선택삭제</button>
    </form>
    <button class="btn" onclick="location.href='ordernew.php'">주문하기</button>
    <?php
        } else {
            echo "<script>alert('장바구니가 비어있습니다.'); location.href='index.php';</script>";
        }
        $stmt->close();
        $conn->close();
    ?>

</body>
</html>
