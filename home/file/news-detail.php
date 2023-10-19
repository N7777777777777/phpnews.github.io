<?php
$cn = new mysqli('localhost', 'root', '', 'php23');
$cn->set_charset('utf8');
?>
    <?php

$sql = "SELECT title,img,des,post_date FROM tbl_news WHERE news_link='$newsid'";
$res = $cn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_array()) {
        ?>
    <h1><?php echo $row[0]; ?></h1>
    <div class='img-box ' id='bg-img'
                        style="background-image: url('<?php echo $BASE_URL; ?>admin/img/<?php echo $row[1]; ?>')">
                    </div>
    <p><?php echo $row[2]; ?></p>
    <p><?php echo $row[3]; ?></p>

    <?php
}

} else {
    echo "Data not found";
}

?>
