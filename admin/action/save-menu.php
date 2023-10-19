<?php
$cn = new mysqli("localhost", "root", "", "php23");
$cn->set_charset("utf8");

$name = $cn->real_escape_string(trim($_POST['txt-name']));
$id = $_POST['txt-id'];
$od = $_POST['txt-od'];
$status = $_POST['txt-status'];
$name_link = preg_replace("#(\p{P}|\p{C}|\p{S}|\p{Z})+#u", "-", $name);
$img = $_POST['txt-photo'];
$editID = $_POST['txt-edit-id'];
$msg['dpl'] = false;
$msg['edit'] = false;
//check duplicates name

$sql = "SELECT * FROM tbl_menu WHERE name = '$name' AND id !=$id";
$res = $cn->query($sql);

if ($res->num_rows > 0) {
    $msg['dpl'] = true;
} else { 
    if ($editID == 0) {
        // Insertion query should specify the columns to avoid issues if the table schema changes
        $sql = "INSERT INTO tbl_menu VALUES(null,'$name','$img','$od','$name_link','$status')";
        $cn->query($sql);
        // Corrected variable to get the last inserted ID
        $msg['id'] = $cn->insert_id;
    } else {
        // Added column names in the update query
        $sql = "UPDATE tbl_menu SET name='$name', img='$img', od='$od', name_link='$name_link', status='$status' WHERE id=$editID";
        $cn->query($sql);
        $msg['edit'] = true;
    }
}

echo json_encode($msg);
 