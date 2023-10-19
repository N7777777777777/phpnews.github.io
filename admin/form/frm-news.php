<?php
$cn = new mysqli("localhost", "root", "", "php23");
$cn->set_charset("utf8");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="style/style.css" >
    <link rel="stylesheet" href="style/font/font/css/all.min.css" >
    <title>News</title>
    <style>

    </style>

</head>

<body>
    <div class=" frm" style="width:80%">
        <div class="head">

            <span>News</span>
            <i id='btn-close' class="fa-solid fa-circle-xmark"></i>
        </div>
        <form class="upl" action="post">
        <div class='body' >
            <div class="box-1">

            <label for="">ID</label>
            <input  type="hidden" name="txt-edit-id-news" id="txt-edit-id-news" value="0">
            <input  type="hidden" name="txt-news-link" id="txt-news-link" >
            <input type="text" name="txt-id" id="txt-id"class="frm-control" placeholder="ID">
            <label for ="" >Menu ID</label>
            <select name="txt-menu_id" id="txt-menu_id" class="frm-control">
                <option value="0">Select Menu ID</option>

                                                        <?php
$sql = "SELECT id,name FROM tbl_menu WHERE status=1";
$res = $cn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_array()) {
        ?>
        <option value="<?php echo $row[0] ?>">
        <?php echo $row[1] ?>
        </option>
        <?php
}
}
?>


            </select>

            <label for="">OD</label>
            <input type="text" name="txt-od" id="txt-od" class="frm-control">
            <label for="">Status</label>
            <select name="txt-status" id="txt-status" class="frm-control">
                <option value="1">
                    1
                </option>
                <option value="2">
                    2
                </option>
            </select>
            <label for="">photo</label>
            <div class='img-box'>
            <input type="file" name="txt-file" id="txt-file"  class="txt-file"  >

            <input style="opacity: 0;" type="text" name = "txt-photo" id = "txt-photo" class="txt-photo" >
            </div>
            </div>
            <div class="box-2">
            <label for="">Title</label>
            <input type="text" name="txt-title" id="txt-title" class="frm-control" placeholder="Title">
            <label for="">Description</label>

            <textarea name="txt-des" id="txt-des" cols="30" rows="10" class="areatext"></textarea>
            </div>


            <div class='footer'>
                <div class='btn btn-save' id="btn-save">
                <i class="fa-regular fa-floppy-disk" style="color: #082b68;"> Save</i>

                </div>
            </div>


        </div>
        </form>
    </div>
</body>
</html>
