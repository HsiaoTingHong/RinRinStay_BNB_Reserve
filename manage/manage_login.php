<?php
session_start();
require 'conn.php';
$varErrmessage = "";

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
        if ($varPassword == $row['pwd']) {
            $_SESSION['sAccount'] = $varAccount;
            $_SESSION['sname'] = $row['userName'];
            date_default_timezone_set('Asia/Taipei'); // 設定時區為台北時區
            $_SESSION['sLogintime'] = date("Y/m/d H:i:s");
            $sql = "UPDATE users SET lastlogindatetime = '" . $_SESSION['sLogintime'] . "' WHERE email='$varAccount'"; // 指定SQL查詢字串
            echo $sql;
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);  // 關閉資料庫連接
            header('Location: index.php');
        } else
            $varErrmessage = "請輸入正確密碼";
    }
}

?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>粼粼-後臺管理系統</title>
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
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="users_manage.php">
                            <i class="fa-solid fa-user-check pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Member<br />
                                會員資料管理</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="reserve_manage.php">
                            <i class="fa-solid fa-calendar pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Reserve<br />
                                訂房訂單管理</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="room_manage.php">
                            <i class="fa-solid fa-bed pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Room<br />
                                房型資料管理</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="contact_manage.php">
                            <i class="fa-solid fa-envelope pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Contact<br />
                                問題回報管理</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="access_manage.php">
                            <i class="fa-solid fa-car-rear pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Access<br />
                                交通資訊管理</p>
                        </a>
                    </li>

                    <!-- 登入註冊 -->
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center pt-3" href="manage_login.php"><button type="button" class="btn btn-color3 btn-border d-flex justify-content-center pt-3 px-4">
                                <i class="fa-solid fa-right-to-bracket mt-2 me-3"></i>
                                <p class="nav-link-wd ps-3 text-start text-nowrap">Login<br />
                                    管理人員登入</p>
                            </button></a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center pt-3" href="manage_login.php?st=logout"><button type="button" class="btn btn-color3 btn-border d-flex justify-content-center pt-3 px-4">
                                <i class="fa-solid fa-circle-xmark mt-2 me-3"></i>
                                <p class="nav-link-wd ps-3 text-start text-nowrap">Logout<br />
                                    管理人員登出</p>
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
                <h4 class="pt-1"><b>粼粼．後臺管理系統登入</b></h4><br />
            </div>
        </div>
    </section>

    <!-- form -->
    <section>
        <div class="container wd-color mt-5">
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-10 col-md-8 col-lg-6 form-border py-5 px-4 mt-4">
                    <h5 class="text-center"><b>管理者帳號登錄<br><small>Manage Login</small></b></h5>
                    <form method="post" action="manage_login.php">
                        <div class="form-group mt-4">
                            <label><b>帳號 Account</b></label>
                            <input type="text" name="usrAccount" class="form-control form-text-color" placeholder="請輸入您的帳號">
                        </div>
                        <div class="form-group mt-4">
                            <label><b>密碼 Password</b></label>
                            <input type="password" name="usrPassword" class="form-control form-text-color" placeholder="請輸入您的密碼">
                        </div>
                        <div>
                            <label>
                                <?= $varErrmessage ?>
                            </label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-color2 mt-3">登入 Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    require "manage_footer.php";
    ?>