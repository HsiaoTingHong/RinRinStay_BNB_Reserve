<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>粼粼</title>

    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- BNB專案CSS -->
    <link rel="stylesheet" href="css/BNB_project_font.css">
    <link rel="stylesheet" href="css/BNB_project_contact.css">
    <!-- favicon小圖示 -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
    <link rel="manifest" href="images/favicon/site.webmanifest">

</head>

<body>
    <!-- navbar -->
    <section>
        <nav class="navbar navbar-expand-md fixed-left d-flex">
            <a class="navbar-brand" href="index.html">
                <img src="images/logo001.png" alt="logo">
            </a>
            <!-- 漢堡 -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- list -->
            <div class="collapse navbar-collapse mt-auto" id="navbarNavDropdown">
                <ul class="navbar-nav text-center">
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="about.html">
                            <i class="fa-regular fa-bell pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">About<br />
                                關於我們</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="room.html">
                            <i class="fa-solid fa-bed pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3 pe-1">Room<br />
                                房型介紹</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="reserve.php">
                            <i class="fa-regular fa-calendar pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Reserve<br />
                                馬上預約</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="contact.php">
                            <i class="fa-regular fa-square-check pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Contact<br />
                                聯絡我們</p>
                        </a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" aria-current="page" href="access.html">
                            <i class="fa-solid fa-location-dot pe-3 pb-3"></i>
                            <p class="nav-link-wd ps-3">Access<br />
                                交通資訊</p>
                        </a>
                    </li>
                    <!-- 登入註冊 -->
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" href="member/member_login.php"><button type="button" class="btn btn-color btn-border d-flex justify-content-center pt-3 px-5">
                                <i class="fa-solid fa-arrow-right-to-bracket mt-2 me-3"></i>
                                <p class="nav-link-wd ps-3 text-start text-nowrap">Login<br />
                                    會員專區</p>
                            </button></a>
                    </li>
                    <li class="nav-item text-start">
                        <a class="nav-link nav-icon align-items-center" href="member/member_register.php"><button type="button" class="btn btn-color btn-border d-flex justify-content-center pt-3 px-5">
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

    <!-- 將表單送出，新增到資料表 -->
    <?php
    $userName = "";
    $phoneNumber = "";
    $email = "";
    $content = "";
    //如果有接收到email值
    if (isset($_POST['email'])) {
        $userName = $_POST['userName'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $content = $_POST['content'];
        //$mode = $_POST['mode'];
        if ($email == "") //如果email未輸入值
        {
            echo "<script>alert('請輸入email');</script>";
        } else {
            require "manage/conn.php";
            $sql = "INSERT INTO contact(userName,phoneNumber,email,content) VALUE('$userName','$phoneNumber','$email','$content') ";
            if ($result = mysqli_query($conn, $sql)) {
                $mode = "browse";
                echo "<script>alert('詢問傳送成功!');</script>";
            } else {
                echo "<script>alert('傳送失敗，請輸入正確資料');</script>";
            }
        }
    }
    ?>

    <!-- form -->
    <section class="container-fluid carousel-out">
        <div class="row">
            <div class="col-md-11 carousel-in">
                <!-- form -->
                <form method="post" action="contact.php">
                    <div class="container form-border bg-circle2 send-out">
                        <h1 class="wd-color3 contact-wdtype">Contact</h1>
                        <div class="row">
                            <!-- name -->
                            <div class="col-12 col-md-5 wd-color3">
                                <h6><b>姓名</b><small> - Name</small></h6>
                                <input class="form-control form-text-color" type="text" id="userName" name="userName" value="<?= $userName ?>" placeholder="*您的稱呼" aria-label="default input example" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- phone -->
                            <div class="col-12 col-md-5 wd-color3 me-3">
                                <h6><b>聯絡電話</b><small> - Phone Number</small></h6>
                                <input class="form-control form-text-color" type="tel" id="phoneNumber" name="phoneNumber" value="<?= $phoneNumber ?>" placeholder="*0900-000-000" aria-label="default input example" required>
                            </div>
                            <!-- e-mail -->
                            <div class="col-12 col-md-5 wd-color3">
                                <h6><b>聯絡信箱</b><small> - Email Address</small></h6>
                                <input class="form-control form-text-color" type="email" id="email" name="email" value="<?= $email ?>" placeholder="*XXXXX@gmail.com" aria-label="default input example" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- phone -->
                            <div class="wd-color3">
                                <h6><b>詢問內容</b><small> - Question</small></h6>
                                <textarea id="content" name="content" placeholder="*必填" cols="30" rows="10" required><?= $content ?></textarea>
                            </div>
                        </div>
                        <!-- 送出/取消 -->
                        <div class="container text-end mt-3 send-in">
                            <!-- 按取消回到index.html -->
                            <a href="index.html"><button type="button" class="btn btn-color" id="cancelBtn" name="cancelBtn"><b>取消</b></button></a>
                            <!-- 送出按鈕 -->
                            <button type="submit" class="btn btn-color2 ms-2" id="confirmBtn" name="confirmBtn"><b>送出</b></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- footer -->
    <section>
        <div class="footer">
            <p><small>Copyright © 2023 粼粼 All Rights Reserved.</small></p>
        </div>
    </section>

    <!-- bootstrap javascript file -->
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.2.3-dist/js/bootstrap.bundle.js"></script>
    <!-- jquery-3.7.0 CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</body>

</html>