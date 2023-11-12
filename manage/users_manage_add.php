<?php
require "manage_header.php";
?>

<?php
$email = "";
$userName = "";
$phoneNumber = "";
$pwd = "";
$pwd2 = "";
//如果有接收到email值
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $userName = $_POST['userName'];
    $phoneNumber = $_POST['phoneNumber'];
    $pwd = $_POST['pwd'];
    //$mode = $_POST['mode'];
    if ($email == "") //如果email未輸入值
    {
        echo "<script>alert('請輸入email');</script>";
    } else {
        require "conn.php";
        $sql = "SELECT * FROM users where email='" . $email . "'"; // 指定SQL查詢字串
        if (mysqli_num_rows(mysqli_query($conn, $sql)) != 0) {
            echo "<script> alert('會員帳號已存在');</script>";
        } else {
            $sql = "INSERT INTO users(email,userName,phoneNumber,pwd) VALUE('$email','$userName','$phoneNumber','$pwd') ";
            if ($result = mysqli_query($conn, $sql)) {
                $mode = "browse";
                echo "<script>alert ('新增會員成功!');</script>";
            } else {
                echo "<script>alert ('新增失敗，請輸入正確資料');</script>";
            }
        }
    }
}
?>

<!-- form -->
<div class="container form-title">
    <div class="mt-5">
        <div class="d-flex flex-nowrap wd-color3 mt-5 ms-4">
            <i class="fa-solid fa-user-check fa-2x pe-3"></i>
            <h4 class="pt-1"><b>粼粼．會員管理系統</b></h4><br />
        </div>
        <div class="container wd-color mt-3">
            <div class="container col-12 col-md-10 col-lg-8 py-5 px-4">
                <h5 class="text-center"><b>新增會員帳號</b></h5>
                <form class="container" onsubmit="return checkForm()" method="post" action="users_manage_add.php">
                    <!-- email -->
                    <div class="form-group mt-3">
                        <label class="control-label">會員帳號(email)：</label>
                        <div class="">
                            <input type="email" id="email" name="email" class="form-control form-text-color" placeholder="請輸入email" value="<?= $email ?>" required>
                        </div>
                    </div>
                    <!-- userName -->
                    <div class="form-group mt-3">
                        <label class="control-label">姓名：</label>
                        <div class="">
                            <input type="text" id="userName" name="userName" class="form-control form-text-color" placeholder="請輸入您的姓名" value="<?= $userName ?>" required>
                        </div>
                    </div>
                    <!-- phoneNumber -->
                    <div class="form-group mt-3">
                        <label class="control-label">電話：</label>
                        <div class="">
                            <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-text-color" placeholder="請輸入您的電話" value="<?= $phoneNumber ?>">
                        </div>
                    </div>
                    <!-- pwd -->
                    <div class="form-group mt-3">
                        <label class="control-label">密碼：</label>
                        <div class="">
                            <input type="password" id="pwd" name="pwd" class="form-control form-text-color" placeholder="請輸入您的密碼" value="<?= $pwd ?>" required>
                            <!-- 加入一個隱藏的mode值一起送出 -->
                            <input type="hidden" name="mode" value="<?= $mode ?>">
                        </div>
                    </div>
                    <!-- pwd confirm -->
                    <div class="form-group mt-3">
                        <label class="control-label">密碼確認：</label>
                        <div class="">
                            <input type="password" id="pwd2" name="pwd2" class="form-control form-text-color" placeholder="請再次輸入密碼" value="<?= $pwd2 ?>" required>
                        </div>
                    </div>

                    <!-- 错误消息显示区域 -->
                    <div class="wd-color3 mt-3" id="errorMessage"></div>

                    <!-- 確認/離開 -->
                    <div class="form-group mt-4">
                        <div class="d-flex justify-content-end">
                            <!-- 按離開回到users_manage.php -->
                            <a href="users_manage.php">
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