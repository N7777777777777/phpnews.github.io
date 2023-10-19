<?php
$cn = new mysqli("localhost", "root", "", "php23");
$cn->set_charset("utf8");
// $id=$_POST['txt-id'];
// $name=$_POST['txt-user-name'];
// $mail=$_POST['txt-mail'];
// $password=$_POST['txt-password'];
// $img = $_POST['txt-photo'];
$sql = "INSERT INTO tbl_user VALUES(null, '1','2','3','4')";
$cn->query($sql);
// echo json_encode($cn);
