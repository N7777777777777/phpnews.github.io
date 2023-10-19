<?php
$cn = new mysqli('localhost', 'root', '', 'php23');
$cn->set_charset('utf8');
$data = array();
$s = $_POST['s'];
$e = $_POST['e'];
$con = $_POST['con'];
$sql = "SELECT id,img,title,des,menu_id
FROM tbl_news WHERE $con ORDER BY id DESC LIMIT $s,$e";
$res = $cn->query($sql);

while ($row = $res->fetch_array()) {
    $data[] = array(
        "id" => $row[0],
        'img' => $row[1],
        'title' => $row[2],
        'des' => mb_substr($row[3], 0, 100, 'utf8'),
        'menu_id' => $row[4],

    );
}
echo json_encode($data);
