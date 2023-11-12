<?php
require "manage_header.php";
?>

<?php
$varSearch = "";
if (isset($_GET['Search'])) {
    $varSearch = $_GET['Search'];
}
?>

<!-- form -->
<section class="container form-title">
    <div class="container">
        <div>
            <div class="d-flex flex-nowrap wd-color3 mt-5 ms-4">
                <i class="fa-solid fa-envelope fa-2x pe-3"></i>
                <h4 class="pt-1"><b>粼粼．詢問管理系統</b></h4><br />
            </div>
            <div class="container">
                <div class="row d-flex justify-content-end mt-5">
                    <div class="col-md-8">
                        <form>
                            <div class="form-group">
                                <div class="input-group input-group-default">
                                    <input type="text" placeholder="Search Round" name="Search" class="form-control">
                                    <span class="input-group-btn"><button class="btn btn-color" type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            查詢</button></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            require "conn.php"; // 建立MySQL的資料庫連接
            $sql = "SELECT * FROM contact WHERE contact.content LIKE '%" . $varSearch . "%' OR contact.answer LIKE '%" . $varSearch . "%' ORDER BY contact.id ASC"; // 指定SQL查詢關鍵字字串
            $records_per_page = 2; //設定每頁筆數變數
            // page 要做一個頁數選擇的超連結，取得URL參數的頁數
            if (isset($_GET["page"]))
                $page = $_GET["page"];
            else
                $page = 1;
            if ($result = mysqli_query($conn, $sql)) {
                $total_records = mysqli_num_rows($result);
                // ceil函數:取無條件進位整數，所有資料筆數/每頁筆數=計算總頁數
                $total_pages = ceil($total_records / $records_per_page);
                // offset 計算這一頁第1筆記錄的位置                     
                $offset = ($page - 1) * $records_per_page;
                // mysqli_data_seek 查詢後直接移動到指定的紀錄所在
                mysqli_data_seek($result, $offset);
            }
            ?>
            <div class="container text-nowrap mt-4 wd">
                <table class="table">
                    <thead class="text-center wd-color">
                        <tr>
                            <th>詢問編號</th>
                            <th>會員帳號(email)</th>
                            <th>姓名</th>
                            <th>電話</th>
                            <th>詢問內容</th>
                            <th>問題回覆</th>
                            <th>共<?= $total_records ?>筆資料</th>
                        </tr>
                    </thead>
                    <tbody class="text-center wd-color3">
                        <?php
                        $j = 1;
                        while ($row = mysqli_fetch_assoc($result) and $j <= $records_per_page) {
                            echo "<tr>\n";
                            echo "<th scope=\"row\">" . $row['id'] . "</th>\n";
                            echo "<td>" . $row['email'] . "</td>\n";
                            echo "<td>" . $row['userName'] . "</td>\n";
                            echo "<td>" . $row['phoneNumber'] . "</td>\n";
                            echo "<td class=\"text-wrap\">" . $row['content'] . "</td>\n";
                            echo "<td class=\"text-wrap\">" . $row['answer'] . "</td>\n";
                            echo "<td><a href=\"contact_manage_detail.php?mode=update&id=" . $row['id'] . "\"><button type=\"button\" class=\"btn btn-color2 btn-sm\">回覆詢問事項</button></a>\n";
                            echo "</tr>";
                            $j++;
                        }
                        mysqli_free_result($result); // 釋放記憶體空間
                        mysqli_close($conn); // 關閉資料庫連結
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="container text-center">
                <?php
                echo "<tr>\n";
                echo "<td colspan=5>\n";
                if ($page > 1) //如果page>1，顯示上一頁
                {
                    echo "<a href='contact_manage.php?page=" . ($page - 1) . "&Search=" . $varSearch . "'style=\"color: #6677A3\"> 上一頁 </a>| ";
                }
                for ($i = 1; $i <= $total_pages; $i++)
                    if ($i != $page) {
                        echo "<a href='contact_manage.php?page=" . $i . "&Search=" . $varSearch . "'style=\"color: #6677A3\";>" . $i . " </a> ";
                    } else {
                        echo $i . " ";
                    }
                if ($page < $total_pages) //如果頁數小於總頁數，顯示下一頁
                {
                    echo "|<a href='contact_manage.php?page=" . ($page + 1) . "&Search=" . $varSearch . "'style=\"color: #6677A3\"> 下一頁 </a> ";
                }
                echo "</td>\n";
                echo "</tr>";
                ?>
            </div>
        </div>
    </div>
</section>

<?php
require "manage_footer.php";
?>