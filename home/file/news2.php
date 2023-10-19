<?php
$sql = "SELECT id,img,title,des,menu_id,news_link FROM tbl_news WHERE $con ORDER BY id DESC LIMIT $s,$e ";
$res = $cn->query($sql);
if ($res->num_rows) {
    while ($row = $res->fetch_array()) {
        ?>
                <a class='item-box' href="<?php echo $BASE_URL; ?><?php echo $row[4]; ?>/<?php echo $row[5]; ?>">
                    <div class='img-box ' id='bg-img'
                        style="background-image: url('<?php echo $BASE_URL; ?>admin/img/<?php echo $row[1]; ?>')">
                    </div>
                    <div class='txt-box'>
                        <h1><?php echo $row[2]; ?></h1>
                        <p><?php echo mb_substr($row[3], 0, 100, "utf-8"); ?></p>
                        <h3><?php
echo $row[4] . '-' . $row[0]; ?>
                        </h3>
                    </div>
    </a>
                <?php
}
}
?>
    <?php
if ($numData - $e > 0) {
    ?>
    <center >
    <div class = "btn-more">More.....</div>
    </center>
    <?php
}

?>
