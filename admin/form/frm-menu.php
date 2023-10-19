<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://registry.npmjs.org/jquery/-/jquery-3.2.1.tgz">
    <link rel="stylesheet" href="style/style.css" >
    <link rel="stylesheet" href="style/font/font/css/all.min.css" >
    <script src="node_modules/jquery/dist/jquery.min.js"></script>

    <title>Menu</title>
    <style>

    </style>

</head>

<body>
    <div class=" frm">
        <div class="head">

            <span>Menu</span>
            <i id='btn-close' class="fa-solid fa-circle-xmark"></i>

        </div>
        <form class="upl" action="post">
        <div class='body'>
            <input  type="hidden" name="txt-edit-id" id="txt-edit-id" value="0">
            <label for="">ID</label>
            <input type="text" name="txt-id" id="txt-id"class="frm-control" placeholder="ID">
            <label for="">Name</label>
            <input type="text" name="txt-name" id="txt-name"class="frm-control" placeholder="Name">
            <label for="">OD</label>
            <input type="text" name="txt-od" id="txt-od"class="frm-control" placeholder="OD">
            <!-- <label for="">Name Link</label> -->
            <input type="text" name="txt-Link" id="txt-Link"class="frm-control" placeholder="Name Link">
            <label for="">Status</label>
            <select name="txt-status" id="txt-status" class="frm-control">
                <option value="1">
                    1
                </option>
                <option value="2">
                    2

                </option>
            </select>
            <label for="">Photo</label>
            <div class='img-box'>

            <input type="file" name="txt-file" id="txt-file"  class="txt-file"  >

            <input style="opacity: 0;" type="text" name = "txt-photo" id = "txt-photo" class="txt-photo" >

            </div>
            <div class='footer'>
                <div class='btn btn-save'>
                <i class="fa-regular fa-floppy-disk" style="color: #082b68;"> Save</i>

                </div>
            </div>


        </div>
        </form>
    </div>
</body>
</html>
