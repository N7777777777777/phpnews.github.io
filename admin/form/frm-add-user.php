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
    <div class="frm">
        <div class="head">

            <span>Menu</span>
            <i id='btn-close' class="fa-solid fa-circle-xmark"></i>

        </div>
        <form class="upl" action="post">
        <div class='body'>
            <label for="">ID</label>
            <input type="text" name="txt-id" id="txt-id" class="frm-control">

            <label for="">Name</label>
            <input type="text" name="txt-user-name" id="txt-user-name" class="frm-control">
            <label for="">Email</label>
            <input type="text" name="txt-mail" id="txt-mail" class="frm-control">
            <label for="">Password</label>
            <input type="password" name="txt-password" id="txt-password" class="frm-control">
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
