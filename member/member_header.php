<?php
session_start();
if (!isset($_SESSION['sAccount']))
    header('Location: member_login.php');
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
        function checkForm() {
            // 获取 email、pwd 和 pwd2 输入框的引用
            var emailInput = document.getElementById("email");
            var pwdInput = document.getElementById("pwd");
            var pwd2Input = document.getElementById("pwd2");

            // 获取用于显示错误消息的元素的引用
            var errorElement = document.getElementById("errorMessage");

            // 检查 email 字段是否为空
            if (emailInput.value.trim() === "") {
                errorElement.innerText = "請輸入您的email";
                emailInput.focus();
                return false; // 阻止表单提交
            }

            // 检查密码字段是否不同
            if (pwdInput.value !== pwd2Input.value) {
                errorElement.innerText = "兩個密碼不相同，請重新輸入密碼";
                pwd2Input.focus();
                return false; // 阻止表单提交
            }

            // 如果所有条件都满足，允许表单提交
            return true;
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