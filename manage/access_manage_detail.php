<?php
require "manage_header.php";
?>

<?php
$id = "";
$access = "";
$mode = "";
if (isset($_GET['id'])) //如果有接收到id值，查詢並列出資料
{
    $id = $_GET['id'];
    $mode = $_GET['mode'];

    require "conn.php";
    $sql = "SELECT * FROM access WHERE id='" . $id . "' ";
    if ($result = mysqli_query($conn, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $access = $row['access'];
        $mode = "update"; //mode改成update
    }
} else {
    if (isset($_POST['id'])) //修改資料
    {
        $id = $_POST['id'];
        $access = $_POST['access'];
        $mode = $_POST['mode'];
        if ($mode == "update") //如果mode是update，修改資料
        {
            require "conn.php";
            $sql = "UPDATE access SET access='$access' WHERE id='$id' ";
            if ($result = mysqli_query($conn, $sql)) {
                $mode = "browse";
                echo "<script>alert('交通資料修改成功!');</script>";
            }
        }
    }
}
?>

<!-- form -->
<div class="container form-title">
    <div class="mt-5">
        <div class="d-flex flex-nowrap wd-color2 mt-5 ms-4">
            <i class="fa-solid fa-car-rear fa-2x pe-3"></i>
            <h4 class="pt-1"><b>粼粼．交通管理系統</b></h4><br />
        </div>
        <div class="container wd-color mt-3">
            <div class="container col-12 col-md-10 col-lg-8 py-5 px-4">
                <h5 class="text-center"><b>修改交通資訊</b></h5>
                <form class="container" method="post" action="access_manage_detail.php">
                    <!-- id -->
                    <div class="form-group mt-3">
                        <label class="control-label">交通編號：</label>
                        <div class="">
                            <input type="text" id="id" name="id" class="form-control form-text-color text-read" placeholder="會員編號" value="<?= $id ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
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