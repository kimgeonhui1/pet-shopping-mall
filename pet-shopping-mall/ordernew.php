<!DOCTYPE html>
<html>
<head>
    <title>GunnyPet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    * {
        box-sizing: border-box;
    }
    body {
        width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    input[type=text], input[type=password], select, textarea {
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
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
		margin-top: 10px;
        float: right;
    }
    input[type=submit]:hover {
        background-color: #45a049;
    }
	input[readonly] {
		background-color: #ccc;
	}
    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
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
    </style>
    </head>
    <body>
        <?php
        session_start();  
        include_once('dbconn.php');
        if(!isset($_SESSION['name'])) {
          echo "<script>alert('로그인을 해야합니다.');
                location.href='signin.html';</script>";
          exit();
        }
        $name = $_SESSION['name'];
        $email = $_SESSION['uid'];

        $ordno = date("Y").date("m").date("d"); 
        $sql = "select max(ordno) from porder";
        $result = $conn->query($sql);
        if(!$result) { 
          $no = 1;
          $ordno = $ordno."-".$no;  
        } else {
          $row = $result->fetch_row();
          $ymd = substr($row[0], 0, strpos($row[0],'-'));
          if($ymd == $ordno) {  
            $no = substr($row[0], strpos($row[0],'-')+1, 2);
            $no++;
            $ordno = $ordno."-".$no;
          } else {
            $no = 1;
            $ordno = $ordno."-".$no;
          }
        }
        $sql = "select sum(price) from cart where email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_row(); 
        $amount = $row[0];
        
        $sql = "select point from member where email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $point = $row[0];
        ?>

        <h2>상품 주문</h2>
        <hr>
        <div class="container">
          <form action="ordernewproc.php" method="post">
            <div class="row">
              <div class="col-25">
                <label for="fname">주문자</label>
              </div>
              <div class="col-75">
                <input type="text" name="name" value="<?=$name?>" readonly>
				<input type="text" name="email" value="<?=$email?>" hidden>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="fname">주문번호</label>
              </div>
              <div class="col-75">
                <input type="text" name="ordno" value="<?=$ordno?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="fname">배달주소</label>
              </div>
              <div class="col-75">
                <input type="text" name="address" placeholder="Address..">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="fname">주문금액</label>
              </div>
              <div class="col-75">
                <input type="text" name="amount" value="<?=$amount?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="fname">배달료</label>
              </div>
              <div class="col-75">
                <input type="text" name="delamt" value="3000" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="fname">포인트 사용</label>
              </div>
              <div class="col-75">
                <input type="text" name="usepoint" placeholder="고객님의 남은 포인트는 <?=$point?> 포인트 입니다">
              </div>
            </div>
	        <div class="row">
              <input type="submit" value="주문하기">
          </div>
	</form>
	</div>
	</body>
</html>
