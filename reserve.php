<?php
session_start();
if (!isset($_SESSION['sAccount']))
    header('Location: member/member_login.php');
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 粼粼reserve-新增訂單OK -->
    <title>粼粼-馬上預約</title>

    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- BNB專案CSS -->
    <link rel="stylesheet" href="css/BNB_project_font.css">
    <link rel="stylesheet" href="css/BNB_project_reserve.css">
    <!-- favicon小圖示 -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
    <link rel="manifest" href="images/favicon/site.webmanifest">
    <script>
        // CI必須大於今天
        function checkDate() {
            var checkInDateInput = document.getElementById("checkInDate");
            var checkOutDateInput = document.getElementById("checkOutDate");

            var checkInDate = new Date(checkInDateInput.value);
            var checkOutDate = new Date(checkOutDateInput.value);
            var today = new Date();

            if (checkInDate < today) {
                alert("入住日期必须從今天開始");
                return false; // 阻擋表單
            }

            // 送出表單
            return true;

        }
    </script>

</head>

<body>
    <?php
    //查詢空房
    $checkInDate = "";
    $checkOutDate = "";
    $roomType = "";
    if (isset($_POST['checkInDate'])) {
        $checkInDate = $_POST['checkInDate'];
        $checkOutDate = $_POST['checkOutDate'];
        date_default_timezone_set('Asia/Taipei');
        $today = date("Y/m/d");
        if ($checkInDate == "") //如果checkInDate未輸入值
        {
            echo "<script>alert('請選擇入住日期');</script>";
        }
        if ($checkInDate >= $checkOutDate) //如果checkInDate>=checkOutDate
        {
            echo "<script>alert('退房日期必须大於入住日期');</script>";
        } else {
            $_SESSION['sCheckInDate'] = $checkInDate;
            $_SESSION['sCheckOutDate'] = $checkOutDate;
            require "manage/conn.php";

            $sql = "SELECT a.roomType
                    FROM room AS a
                    LEFT JOIN reserve AS b
                    ON a.roomType = b.roomType
                    AND (
                        (b.checkInDate < '" . $_SESSION['sCheckOutDate'] . "' AND b.checkOutDate > '" . $_SESSION['sCheckInDate'] . "')
                        OR (b.checkInDate >= '" . $_SESSION['sCheckInDate'] . "' AND b.checkOutDate <= '" . $_SESSION['sCheckOutDate'] . "')
                        )
                    WHERE b.roomType IS NULL";

            $options = "";
            if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $options .= "<option value='" . $row['roomType'] . "'>" . $row['roomType'] . "</option>";
                }
            }
            mysqli_close($conn); // 關閉資料庫連結
        }
    }
    ?>

    <!-- 訂房確認頁面-深色背景 -->
    <section class="container reserve-bg-out">
        <div class="container reserve-bg-in">

            <!-- logo -->
            <div class="container col-md-11 mb-2">
                <div class="row align-items-center">
                    <div class="col-2">
                        <a href="index.html"><i class="fa-solid fa-circle-arrow-left fa-2x back-home-icon"></i></a>
                    </div>
                    <div class="col-8 text-center reserve-logo">
                        <img src="images/logo003.png" alt="logo">
                    </div>
                    <div class="col-2 text-end wd-color4 pt-3">
                        <p>馬上預約</p>
                    </div>
                </div>
            </div>

            <!-- 表單區-淺色背景 -->
            <div class="container col-md-11 bg-circle2 reserve-bg text-nowrap send-out">

                <!-- 選單 -->
                <form onsubmit="checkDate()" method="post" action="reserve.php">
                    <div class="container">
                        <div class="row text-center pt-4">
                            <!-- 入住日期 -->
                            <div class="col-3 col-md-2 reserve-wd pt-2">
                                <p><b>入住日期：</b></p>
                            </div>
                            <div class="col-7 col-md-3">
                                <input class="form-control text-center form-text-color" type="date" id="checkInDate" name="checkInDate" value="<?= $checkInDate ?>" aria-label="default input example" required>
                            </div>
                            <!-- 退房日期 -->
                            <div class="col-3 col-md-2 reserve-wd pt-2">
                                <p><b>退房日期：</b></p>
                            </div>
                            <div class="col-7 col-md-3">
                                <input class="form-control text-center form-text-color" type="date" id="checkOutDate" name="checkOutDate" value="<?= $checkOutDate ?>" aria-label="default input example" required>
                            </div>
                            <div class="col-2 col-md-2">
                                <button type="submit" class="btn btn-color reserve-wd"><b>搜尋</b></button>
                            </div>
                        </div>
                        <div class="row text-center">
                            <!-- e-mail -->
                            <div class="col-3 col-md-2 reserve-wd pt-2">
                                <p><b>會員帳號：</b></p>
                            </div>
                            <div class="col-9 col-md-3">
                                <input class="form-control text-center form-text-color" type="email" id="email" name="email" value="<?= $_SESSION['sAccount'] ?>" placeholder="*必填" aria-label="default input example" readonly>
                            </div>

                            <!-- 預約房型 -->
                            <div class="col-3 col-md-2 reserve-wd pt-2">
                                <p><b>空房房型：</b></p>
                            </div>
                            <div class="col-9 col-md-3">
                                <select class="form-select form-text-color" id="roomType" name="roomType" value="<?= $roomType ?>" aria-label="Default select example">
                                    <?php echo $options ?>
                                </select>
                            </div>

                        </div>

                    </div>

                    <!-- 照片區 -->
                    <div class="container">
                        <div class="row text-center bg-pic-down">

                            <!-- 二人房 -->
                            <div class="container col-10 col-sm-8 col-md-8 col-lg-4">
                                <div class="row justify-content-center align-items-center py-1">
                                    <div class="col-8 bg-cover bg-pic" style="background-image: url(images/room001.jpg);">
                                    </div>
                                    <div class="col-3">
                                        <p class="reserve-wd reserve-wd-color"><b>二人房</b></p>
                                        <p class="reserve-wd reserve-wd-color pt-2"><b>$2000/晚</b></p>
                                        <a href="room.html"><button type="button" class="btn btn-color btn-sm reserve-wd">看詳細</button></a>
                                    </div>
                                </div>
                            </div>

                            <!-- 四人房 -->
                            <div class="container col-10 col-sm-8 col-md-8 col-lg-4 bg-pic-border">
                                <div class="row justify-content-center align-items-center py-1">
                                    <div class="col-8 bg-cover bg-pic" style="background-image: url(images/room002.jpg);">
                                    </div>
                                    <div class="col-3">
                                        <p class="reserve-wd reserve-wd-color"><b>四人房</b></p>
                                        <p class="reserve-wd reserve-wd-color pt-2"><b>$3500/晚</b></p>
                                        <a href="room.html"><button type="button" class="btn btn-color btn-sm reserve-wd">看詳細</button></a>
                                    </div>
                                </div>
                            </div>

                            <!-- 六人房 -->
                            <div class="container col-10 col-sm-8 col-md-8 col-lg-4 bg-pic-border">
                                <div class="row justify-content-center align-items-center py-1">
                                    <div class="col-8 bg-cover bg-pic" style="background-image: url(images/room003.jpg);">
                                    </div>
                                    <div class="col-3">
                                        <p class="reserve-wd reserve-wd-color"><b>六人房</b></p>
                                        <p class="reserve-wd reserve-wd-color pt-2"><b>$5000/晚</b></p>
                                        <a href="room.html"><button type="button" class="btn btn-color btn-sm reserve-wd">看詳細</button></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 送出/取消 -->
                    <div class="container text-end send-in">
                        <!-- 按取消回到index.html -->
                        <a href="index.html"><button type="button" class="btn btn-color reserve-wd me-2" id="cancelBtn" name="cancelBtn"><b>取消</b></button></a>
                        <!-- 送出按鈕 -->
                        <a href="reserve_check.php?mode=update&checkInDate=<?= $checkInDate ?>&checkOutDate=<?= $checkOutDate ?>"><button type="button" class="btn btn-color2 reserve-wd" id="confirmBtn" name="confirmBtn"><b>下一步</b></button></a>
                    </div>
                </form>

            </div>
        </div>
    </section>


    <!-- footer -->
    <section>
        <div class="footer">
            <p><small>Copyright © 2023 粼粼 All Rights Reserved.</small></p>
        </div>
    </section>

    <!-- bootstrap javascript file -->
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.2.3-dist/js/bootstrap.bundle.js"></script>
    <!-- jquery-3.7.0 CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</body>

</html>