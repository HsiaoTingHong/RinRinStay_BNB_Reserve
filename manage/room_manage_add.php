<?php
require "manage_header.php";
?>

<?php
$roomType = "";
$roomName = "";
$price = "";
$info = "";
$photo = "";
//如果有接收到roomType值
if (isset($_POST['roomType'])) {
    $roomType = $_POST['roomType'];
    $roomName = $_POST['roomName'];
    $price = $_POST['price'];
    $info = $_POST['info'];
    $photo = $_POST['photo'];
    //$mode = $_POST['mode'];
    if ($roomType == "") //如果roomType未輸入值
    {
        echo "<script>alert('請輸入房型代號');</script>";
    } else {
        require "conn.php";
        $sql = "SELECT * FROM room where roomType='" . $roomType . "'"; // 指定SQL查詢字串
        if (mysqli_num_rows(mysqli_query($conn, $sql)) != 0) {
            echo "<script> alert('房型資料已存在');</script>";
        } else {
            $sql = "INSERT INTO room(roomType,roomName,price,info,photo) VALUE('$roomType','$roomName','$price','$info','$photo') ";
            if ($result = mysqli_query($conn, $sql)) {
                $mode = "browse";
                echo "<script>alert('房型資料新增成功!');</script>";
            } else {
                echo "<script>alert('新增失敗，請輸入正確資料');</script>";
            }
        }
    }
}
?>

<!-- form -->
<div class="container form-title">
    <div class="mt-5">
        <div class="d-flex flex-nowrap wd-color3 mt-5 ms-4">
            <i class="fa-solid fa-bed fa-2x pe-3"></i>
            <h4 class="pt-1"><b>粼粼．房型管理系統</b></h4><br />
        </div>
        <div class="container wd-color mt-3">
            <div class="container col-12 col-md-10 col-lg-8 py-3 px-4">
                <h5 class="text-center"><b>新增房型資料</b></h5>
                <form class="container" method="post" action="room_manage_add.php">
                    <!-- roomType -->
                    <div class="form-group mt-3">
                        <label class="control-label">房型代號：</label>
                        <div class="">
                            <input type="text" id="roomType" name="roomType" class="form-control form-text-color" placeholder="房型代號" value="<?= $roomType ?>" required>
                        </div>
                    </div>
                    <!-- roomName -->
                    <div class="form-group mt-3">
                        <label class="control-label">房型名稱：</label>
                        <div class="">
                            <input type="text" id="roomName" name="roomName" class="form-control form-text-color" placeholder="房型名稱" value="<?= $roomName ?>" required>
                        </div>
                    </div>
                    <!-- price -->
                    <div class="form-group mt-3">
                        <label class="control-label">價格：</label>
                        <div class="">
                            <input type="text" id="price" name="price" class="form-control form-text-color" placeholder="價格" value="<?= $price ?>" required>
                        </div>
                    </div>
                    <!-- info -->
                    <div class="form-group mt-3">
                        <label class="control-label">房型介紹：</label>
                        <div class="">
                            <input type="text" id="info" name="info" class="form-control form-text-color" placeholder="房型介紹" value="<?= $info ?>">
                        </div>
                    </div>
                    <!-- photo -->
                    <div class="form-group mt-3">
                        <label class="control-label">房型照片：</label>
                        <div class="">
                            <input type="text" id="photo" name="photo" class="form-control form-text-color" placeholder="房型照片" value="<?= $photo ?>">
                            <!-- 加入一個隱藏的mode值一起送出 -->
                            <input type="hidden" name="mode" value="<?= $mode ?>">
                        </div>
                    </div>
                    <!-- 確認/離開 -->
                    <div class="form-group mt-4">
                        <div class="d-flex justify-content-end">
                            <!-- 按離開回到room_manage.php -->
                            <a href="room_manage.php">
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