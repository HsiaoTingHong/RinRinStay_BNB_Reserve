<?php
require "member_header.php";
?>

<?php
$id = "";
$reserveDate = "";
$checkInDate = "";
$checkOutDate = "";
$adultCount = "";
$kidCount = "";
$roomType = "";
$email = "";
$mode = "";
if (isset($_GET['id'])) //如果有接收到id值，查詢並列出資料
{
    $id = $_GET['id'];
    $mode = $_GET['mode'];

    require "../manage/conn.php";
    $sql = "SELECT * FROM reserve WHERE id='" . $id . "' ";
    if ($result = mysqli_query($conn, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $reserveDate = $row['reserveDate'];
        $checkInDate = $row['checkInDate'];
        $checkOutDate = $row['checkOutDate'];
        $adultCount = $row['adultCount'];
        $kidCount = $row['kidCount'];
        $roomType = $row['roomType'];
        $email = $row['email'];
        $mode = "update"; //mode改成update
    }
} else {
    if (isset($_POST['id'])) //修改資料
    {
        $id = $_POST['id'];
        $reserveDate = $_POST['reserveDate'];
        $checkInDate = $_POST['checkInDate'];
        $checkOutDate = $_POST['checkOutDate'];
        $adultCount = $_POST['adultCount'];
        $kidCount = $_POST['kidCount'];
        $roomType = $_POST['roomType'];
        $email = $_POST['email'];
        $mode = $_POST['mode'];
        if ($mode == "update") //如果mode是update，修改資料
        {
            require "../manage/conn.php";
            $sql = "UPDATE reserve SET checkInDate='$checkInDate',checkOutDate='$checkOutDate',adultCount='$adultCount',kidCount='$kidCount',roomType='$roomType' WHERE id='$id' ";
            if ($result = mysqli_query($conn, $sql)) {
                $mode = "browse";
                echo "<script>alert('訂房修改成功!');</script>";
            }
        }
    }
}
?>

<!-- form -->
<div class="container form-title">
    <div class="mt-5">
        <div class="d-flex flex-nowrap wd-color3 mt-5 ms-4">
            <i class="fa-solid fa-calendar-check fa-2x pe-3"></i>
            <h4 class="pt-1"><b>粼粼．您的訂單詳細</b></h4><br />
        </div>
        <div class="container wd-color mt-3">
            <div class="container col-12 col-md-10 col-lg-8 px-4">
                <h5 class="text-center"><b>您的訂單詳細</b></h5>
                <form class="container" method="post" action="member_reserve_detail.php">
                    <!-- id -->
                    <div class="form-group">
                        <label class="control-label">訂單編號：</label>
                        <div class="">
                            <input type="text" id="id" name="id" class="form-control form-text-color text-read" placeholder="訂單編號" value="<?= $id ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
                    <!-- reserveDate -->
                    <div class="form-group">
                        <label class="control-label">訂單日期：</label>
                        <div class="">
                            <input type="text" id="reserveDate" name="reserveDate" class="form-control form-text-color text-read" placeholder="訂單日期" value="<?= $reserveDate ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
                    <!-- checkInDate -->
                    <div class="form-group">
                        <label class="control-label">入住日期：</label>
                        <div class="">
                            <input type="date" id="checkInDate" name="checkInDate" class="form-control form-text-color text-read" placeholder="入住日期" value="<?= $checkInDate ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?> required>
                        </div>
                    </div>
                    <!-- checkOutDate -->
                    <div class="form-group">
                        <label class="control-label">退房日期：</label>
                        <div class="">
                            <input type="date" id="checkOutDate" name="checkOutDate" class="form-control form-text-color text-read" placeholder="退房日期" value="<?= $checkOutDate ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?> required>
                        </div>
                    </div>
                    <!-- adultCount -->
                    <div class="form-group">
                        <label class="control-label">大人人數：</label>
                        <div class="">
                            <input type="text" id="adultCount" name="adultCount" class="form-control form-text-color text-read" placeholder="大人人數" value="<?= $adultCount ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
                    <!-- kidCount -->
                    <div class="form-group">
                        <label class="control-label">小孩人數：</label>
                        <div class="">
                            <input type="text" id="kidCount" name="kidCount" class="form-control form-text-color text-read" placeholder="小孩人數" value="<?= $kidCount ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
                    <!-- roomType -->
                    <div class="form-group">
                        <label class="control-label">房型選擇：</label>
                        <div class="">
                            <input type="text" id="roomType" name="roomType" class="form-control form-text-color text-read" placeholder="小孩人數" value="<?= $roomType ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
                    <!-- email -->
                    <div class="form-group">
                        <label class="control-label">e-mail(會員帳號)：</label>
                        <div class="">
                            <!-- HTML屬性 readonly="readonly" : 只能閱讀不能修改 -->
                            <input type="text" id="email" name="email" class="form-control form-text-color text-read" placeholder="email" value="<?= $email ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?> required>
                            <!-- 加入一個隱藏的mode值一起送出 -->
                            <input type="hidden" name="mode" value="<?= $mode ?>">
                        </div>
                    </div>
                    <!-- 確認/離開 -->
                    <div class="form-group mt-3">
                        <div class="d-flex justify-content-end">
                            <!-- 按離開回到member_reserve.php -->
                            <a href="member_reserve.php">
                                <button type="button" class="btn btn-color2"><i class="ti-close"></i>離開</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require "member_footer.php";
?>