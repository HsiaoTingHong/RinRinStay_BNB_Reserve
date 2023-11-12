<?php
session_start();
if (!isset($_SESSION['sAccount']))
    header('Location: manage_login.php');
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
    <script>
        function redirectDialog(filename, mode, msg) {
            alert(msg);

            location.replace(filename + "?mode=" + mode); // location.replace 重新導向頁面
        }

        function deleteConfirm(filename, id) {
            if (confirm("警告：\n  確定刪除編號為 " + id + " 的資料嗎?") == 1)
                location.replace(filename + "?mode=delete&id=" + id);
            else
                return false;
        }

        function deleteConfirm2(filename, roomType) {
            if (confirm("警告：\n  確定刪除房型編號為 " + roomType + " 的房型資料嗎?") == 1)
                location.replace(filename + "?mode=delete&roomType=" + roomType);
            else
                return false;
        }

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
                        <a class="nav-link nav-icon align-items-center" href="manage_login.php"><button type="button" class="btn btn-color3 btn-border d-flex justify-content-center pt-3 px-4">
                                <i class="fa-solid fa-right-to-bracket mt-2 me-3"></i>
                                <p class="nav-link-wd ps-3 text-start text-nowrap">Login<br />
                                    管理人員登入</p>
                            </button></a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" href="manage_login.php?st=logout"><button type="button" class="btn btn-color3 btn-border d-flex justify-content-center pt-3 px-4">
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