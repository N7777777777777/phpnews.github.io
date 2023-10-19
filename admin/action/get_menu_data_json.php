<?php
$cn = new mysqli("localhost", "root", "", "php23");
$cn->set_charset("utf8");
$s = $_POST['s'];
$e = $_POST['e'];
$opti = $_POST['opti'];
//count number
$sqltotal = "SELECT COUNT(*) AS total FROM tbl_menu";

if ($opti == 'search') {
    $searchval = $_POST['searchval'];
    $searchfld = explode(",", trim($_POST['searchfld']));
    $fid = $searchfld[0];
    $optor = $searchfld[1];
    $con = " $fid='$searchval'";
    if ($optor == "LIKE") {
        $con = $fid . ' LIKE ' . "'%$searchval%'";
    }
    $sqltotal = "SELECT COUNT(*) AS total FROM tbl_menu WHERE $con";
    $sql = "SELECT * FROM tbl_menu  WHERE $con ORDER BY id DESC LIMIT $s,$e";
} else {
    $sql = "SELECT * FROM tbl_menu ORDER BY id DESC LIMIT $s,$e";
}
$res = $cn->query($sql);
$restotal = $cn->query($sqltotal);
$rowtotal = $restotal->fetch_array();
$total = $rowtotal[0];
$data = array();
if ($res->num_rows > 0) {
    while ($row = $res->fetch_array()) {
        $data[] = array(
            'id' => $row['0'],
            'name' => $row['1'],
            'img' => $row['2'],
            'od' => $row['3'],
            'name_link' => $row['4'],
            'status' => $row['5'],
            'total' => $total,
        );

    }
}

echo json_encode($data);
