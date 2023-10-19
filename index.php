<?php
include "_config_inc.php";
$BASE_PATH = BASE_PATH;
$BASE_URL = BASE_URL;
// $ADMIN_URL = ADMIN_URL;
$cn = new mysqli('localhost', 'root', '', 'php23');
$cn->set_charset('utf8');

$con = "status=1";
$mname = 0;
$s = 0;
$e = 5;
if (isset($_GET['mname'])) {
    $mname = $_GET['mname'];
    $con = "status=1 && menu_id=$mname";
}
//count data
$sql = "SELECT COUNT(*) as total FROM tbl_news WHERE $con ";
$res = $cn->query($sql);
$row = $res->fetch_array();
$numData = $row[0];
include $BASE_PATH . "home/file/header.php";
include $BASE_PATH . "home/file/menu.php";
include $BASE_PATH . "home/file/news.php";

?>

<div class="btn-data">
</div>
</body>

</html>
