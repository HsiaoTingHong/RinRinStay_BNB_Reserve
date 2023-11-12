<?php
require "manage_header.php";
?>

<?php
$varSearch = "";
if (isset($_GET['Search'])) {
    $varSearch = $_GET['Search'];
}
?>
<?php
if (isset($_GET['mode'])) //刪除功能
{
    $mode = $_GET['mode'];
    switch ($mode) {
        case "delete";
            $id = $_GET['id'];
            $mode = "browse"; // $mode = "browse" 回到瀏覽頁面
            require "conn.php";
            $sql = "DELETE FROM reserve WHERE id='" . $id . "'";

            if ($result = mysqli_query($conn, $sql)) {
                echo "<script>redirectDialog('$ThisFileName','$mode', 'ID: $id 的資料已刪除!');</script>";
            } else {
                echo "<script>redirectDialog('$ThisFileName', '$mode', '刪除失敗');</script>";
            }
            break;
    }
}
?>

<!-- form -->
<section class="container form-title">
    <div class="container">
        <div>
            <div class="d-flex flex-nowrap wd-color3 mt-5 ms-4">
                <i class="fa-solid fa-calendar fa-2x pe-3"></i>
                <h4 class="pt-1"><b>粼粼．訂房管理系統</b></h4><br />
            </div>
            <div class="container">
                <div class="row d-flex justify-content-start mt-5">
                    <div class="col-md-2">
                        <a href="reserve_manage_add.php">
                            <button type="button" class="btn btn-color">
                                新增訂房訂單
                            </button>
                        </a>
                    </div>
                    <div class="col-md-8 ms-auto">
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
            $sql = "SELECT a.id, a.reserveDate, a.checkInDate, a.checkOutDate, a.adultCount, a.kidCount, a.roomType, b.roomName, b.price, a.email, 
            (DATEDIFF(a.checkOutDate, a.checkInDate) * b.price) AS totalPrice
            FROM reserve AS a 
            LEFT JOIN room AS b 
            ON a.roomType = b.roomType 
            WHERE a.id LIKE '%" . $varSearch . "%' OR a.email LIKE '%" . $varSearch . "%' 
            ORDER BY a.id ASC"; // 指定SQL查詢關鍵字字串

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
                            <th>訂單編號</th>
                            <th>訂單日期</th>
                            <th>入住日期</th>
                            <th>退房日期</th>
                            <th>大人</th>
                            <th>小孩</th>
                            <th>房型</th>
                            <th>房型名稱</th>
                            <th>每晚價格</th>
                            <th>總金額</th>
                            <th>email</th>
                            <th>共<?= $total_records ?>筆資料</th>
                        </tr>
                    </thead>
                    <tbody class="text-center wd-color3">
                        <?php
                        $j = 1;
                        while ($row = mysqli_fetch_assoc($result) and $j <= $records_per_page) {
                            echo "<tr>\n";
                            echo "<th scope=\"row\">" . $row['id'] . "</th>\n";
                            echo "<td>" . $row['reserveDate'] . "</td>\n";
                            echo "<td>" . $row['checkInDate'] . "</td>\n";
                            echo "<td>" . $row['checkOutDate'] . "</td>\n";
                            echo "<td>" . $row['adultCount'] . "</td>\n";
                            echo "<td>" . $row['kidCount'] . "</td>\n";
                            echo "<td>" . $row['roomType'] . "</td>\n";
                            echo "<td>" . $row['roomName'] . "</td>\n";
                            echo "<td>" . $row['price'] . "</td>\n";
                            echo "<td>" . $row['totalPrice'] . "</td>\n";
                            echo "<td>" . $row['email'] . "</td>\n";
                            echo "<td><a href=\"reserve_manage_detail.php?mode=update&id=" . $row['id'] . "\"><button type=\"button\" class=\"btn btn-color btn-sm\">修改</button></a>\n";
                            echo "<a href=\"#\" ><button type=\"button\" class=\"btn btn-color2 btn-sm\" onclick=\"javascript:deleteConfirm('reserve_manage.php','" . $row["id"] . "')\">刪除</button></a></td>";
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
                    echo "<a href='reserve_manage.php?page=" . ($page - 1) . "&Search=" . $varSearch . "'style=\"color: #6677A3\"> 上一頁 </a>| ";
                }
                for ($i = 1; $i <= $total_pages; $i++)
                    if ($i != $page) {
                        echo "<a href='reserve_manage.php?page=" . $i . "&Search=" . $varSearch . "'style=\"color: #6677A3\";>" . $i . " </a> ";
                    } else {
                        echo $i . " ";
                    }
                if ($page < $total_pages) //如果頁數小於總頁數，顯示下一頁
                {
                    echo "|<a href='reserve_manage.php?page=" . ($page + 1) . "&Search=" . $varSearch . "'style=\"color: #6677A3\"> 下一頁 </a> ";
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