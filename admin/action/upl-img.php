<?php
$file = $_FILES['txt-file'];
$tmp = $file['tmp_name'];
$img_name = $file['name'];
$ext = pathinfo($img_name, PATHINFO_EXTENSION);
$t = time();
$newName = $t . mt_rand(100000, 999999);
move_uploaded_file($tmp, "../img/" . $newName . '.' . $ext);
$msg['imgName'] = $newName . '.' . $ext;
$msg['imgPath'] = $newName . '.' . $ext;
echo json_encode($msg);
