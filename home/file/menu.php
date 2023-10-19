<div class='container-flid menu-box'>
        <div class='container'>
            <div class='row'>
                <div class='col-xl-12 col-lg-12 menu'>
                    <ul>
                        <li>
                            <?php
if ($mname == 0) {
    $acolor = 'rgb(176, 176, 236)';
} else {

    $acolor = 'cornflowerblue';
}
?>
                            <a style="background-color: <?php echo $acolor; ?> ;" href="<?php echo $BASE_URL; ?>">
                                <i class='fa fa-home'></i>
                            </a>

                        </li>
                        <?php
$sql = 'SELECT id,name FROM tbl_menu where status=1 ORDER BY id DESC ';
$res = $cn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_array()) {

        $acolor = 'cornflowerblue';
        if ($row[0] == $mname) {
            $acolor = 'rgb(176, 176, 236)';
        }
        ?>
                        <li>
                            <a style="background-color:<?php echo $acolor; ?>" href='<?php echo $BASE_URL; ?><?php echo $row[0]; ?>'>
                                <?php echo $row[1]; ?>
                            </a>

                        </li>
                        <?php

    }

}

?>

                    </ul>

                </div>

            </div>

        </div>

    </div>