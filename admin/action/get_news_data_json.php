<?php
// date_default_timezone_set('Asia/Phnom_Penh');
date_default_timezone_set("Asia/Bangkok");
$cn = new mysqli("localhost", "root", "", "php23");
$cn->set_charset("utf8");
$s = $_POST['s'];
$e = $_POST['e'];
$opti = $_POST['opti'];
//count number
$sqltotal = "SELECT COUNT(*) AS total FROM tbl_news";

if ($opti == 'search') {
    $searchval = $_POST['searchval'];
    $searchfld = explode(",", trim($_POST['searchfld']));
    $fid = $searchfld[0];
    $optor = $searchfld[1];
    $con = " $fid='$searchval'";
    if ($optor == "LIKE") {
        $con = $fid . ' LIKE ' . "'%$searchval%'";
    }
    $sqltotal = "SELECT COUNT(*) AS total FROM tbl_news INNER JOIN tbl_menu
    ON tbl_menu.id=tbl_news.menu_id WHERE $con";
    $sql = "SELECT  tbl_news.id,tbl_menu.name,tbl_news.title,
    tbl_news.img,tbl_news.des,tbl_news.od,tbl_news.click,
    tbl_news.uid,tbl_news.post_date,tbl_news.news_link,
    tbl_news.status,tbl_news.menu_id FROM tbl_news  INNER JOIN tbl_menu
    ON tbl_menu.id=tbl_news.menu_id
    WHERE $con ORDER BY tbl_news.id DESC LIMIT $s,$e";
} else {
    $sql = "SELECT tbl_news.id,tbl_menu.name,tbl_news.title,
            tbl_news.img,tbl_news.des,tbl_news.od,tbl_news.click,
            tbl_news.uid,tbl_news.post_date,tbl_news.news_link,
            tbl_news.status,tbl_news.menu_id FROM tbl_news INNER JOIN tbl_menu
            ON tbl_menu.id=tbl_news.menu_id
            ORDER BY tbl_news.id DESC LIMIT $s,$e";
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
            'menu_id' => $row['1'],
            'title' => $row['2'],
            'img' => $row['3'],
            'des' => $row['4'],
            'od' => $row['5'],
            'click' => $row['6'],
            'uid' => $row['7'],
            'post_date' => date("D,M,Y ", strtotime($row['8'])),
            'news_link' => $row['9'],
            'status' => $row['10'],
            'menuid' => $row['11'],
            'total' => $total,
        );

    }
}

echo json_encode($data);
