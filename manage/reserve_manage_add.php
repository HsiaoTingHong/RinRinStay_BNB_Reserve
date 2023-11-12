<?php
require "manage_header.php";
?>

<?php
$checkInDate = "";
$checkOutDate = "";
$adultCount = "";
$kidCount = "";
$roomType = "";
$email = "";
//如果有接收到email值
if (isset($_POST['email'])) {
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $adultCount = $_POST['adultCount'];
    $kidCount = $_POST['kidCount'];
    $roomType = $_POST['roomType'];
    $email = $_POST['email'];
    //$mode = $_POST['mode'];
    if ($email == "") //如果email未輸入值
    {
        echo "<script>alert('請輸入email');</script>";
    } else {
        require "conn.php";
        $sql = "INSERT INTO reserve(checkInDate,checkOutDate,adultCount,kidCount,roomType,email) VALUE('$checkInDate','$checkOutDate','$adultCount','$kidCount','$roomType','$email') ";
        if ($result = mysqli_query($conn, $sql)) {
            $mode = "browse";
            echo "<script>alert('訂房成功!');</script>";
        } else {
            echo "<script>alert('訂房失敗，請輸入正確資料');</script>";
        }
    }
}
?>

<!-- form -->
<div class="container form-title">
    <div class="mt-5">
        <div class="d-flex flex-nowrap wd-color3 mt-5 ms-4">
            <i class="fa-solid fa-calendar fa-2x pe-3"></i>
            <h4 class="pt-1"><b>粼粼．訂房管理系統</b></h4><br />
        </div>
        <div class="container wd-color mt-3">
            <div class="container col-12 col-md-10 col-lg-8 py-3 px-4">
                <h5 class="text-center"><b>新增訂房訂單</b></h5>
                <form class="container" method="post" action="reserve_manage_add.php">
                    <!-- checkInDate -->
                    <div class="form-group">
                        <label class="control-label">入住日期：</label>
                        <div class="">
                            <input type="date" id="checkInDate" name="checkInDate" class="form-control form-text-color" placeholder="入住日期" value="<?= $checkInDate ?>" required>
                        </div>
                    </div>
                    <!-- checkOutDate -->
                    <div class="form-group">
                        <label class="control-label">退房日期：</label>
                        <div class="">
                            <input type="date" id="checkOutDate" name="checkOutDate" class="form-control form-text-color" placeholder="退房日期" value="<?= $checkOutDate ?>" required>
                        </div>
                    </div>
                    <!-- adultCount -->
                    <div class="form-group">
                        <label class="control-label">大人人數：</label>
                        <div class="">
                            <input type="number" id="adultCount" name="adultCount" class="form-control form-text-color" placeholder="請選擇大人人數" value="<?= $adultCount ?>" min="0" max="6">
                        </div>
                    </div>
                    <!-- kidCount -->
                    <div class="form-group">
                        <label class="control-label">小孩人數：</label>
                        <div class="">
                            <input type="number" id="kidCount" name="kidCount" class="form-control form-text-color" placeholder="請選擇小孩人數" value="<?= $kidCount ?>" min="0" max="6">
                        </div>
                    </div>
                    <!-- roomType -->
                    <div class="form-group">
                        <label class="control-label">房型選擇：</label>
                        <div class="">
                            <input type="text" id="roomType" name="roomType" class="form-control form-text-color" placeholder="請選擇房型" value="<?= $roomType ?>">
                        </div>
                    </div>
                    <!-- email -->
                    <div class="form-group">
                        <label class="control-label">e-mail(會員帳號)：</label>
                        <div class="">
                            <!-- HTML屬性 readonly="readonly" : 只能閱讀不能修改 -->
                            <input type="email" id="email" name="email" class="form-control form-text-color" placeholder="請輸入email" value="<?= $email ?>" required>
                            <!-- 加入一個隱藏的mode值一起送出 -->
                            <input type="hidden" name="mode" value="<?= $mode ?>">
                        </div>
                    </div>
                    <!-- 確認/離開 -->
                    <div class="form-group">
                        <div class="d-flex justify-content-end mt-3">
                            <!-- 按離開回到reserve_manage.php -->
                            <a href="reserve_manage.php">
                                <button type="button" class="btn btn-color"><i class="ti-close"></i>離開</button></a>
                            <button type="submit" class="btn btn-color2 ms-2"><i class="ti-check"></i>確認</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require "manage_footer.php";
?>