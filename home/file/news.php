<div class='container-news-field'>
    <div class='row'>
        <div class='col-xl-9'>
            <div class='box'>

            <?php
if (isset($_GET['newid'])) {
    $newsid = $_GET['newid'];
    include $BASE_PATH . "home/file/news-detail.php";

} else {
    include $BASE_PATH . "home/file/news2.php";
}

?>

            </div>


        </div>
    </div>

    <div class="btn-show-data">
        <input type="hidden" name="" id="txt-s" value="<?php echo $s; ?>">
        <input type="hidden" name="" id="txt-e" value="<?php echo $e; ?>">
        <input type="hidden" name="" id="txt-total-data" value="<?php echo $numData - $e ?>">
        <input type="hidden" name="" id="txt-con" value="<?php echo $con ?>">
        <input type="text" name="txt-url" id="txt-url " value="<?php echo $BASE_URL ?>" >
    </div>


    <div class='col-xl-3'>
        Container
    </div>

</div>