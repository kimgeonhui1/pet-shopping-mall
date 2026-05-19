<!DOCTYPE html>
<html>
<head>
    <title>GunnyPet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    body, html {
        height: 100%;
        font-family: Arial, Helvetica, sans-serif;
    }
    h1{
        padding-left : 40px;
    }
    * {
        box-sizing: border-box;
    }
    .bg-img {
        background-image: url("images/pizza.jpg");
        min-height: 380px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .container {
        position: relative;
        margin: 20px;
        max-width: 800px;
        padding: 16px;
        background-color: white;
        display: flex;
        flex-wrap: wrap;
    }
    input[type=text], input[type=number] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
    }
    input[type=text]:focus, input[type=number]:focus {
        background-color: #ddd;
        outline: none;
    }
    input[type=radio] {
        margin: 5px 0;
    }
    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }
    .btn:hover {
        opacity: 1;
    }
    .title {
        position: absolute;
        top: 10px;
        left: 40px;
        color: white;
    }
    .image-section, .info-section {
        flex: 1;
        margin: 10px;
    }
    .info-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .info-section input[type=submit] {
        margin-top: 20px;
    }
    .name-section {
        width: 100%;
        margin-bottom: 20px;
    }
    </style>
</head>
<body>
    <?php
    include_once('dbconn.php');

    $logged = $_GET['logged'];
    if(!$logged) {
        echo "<script>alert('로그인을 먼저 해야 장바구니에 담을 수 있습니다.');
                history.go(-1);</script>";
    }

    $name = $_GET['name'];
    $price = $_GET['price'];
    $sql = "SELECT * FROM all_product WHERE name = '$name' AND price = $price";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $photo = $row['photo'];
    ?>
    <h1>장바구니 담기</h1>
    <hr>
    <div class="container">
        <div class="name-section">
            <h2><?= $name ?></h2>
        </div>
        <div class="image-section">
            <img src="images/<?= $photo ?>" alt="<?= $name ?>" style="width: 100%;">
        </div>
        <div class="info-section">
            <form action="addcartproc.php" method="post">
                <input type="hidden" name="name" value="<?= $name ?>" readonly>
                <div>
                    <label for="price">가격</label>
                    <input type="text" name="price" value="<?= $price ?>" readonly>
                </div>
                <div>
                    <label for="qty">수량</label>
                    <input type="number" name="qty" value="1" min="1" max="20">
                </div>
                <input type="submit" value="담기" class="btn">
            </form>
        </div>
    </div>
</body>
</html>
