<?php
require "member_header.php";
?>

<!-- form -->
<section class="container form-title">
    <div class="container">
        <div>
            <div class="d-flex flex-nowrap wd-color3 mt-5 ms-4">
                <i class="fa-solid fa-user-pen fa-2x pe-3"></i>
                <h4 class="pt-1"><b>粼粼．您的會員資料</b></h4><br />
            </div>

            <?php
            $varAccount = $_SESSION['sAccount'];
            require "../manage/conn.php"; // 建立MySQL的資料庫連接
            $sql = "SELECT * FROM users WHERE email = '" . $varAccount . "'"; // 指定SQL查詢關鍵字字串
            ?>

            <div class="container text-nowrap table-border mt-5">
                <table class="container table table-flex">
                    <thead>
                        <tr class="table-content wd-color">
                            <th>會員編號：</th>
                            <th>會員帳號(email)：</th>
                            <th>姓名：</th>
                            <th>電話：</th>
                            <th>密碼：</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result = mysqli_query($conn, $sql)) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr class=\"table-content wd-color2\">\n";
                                echo "<td scope=\"row\">" . $row['id'] . "</td>\n";
                                echo "<td>" . $row['email'] . "</td>\n";
                                echo "<td>" . $row['userName'] . "</td>\n";
                                echo "<td>" . $row['phoneNumber'] . "</td>\n";
                                echo "<td>" . $row['pwd'] . "</td>\n";
                                echo "<td class=\"text-end\" colspan=2 ><a href=\"member_account_detail.php?mode=update&id=" . $row['id'] . "\"><button type=\"button\" class=\"btn btn-color2\">修改會員資料</button></a>\n";
                                echo "</tr>";
                            }
                        }
                        mysqli_free_result($result); // 釋放記憶體空間
                        mysqli_close($conn); // 關閉資料庫連結
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php
require "member_footer.php";
?>