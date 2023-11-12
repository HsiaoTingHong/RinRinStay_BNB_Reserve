<?php
session_start();
require '../manage/conn.php';
$varErrmessage = "";
$varErrcaptcha = "";

if (isset($_GET['st'])) { //logout 時會給的變數
    if ($_GET['st'] == "logout") {
        unset($_SESSION['sAccount']);
    }
}

if (isset($_POST['usrAccount'])) { //使用者輸入帳號後，帳號密碼的判斷
    $varAccount = $_POST['usrAccount'];
    $varPassword = $_POST['usrPassword'];
    $sql = "SELECT userName,pwd FROM users where email='$varAccount'"; // 指定SQL查詢字串
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        $varErrmessage = "請輸入正確帳號";
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($varPassword !== $row['pwd']) {
            $varErrmessage = "請輸入正確密碼";
        } else {
            $varErrcaptcha = "請輸入驗證碼";
            if ((!empty($_SESSION['check_captcha'])) && (!empty($_POST['checkText']))) { //判斷兩個變數皆不為空
                if ($_SESSION['check_captcha'] !== $_POST['checkText']) {
                    $varErrcaptcha = "驗證碼不符，請確認大小寫並重新輸入";
                } else {                                //比對全部正確
                    $_SESSION['check_captcha'] = ''; //清空check_captcha值

                    $_SESSION['sAccount'] = $varAccount;
                    $_SESSION['sname'] = $row['userName'];
                    date_default_timezone_set('Asia/Taipei'); // 設定時區為台北時區
                    $_SESSION['sLogintime'] = date("Y/m/d H:i:s");
                    $sql = "UPDATE users SET lastlogindatetime = '" . $_SESSION['sLogintime'] . "' WHERE email='$varAccount'"; // 指定SQL查詢字串
                    echo $sql;
                    $result = mysqli_query($conn, $sql);
                    mysqli_close($conn);  // 關閉資料庫連接
                    header('Location: index.php');
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>粼粼-會員專區</title>
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-5.2.3-dist/css/bootstrap.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- BNB專案CSS -->
    <link rel="stylesheet" href="../css/BNB_project_font.css">
    <link rel="stylesheet" href="../css/BNB_project_manage.css">
    <!-- favicon小圖示 -->
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">
    <link rel="manifest" href="../images/favicon/site.webmanifest">
    <script>
        function refreshCode() {
            document.getElementById("imgCode").src = "captcha.php";
        }
    </script>

</head>

<body>
    <!-- navbar -->
    <section>
        <nav class="navbar navbar-expand-md fixed-left d-flex">
            <a class="navbar-brand" href="index.php">
                <img src="../images/logo003.png" alt="logo">
            </a>
            <!-- 漢堡 -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- list -->
            <div class="collapse navbar-collapse mt-auto" id="navbarNavDropdown">
                <ul class="navbar-nav text-center">
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="index.php">
                            <i class="fa-solid fa-gear pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Home<br />
                                會員專區首頁</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="member_account.php">
                            <i class="fa-solid fa-user-pen pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Member<br />
                                您的會員資料</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="member_reserve.php">
                            <i class="fa-solid fa-calendar-check pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Reserve<br />
                                您的訂房訂單</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="member_contact.php">
                            <i class="fa-solid fa-file-circle-question pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Contact<br />
                                您的聯絡事項</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="../index.html">
                            <i class="fa-solid fa-backward pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Back<br />
                                回到粼粼首頁</p>
                        </a>
                    </li>
                    <!-- 登入註冊 -->
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" href="member_login.php"><button type="button" class="btn btn-color3 btn-border d-flex justify-content-center pt-3 px-4">
                                <i class="fa-solid fa-right-to-bracket mt-2 me-3"></i>
                                <p class="nav-link-wd ps-3 text-start text-nowrap">Login<br />
                                    會員專區登入</p>
                            </button></a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" href="member_login.php?st=logout"><button type="button" class="btn btn-color3 btn-border d-flex justify-content-center pt-3 px-4">
                                <i class="fa-solid fa-circle-xmark mt-2 me-3"></i>
                                <p class="nav-link-wd ps-3 text-start text-nowrap">Logout<br />
                                    會員專區登出</p>
                            </button></a>
                    </li>
                </ul>
                <br />
            </div>
        </nav>
    </section>

    <!-- form -->
    <section class="container form-title">
        <div class="container wd-color3">
            <div class="d-flex flex-nowrap mt-5 ms-4">
                <i class="fa-solid fa-right-to-bracket fa-2x pe-3"></i>
                <h4 class="pt-1"><b>粼粼．會員專區登入</b></h4><br />
            </div>
        </div>
    </section>

    <!-- form -->
    <section>
        <div class="container wd-color mt-5">
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-10 col-md-8 col-lg-6 form-border py-5 px-4">
                    <h5 class="text-center"><b>會員帳號登錄</b></h5>

                    <form method="post" action="member_login.php">
                        <div class="form-group mt-4">
                            <label><b>帳號</b></label>
                            <input type="text" name="usrAccount" class="form-control form-text-color" placeholder="請輸入您的帳號">
                        </div>
                        <div class="form-group mt-4">
                            <label><b>密碼</b></label>
                            <input type="password" name="usrPassword" class="form-control form-text-color" placeholder="請輸入您的密碼">
                        </div>

                        <div class="form-group mt-4">
                            <img class="me-2" id="imgCode" src="captcha.php" onclick="refreshCode()" /><label>
                                <p>點擊圖片可以更換驗證碼</p>
                            </label>
                            <input type="text" name="checkText" class="form-control form-text-color" placeholder="請輸入圖形驗證碼" size="10" maxlength="5" />
                        </div>
                        <div>
                            <label style="color: red">
                                <?= $varErrcaptcha ?>
                            </label>
                        </div>

                        <div>
                            <label>
                                <?= $varErrmessage ?>
                            </label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="member_register.php">
                                <button type="button" class="btn wd-color mt-3"><i class="ti-close"></i>尚未成為會員，來去註冊</button></a>
                            <button type="submit" class="btn btn-color2 mt-3 ms-2">登入</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    require "member_footer.php";
    ?>