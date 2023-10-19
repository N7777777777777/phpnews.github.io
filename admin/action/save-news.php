<?php
date_default_timezone_set("Asia/Bangkok");

$cn = new mysqli("localhost", "root", "", "php23");
$cn->set_charset("utf8");
$id = $_POST["txt-id"];
$menu_id = $_POST['txt-menu_id'];
$title = $_POST['txt-title'];
$img = $_POST['txt-photo'];
$des = $_POST['txt-des'];
$od = $_POST['txt-od'];
$editID = $_POST['txt-edit-id-news'];
$msg['edit'] = false;
$click = 0;
$uid = 0;
$post_date = date("d,M Y h:iA");
$news_link = preg_replace("#(\p{P}|\p{C}|\p{S}|\p{Z})+#u", "-", $title);
$status = $_POST['txt-status'];
if ($editID == 0) {
    $sql = "INSERT INTO tbl_news VALUES(null,'$menu_id ','$title','$img','$des','$od ','$click','$uid','$post_date ','$news_link','$status')";
    $cn->query($sql);
    $msg['id'] = $cn->insert_id;
    $msg['post_date'] = $post_date;
} else {
    $sql = "UPDATE tbl_news SET menu_id='$menu_id',title='$title',img='$img', des='$des' ,od='$od' , status='$status' WHERE id = $editID";
    $cn->query($sql);
    $msg['edit'] = true;
}
echo json_encode($msg);
