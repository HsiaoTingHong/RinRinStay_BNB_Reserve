<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>粼粼-會員註冊</title>
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
            <a class="navbar-brand" href="../index.html">
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
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="../about.html">
                            <i class="fa-regular fa-bell pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">About<br />
                                關於我們</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="../room.html">
                            <i class="fa-solid fa-bed pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Room<br />
                                房型介紹</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="../reserve.php">
                            <i class="fa-regular fa-calendar pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Reserve<br />
                                馬上預約</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="../contact.php">
                            <i class="fa-regular fa-square-check pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Contact<br />
                                聯絡我們</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="../access.html">
                            <i class="fa-solid fa-location-dot pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Access<br />
                                交通資訊</p>
                        </a>
                    </li>
                    <!-- 登入註冊 -->
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" href="member_login.php"><button type="button" class="btn btn-color3 btn-border d-flex justify-content-center pt-3 px-5">
                                <i class="fa-solid fa-arrow-right-to-bracket mt-2 me-3"></i>
                                <p class="nav-link-wd ps-3 text-start text-nowrap">Login<br />
                                    會員專區</p>
                            </button></a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" href="member_register.php"><button type="button" class="btn btn-color3 btn-border d-flex justify-content-center pt-3 px-5">
                                <i class="fa-regular fa-user mt-2 me-3"></i>
                                <p class="nav-link-wd ps-3 text-start text-nowrap">register<br />
                                    註冊會員</p>
                            </button></a>
                    </li>
                </ul>
                <br />
            </div>
        </nav>
    </section>

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
            require "../manage/conn.php";
            $sql = "SELECT * FROM users where email='" . $email . "'"; // 指定SQL查詢字串
            if (mysqli_num_rows(mysqli_query($conn, $sql)) != 0) {
                echo "<script> alert('會員帳號已存在');</script>";
            } else {
                $sql = "INSERT INTO users(email,userName,phoneNumber,pwd) VALUE('$email','$userName','$phoneNumber','$pwd') ";
                if ($result = mysqli_query($conn, $sql)) {
                    $mode = "browse";
                    echo "<script>alert ('會員帳號註冊成功!');</script>";
                } else {
                    echo "<script>alert ('註冊失敗，請輸入正確資料');</script>";
                }
            }
        }
    }
    ?>

    <!-- form -->
    <div class="container form-title">
        <div class="mt-5">
            <div class="d-flex flex-nowrap wd-color3 mt-5 ms-4">
                <i class="fa-regular fa-user fa-2x pe-3"></i>
                <h4 class="pt-1"><b>粼粼．會員註冊</b></h4><br />
            </div>
            <div class="container wd-color mt-3">
                <div class="container col-12 col-md-10 col-lg-8 form-border py-5 px-4">
                    <h5 class="text-center"><b>註冊會員帳號<br><small>Register Member Account</small></b></h5>
                    <form class="container" onsubmit="return checkForm()" method="post" action="member_register.php">
                        <!-- email -->
                        <div class="form-group mt-2">
                            <label class="control-label">會員帳號 Account (email)</label>
                            <div class="">
                                <input type="email" id="email" name="email" class="form-control form-text-color" placeholder="請輸入email" value="<?= $email ?>" required>
                            </div>
                        </div>
                        <!-- userName -->
                        <div class="form-group mt-2">
                            <label class="control-label">姓名 Name</label>
                            <div class="">
                                <input type="text" id="userName" name="userName" class="form-control form-text-color" placeholder="請輸入您的姓名" value="<?= $userName ?>" required>
                            </div>
                        </div>
                        <!-- phoneNumber -->
                        <div class="form-group mt-2">
                            <label class="control-label">電話 Phone Number</label>
                            <div class="">
                                <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-text-color" placeholder="請輸入您的電話" value="<?= $phoneNumber ?>" required>
                            </div>
                        </div>
                        <!-- pwd -->
                        <div class="form-group mt-2">
                            <label class="control-label">密碼 Password</label>
                            <div class="">
                                <input type="password" id="pwd" name="pwd" class="form-control form-text-color" placeholder="請輸入您的密碼" value="<?= $pwd ?>" required>
                                <!-- 加入一個隱藏的mode值一起送出 -->
                                <input type="hidden" name="mode" value="<?= $mode ?>">
                            </div>
                        </div>
                        <!-- pwd confirm -->
                        <div class="form-group mt-2">
                            <label class="control-label">密碼確認 Password Confirm</label>
                            <div class="">
                                <input type="password" id="pwd2" name="pwd2" class="form-control form-text-color" placeholder="請再次輸入密碼" value="<?= $pwd2 ?>" required>
                            </div>
                        </div>

                        <!-- 错误消息显示区域 -->
                        <div class="wd-color3 mt-2" id="errorMessage"></div>

                        <!-- 確認/離開 -->
                        <div class="form-group mt-3">
                            <div class="d-flex justify-content-end">
                                <a href="member_login.php">
                                    <button type="button" class="btn wd-color"><i class="ti-close"></i>已有會員帳號，來去登入</button></a>
                                <!-- 按離開回到index.html -->
                                <a href="../index.html">
                                    <button type="button" class="btn btn-color ms-2"><i class="ti-close"></i>離開</button></a>
                                <button type="submit" class="btn btn-color2 ms-2"><i class="ti-check"></i>確認 </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <section>
        <div class="footer">
            <p><small>Copyright © 2023 粼粼 All Rights Reserved.</small></p>
        </div>
    </section>
    <!-- bootstrap javascript file -->
    <script type="text/javascript" src="../jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.2.3-dist/js/bootstrap.bundle.js"></script>
    <!-- jquery-3.7.0 -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</body>

</html>