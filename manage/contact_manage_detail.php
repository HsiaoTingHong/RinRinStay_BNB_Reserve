<?php
require "manage_header.php";
?>

<?php
$id = "";
$email = "";
$userName = "";
$phoneNumber = "";
$content = "";
$answer = "";
$mode = "";
if (isset($_GET['id'])) //如果有接收到id值，查詢並列出資料
{
    $id = $_GET['id'];
    $mode = $_GET['mode'];

    require "conn.php";
    $sql = "SELECT * FROM contact WHERE id='" . $id . "' ";
    if ($result = mysqli_query($conn, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $email = $row['email'];
        $userName = $row['userName'];
        $phoneNumber = $row['phoneNumber'];
        $content = $row['content'];
        $answer = $row['answer'];
        $mode = "update"; //mode改成update
    }
} else {
    if (isset($_POST['id'])) //修改資料
    {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $userName = $_POST['userName'];
        $phoneNumber = $_POST['phoneNumber'];
        $content = $_POST['content'];
        $answer = $_POST['answer'];
        $mode = $_POST['mode'];
        if ($mode == "update") //如果mode是update，修改資料
        {
            require "conn.php";
            $sql = "UPDATE contact SET answer='$answer' WHERE id='$id' ";
            if ($result = mysqli_query($conn, $sql)) {
                $mode = "browse";
                echo "<script>alert('回覆詢問儲存成功!');</script>";
            }
        }
    }
}
?>

<!-- form -->
<div class="container form-title">
    <div class="mt-5">
        <div class="d-flex flex-nowrap wd-color3 mt-5 ms-4">
            <i class="fa-solid fa-envelope fa-2x pe-3"></i>
            <h4 class="pt-1"><b>粼粼．詢問管理系統</b></h4><br />
        </div>
        <div class="container wd-color mt-3">
            <div class="container col-12 col-md-10 col-lg-8 px-4">
                <h5 class="text-center"><b>回覆詢問事項</b></h5>
                <form class="container" method="post" action="contact_manage_detail.php">
                    <!-- id -->
                    <div class="form-group mt-2">
                        <label class="control-label">詢問編號：</label>
                        <div class="">
                            <input type="text" id="id" name="id" class="form-control form-text-color text-read" placeholder="詢問編號" value="<?= $id ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
                    <!-- email -->
                    <div class="form-group mt-2">
                        <label class="control-label">會員帳號(email)：</label>
                        <div class="">
                            <input type="email" id="email" name="email" class="form-control form-text-color text-read" placeholder="email" value="<?= $email ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?>>
                        </div>
                    </div>
                    <!-- userName -->
                    <div class="form-group mt-2">
                        <label class="control-label">姓名：</label>
                        <div class="">
                            <input type="text" id="userName" name="userName" class="form-control form-text-color text-read" placeholder="姓名" value="<?= $userName ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?> required>
                        </div>
                    </div>
                    <!-- phoneNumber -->
                    <div class="form-group mt-2">
                        <label class="control-label">電話：</label>
                        <div class="">
                            <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-text-color text-read" placeholder="電話" value="<?= $phoneNumber ?>" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?> required>
                        </div>
                    </div>
                    <!-- content -->
                    <div class="form-group mt-2">
                        <label class="control-label">詢問內容：</label>
                        <div class="">
                            <textarea class="form-text-color text-read" id="content" name="content" placeholder="詢問內容" cols="30" rows="2" <?php if ($mode == "update") echo "readonly=\"readonly\""; ?> required><?= $content ?></textarea>
                        </div>
                    </div>
                    <!-- answer -->
                    <div class="form-group mt-2">
                        <label class="control-label">問題回覆：</label>
                        <div class="">
                            <textarea class="form-text-color" id="answer" name="answer" placeholder="問題回覆" cols="30" rows="2" required><?= $answer ?></textarea>
                        </div>
                        <!-- 加入一個隱藏的mode值一起送出 -->
                        <input type="hidden" name="mode" value="<?= $mode ?>">
                    </div>

                    <!-- 確認/離開 -->
                    <div class="form-group mt-2">
                        <div class="d-flex justify-content-end">
                            <!-- 按離開回到contact_manage.php -->
                            <a href="contact_manage.php">
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