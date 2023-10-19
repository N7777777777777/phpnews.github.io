<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://registry.npmjs.org/jquery/-/jquery-3.2.1.tgz">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/font/font/css/all.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="admin/admin.js"></script>
</head>

<body>
    <div class="bar1">
        <div class="btn-menu">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="page-title">
            Page Title
        </div>
        <div class="user-box">
            <i class="fa-solid fa-user"></i>
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </div>
    </div>
    <div class="left-menu">
        <ul>
            <li>
                <a>
                    <i class="fa-solid fa-user" style="color: #003185;"></i><br />
                    User
                </a>
                <div class="sub-menu">
                    <ul>
                        <li data-frm="1">
                            <a>User List</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a>
                    <i class="fa-solid fa-square-plus fa-xl" style="color: #122c59;"></i><br />
                    Set Up
                </a>
                <div class="sub-menu">
                    <ul>
                        <li data-frm="2">
                            <a>News List</a>
                        </li>
                        <li data-frm="3">
                            <a>Menu List </a>
                        </li>
                        <li data-frm="4">
                            <a>Ads</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- <li>
                <a >
                <i class="fa-brands fa-facebook"></i>
                Facebook
                </a>
            </li>
            <li>
                <a >
                <i class="fa-brands fa-instagram"></i>
                Instagram
                </a>
            </li>
            <li>
                <a >
                <i class="fa-brands fa-twitter"></i><br/>
                Twitter

                </a>
            </li> -->
        </ul>



    </div>


    <div class="data-container">

        <div class="container-1">

            <ul>
                <li class="btn btn-1" id="btn-add">
                    <a>
                        Add <i class="fa-solid fa-plus"></i>
                    </a>

                </li>

            </ul>
            <ul class='search-box'>
                <li>
                    <input type="text" name="txt-search-val" id="txt-search-val" placeholder="Search">

</li>
<!-- <li><i class="fa-solid fa-circle-xmark"></i></li> -->
                <li class="searchopt">
                    <select name="txtsearch" id="txtsearch" class="open">
                        <option value="0"></option>
                        <option value="id">ID</option>
                        <option value="name">Name</option>
                        <option value="status">Status</option>
                    </select>
                </li>

                <li class='btn-Search'>
                    <i class="fa-solid fa-magnifying-glass"></i>

                </li>

            </ul>
            <ul class='page-box'>
                <li class='btn btn-2 limit-bx'>
                    <select name="" id="limit-box-data">

                        <option class="opt1" value="2">2</option>
                        <option class="opt2" value="5">5</option>
                        <option class="opt3" value="10">10</option>

                    </select>
                </li>
                <li class='btn btn-2' id='btnback'>
                    <i class="fa-solid fa-arrow-left"></i>
                </li>
                <li class='btn'>
                    <span id='curPage'>0</span> /<span id='totalPage'>0</span> of <span id='totalItem'></span>
                </li>
                <li class='btn btn-2' id='btnnext'>
                    <i class="fa-solid fa-arrow-right"></i>
                </li>

            </ul>

        </div>
        <table id="tabledata" class="tbltable">

        </table>

    </div>
    </div>
</body>
<script src="js/action.js">
</script>

</html>
