<?php
require "manage_header.php";
?>

<?php
$id = "";
$email = "";
$userName = "";
$phoneNumber = "";
$pwd = "";
$mode = "";
if (isset($_GET['id'])) //如果有接收到id值，查詢並列出資料
{
    $id = $_GET['id'];
    $mode = $_GET['mode'];

    require "conn.php";
    $sql = "SELECT * FROM users WHERE id='" . $id . "' ";
    if ($result = mysqli_query($conn, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $email = $row['email'];
        $userName = $row['userName'];
        $phoneNumber = $row['phoneNumber'];
        $pwd = $row['pwd'];
        $mode = "update"; //mode改成update
    }
} else {
    if (isset($_POST['id'])) //修改資料
    {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $userName = $_POST['userName'];
        $phoneNumber = $_POST['phoneNumber'];
        $pwd = $_POST['pwd'];
        $mode = $_POST['mode'];
        if ($mode == "update") //如果mode是update，修改資料
        {
            require "conn.php";
            $sql = "UPDATE users SET userName='$userName',phoneNumber='$phoneNumber',pwd='$pwd' WHERE id='$id' ";
            if ($result = mysqli_query($conn, $sql)) {
                $mode = "browse";
                echo "<script>alert('會員資料修改成功!');</script>";
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
                <h5 class="text-center"><b>修改會員帳號</b></h5>
                <form class="container" onsubmit="return checkForm()" method="post" action="users_manage_detail.php">
                    <!-- id -->
                    <div class="form-group mt-2">
                        <label class="control-label">會員編號：(不可修改)</label>
                        <div class="">
                            <input type="text" id="id" name="id" class="form-control form-text-color text-read" placeholder="會員編號" value="<?= $id ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
                    <!-- email -->
                    <div class="form-group mt-2">
                        <label class="control-label">會員帳號(email)：(不可修改)</label>
                        <div class="">
                            <input type="email" id="email" name="email" class="form-control form-text-color text-read" placeholder="email" value="<?= $email ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
                    <!-- userName -->
                    <div class="form-group mt-2">
                        <label class="control-label">姓名：</label>
                        <div class="">
                            <input type="text" id="userName" name="userName" class="form-control form-text-color" placeholder="姓名" value="<?= $userName ?>" required>
                        </div>
                    </div>
                    <!-- phoneNumber -->
                    <div class="form-group mt-2">
                        <label class="control-label">電話：</label>
                        <div class="">
                            <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-text-color" placeholder="電話" value="<?= $phoneNumber ?>" required>
                        </div>
                    </div>
                    <!-- pwd -->
                    <div class="form-group mt-2">
                        <label class="control-label">密碼：</label>
                        <div class="">
                            <input type="password" id="pwd" name="pwd" class="form-control form-text-color" placeholder="密碼" value="<?= $pwd ?>" required>
                        </div>
                        <!-- 加入一個隱藏的mode值一起送出 -->
                        <input type="hidden" name="mode" value="<?= $mode ?>">
                    </div>
                    <!-- pwd confirm -->
                    <div class="form-group mt-2">
                        <label class="control-label">密碼確認：</label>
                        <div class="">
                            <input type="password" id="pwd2" name="pwd2" class="form-control form-text-color" placeholder="請再次輸入密碼" value="<?= $pwd2 ?>" required>
                        </div>
                    </div>

                    <!-- 错误消息显示区域 -->
                    <div class="wd-color3 mt-2" id="errorMessage"></div>

                    <!-- 確認/離開 -->
                    <div class="form-group mt-3">
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