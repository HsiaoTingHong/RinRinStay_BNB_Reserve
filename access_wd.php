<?php
require_once "manage/conn.php";

$sql = "SELECT * FROM access";
$res = mysqli_query($conn, $sql);

if ($res) {
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_object($res)) {
            echo ("<li>" . ($row->access) . "</li>");
        }
    }
    mysqli_free_result($res);
    $conn->close();
} else {
}
