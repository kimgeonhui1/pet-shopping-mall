<!DOCTYPE html>
<html>
<head>
    <title>GunnyPet</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <?php
    session_start();
    include_once('dbconn.php');

    $isLogged = false;
    if (isset($_SESSION['uid'])) {
        $isLogged = true;
        if (isset($_SESSION['name'])) {
            $name = $_SESSION['name'];
        }
    }
    ?>
    <div class="topnav">
        <a href="index.php">
            <img src="images/logo.png" alt="GunnyPet" class="logo">
        </a>

        <div class="nav-links">
            <?php if (!$isLogged) { ?>
                <a href="signup.html" title="회원가입">
                    <p><span class="material-symbols-outlined">person_add</span></p>
                </a>
                <a href="signin.html" title="로그인">
                    <p><span class="material-symbols-outlined">login</span></p>
                </a>
            <?php } else { ?>
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
            <?php } ?>
        </div>
    </div>

    <div class="header-logo">
        <img src="images/logo.jpg" alt="GunnyPet">
    </div>

    <div class="carousel" onmouseover="stopSlideShow()" onmouseout="startSlideShow()">
        <button class="carousel-btn left-btn" onclick="prevSlide()">&#60;</button>
        <div class="carousel-images">
            <img src="images/image1.jpg" alt="Image 1" class="carousel-image">
            <img src="images/image2.jpg" alt="Image 2" class="carousel-image">
            <img src="images/image3.jpg" alt="Image 3" class="carousel-image">
            <img src="images/image4.jpg" alt="Image 4" class="carousel-image">
        </div>
        <button class="carousel-btn right-btn" onclick="nextSlide()">&#62;</button>
    </div>

    <div class="categories">
        <button class="category-btn" data-type="feed">
            <img src="images/icons/feed.jpg" alt="사료">
            <span>사료</span>
        </button>
        <button class="category-btn" data-type="snake">
            <img src="images/icons/snake.jpg" alt="간식">
            <span>간식</span>
        </button>
        <button class="category-btn" data-type="toy">
            <img src="images/icons/toy.jpg" alt="장난감">
            <span>장난감</span>
        </button>
        <button class="category-btn" data-type="pad">
            <img src="images/icons/pad.jpg" alt="위생/배변">
            <span>위생/배변</span>
        </button>
    </div>

    <div class="product-sections">
        <h2>가성비 상품</h2>
        <hr>
        <div class="product-list" id="value-products">
            <?php
            $sql = "SELECT * FROM all_product WHERE price <= 25000";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product-item" data-type="<?= $row['type'] ?>">
                <a href="addcart.php?name=<?= $row['name'] ?>&price=<?= $row['price'] ?>&logged=<?= $isLogged ?>">
                    <img src="images/<?= $row['photo'] ?>" alt="<?= $row['name'] ?>">
                </a>
                <h3><?= $row['name'] ?></h3>
                <p>가격: <?= $row['price'] ?>원</p>
            </div>        
            <?php
                }
            }
            ?>
        </div>

        <h2 id="feed">사료</h2>
        <hr>
        <div class="product-list" id="feed-products">
            <?php
            $sql = "SELECT * FROM all_product WHERE type='feed'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product-item">
                <a href="addcart.php?name=<?= $row['name'] ?>&price=<?= $row['price'] ?>&logged=<?= $isLogged ?>">
                    <img src="images/<?= $row['photo'] ?>" alt="<?= $row['name'] ?>">
                </a>
                <h3><?= $row['name'] ?></h3>
                <p>가격: <?= $row['price'] ?>원</p>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <h2 id="snake">간식</h2>
        <hr>
        <div class="product-list" id="snake-products">
            <?php
            $sql = "SELECT * FROM all_product WHERE type='snake'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product-item">
                <a href="addcart.php?name=<?= $row['name'] ?>&price=<?= $row['price'] ?>&logged=<?= $isLogged ?>">
                    <img src="images/<?= $row['photo'] ?>" alt="<?= $row['name'] ?>">
                </a>
                <h3><?= $row['name'] ?></h3>
                <p>가격: <?= $row['price'] ?>원</p>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <h2 id="toy">장난감</h2>
        <hr>
        <div class="product-list" id="toy-products">
            <?php
            $sql = "SELECT * FROM all_product WHERE type='toy'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product-item">
                <a href="addcart.php?name=<?= $row['name'] ?>&price=<?= $row['price'] ?>&logged=<?= $isLogged ?>">
                    <img src="images/<?= $row['photo'] ?>" alt="<?= $row['name'] ?>">
                </a>
                <h3><?= $row['name'] ?></h3>
                <p>가격: <?= $row['price'] ?>원</p>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <h2 id="pad">위생/배변</h2>
        <hr>
        <div class="product-list" id="pad-products">
            <?php
            $sql = "SELECT * FROM all_product WHERE type='pad'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product-item">
                <a href="addcart.php?name=<?= $row['name'] ?>&price=<?= $row['price'] ?>&logged=<?= $isLogged ?>">
                    <img src="images/<?= $row['photo'] ?>" alt="<?= $row['name'] ?>">
                </a>
                <h3><?= $row['name'] ?></h3>
                <p>가격: <?= $row['price'] ?>원</p>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <?php
    $conn->close();
    ?>
</body>
</html>
