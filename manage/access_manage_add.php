<?php
require "manage_header.php";
?>

<?php
$access = "";
//如果有接收到access值
if (isset($_POST['access'])) {
    $access = $_POST['access'];
    //$mode = $_POST['mode'];
    if ($access == "") //如果access未輸入值
    {
        echo "<script>alert('請輸入交通資訊');</script>";
    } else {
        require "conn.php";
        $sql = "SELECT * FROM access where access='" . $access . "'"; // 指定SQL查詢字串
        if (mysqli_num_rows(mysqli_query($conn, $sql)) != 0) {
            echo "<script> alert('交通資訊已存在');</script>";
        } else {
            $sql = "INSERT INTO access(access) VALUE('$access') ";
            if ($result = mysqli_query($conn, $sql)) {
                $mode = "browse";
                echo "<script>alert ('新增交通資訊成功!');</script>";
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
            <i class="fa-solid fa-car-rear fa-2x pe-3"></i>
            <h4 class="pt-1"><b>粼粼．交通管理系統</b></h4><br />
        </div>
        <div class="container wd-color mt-3">
            <div class="container col-12 col-md-10 col-lg-8 py-5 px-4">
                <h5 class="text-center"><b>新增交通資訊</b></h5>
                <form class="container" method="post" action="access_manage_add.php">
                    <!-- access -->
                    <div class="form-group mt-3">
                        <label class="control-label">交通資訊：</label>
                        <div class="">
                            <textarea id="access" name="access" cols="30" rows="10" placeholder="交通資訊" required class="form-text-color"><?= $access ?></textarea>
                        </div>
                        <!-- 加入一個隱藏的mode值一起送出 -->
                        <input type="hidden" name="mode" value="<?= $mode ?>">
                    </div>

                    <!-- 確認/離開 -->
                    <div class="form-group mt-3">
                        <div class="d-flex justify-content-end">
                            <!-- 按離開回到access_manage.php -->
                            <a href="access_manage.php">
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