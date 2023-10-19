<?php
$cn = new mysqli("localhost", "root", "", "php23");
$cn->set_charset("utf8");
$id = $_POST["id"];
$sql = "SELECT des,img FROM tbl_news WHERE id=$id";
$res = $cn->query($sql);
$res = $res->fetch_array();
$msg['des'] = $row[0];
$msg['img'] = $row[1];
echo json_encode($msg);
