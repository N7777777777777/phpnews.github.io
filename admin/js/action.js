//Jquery
$(document).ready(function() {
    var tabledata = $("#tabledata");
    var body = $("body");
    var loading =
        "<div class = 'loading'> <i class='fas fa-circle-notch fa-spin'></i> loading.....</div>";
    var popup = "<div class = 'popup'>" + loading + "</div>";
    var btnedit = "<input type='button' value='Edit'  class='btn-edit'>";
    var btndel = "<input type='button' value='Delete'  class='btn-Del'>";
    var searchvalue = $("#txt-search-val");
    var txtsearch = $("#txtsearch");
    var searchOpt = "no";
    var frmNo = 0;
    var s = 0;
    var trInx;
    var e = $("#limit-box-data").val();
    var curpage = $("#curPage");
    var totalpage = $("#totalPage");
    var totalitem = $("#totalItem");
    // change form
    var frm = {
        1: "frm-add-user.php",
        2: "frm-news.php",
        3: "frm-menu.php",
    };

    var searchfield = {
        1: {


        },
        2: {
            "tbl_news.id,=": "ID",
            "tbl_menu.name,LIKE": "Menu",
            "tbl_news.title,LIKE": "Title",
            "tbl_news.status ,=": "Status",
        },

        3: {
            "id,=": "ID",
            "name,LIKE": "Name",
            "status,=": "Status",
        },
    };

    // open form
    $("#btn-add").click(function() {
        body.append(popup);
        $(".popup").load(
            "form/" + frm[frmNo],
            function(responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") get_last_id();
                body.find(".frm .head span").text($(".page-title").text());

                //  alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
            }
        );
    });

    // get auto ID
    function get_last_id() {
        $.ajax({
            url: "action/get_last_id.php",
            type: "POST",
            data: {
                frm: frmNo,
            },
            // contentType:false,
            // processData:false,
            dataType: "json",
            beforeSend: function() {
                //work before success
            },
            success: function(data) {
                body.find(".frm #txt-id").val(parseInt(data.id) + 1);
                body.find(".frm #txt-od").val(parseInt(data.id) + 1);
            },
        });
    }

    // btn-close form
    body.on("click", ".frm #btn-close", function() {
        $(".popup").last().remove();
    });

    //show data
    $(".sub-menu").on("click", "li", function() {
        s = 0;
        frmNo = $(this).data("frm");
        $(".container-1").show();
        var eThis = $(this);
        var title = eThis.find("a").text();
        $(".page-title").text(title);
        searchOpt = "no";
        var txt = '<option value="0">Select Option To Search</option>';
        for (opt in searchfield[frmNo]) {
            txt +=
                "<option value=" + opt + ">" + searchfield[frmNo][opt] + "</option>";
        }
        txtsearch.html(txt);
        curpage.text(1);
        if (frmNo == 2) {
            get_news_data();
        } else if (frmNo == 3) {
            get_data_menu();
        }
    });

    // Seach Data
    $(".btn-Search").click(function() {
        s = 0;
        curpage.text(1);
        searchOpt = "search";

        if (txtsearch.val() == 0) {
            alert("please select a option to search");
            return;
        } else {
            if (searchvalue.val() == "") {
                searchvalue.focus();
                return;
            }
        }
        if (frmNo == 2) {
            get_news_data();
        } else if (frmNo == 3) {
            get_data_menu();
        }
    });

    //button Next
    $("#btnnext").click(function() {
        if (curpage.text() == totalpage.text()) {
            return;
        }

        if (frmNo == 2) {
            get_news_data();
        } else if (frmNo == 3) {
            get_data_menu();
        }

        curpage.text(parseInt(curpage.text()) + 1);
        s = parseInt(s) + parseInt(e);
    });

    //button back
    $("#btnback").click(function() {
        if (curpage.text() == 1) {
            return;
        }

        if (frmNo == 2) {
            get_news_data();
        } else if (frmNo == 3) {
            get_data_menu();
        }

        curpage.text(parseInt(curpage.text()) - 1);
        s = parseInt(s) - parseInt(e);
    });

    // limit data

    $("#limit-box-data").change(function() {
        s = 0;
        curpage.text(1);

        e = $(this).val();
        if (frmNo == 2) {
            get_news_data();
        } else if (frmNo == 3) {
            get_data_menu();
        }
    });

    // save data
    body.on("click", ".frm .btn-save", function() {
        var eThis = $(this);
        if (frmNo == 1) {
            save_user_data(eThis);
        } else if (frmNo == 2) {
            save_news(eThis);
        } else if (frmNo == 3) {
            save_menu(eThis);
        }
    });

    //save the menu
    function save_menu(eThis) {
        var Parent = eThis.parents(".frm");
        var id = Parent.find("#txt-id");
        var name = Parent.find("#txt-name");
        var od = Parent.find("#txt-od");
        var photo = Parent.find("#txt-photo");
        var status = Parent.find("#txt-status");
        var imgBox = Parent.find(".img-box");
        var name_link = Parent.find("#txt-Link");

        if (name.val() == "") {
            alert("Please input a name");
            name.focus();
            return;
        } else if (photo.val() == "") {
            alert("Please input Photo");
            photo.focus();
            return;
        }

        var frm = eThis.closest("form.upl");
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: "action/save-menu.php",
            type: "POST",
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                body.append(popup);
            },
            success: function(data) {
                if (data.dpl == true) {
                    alert("Duplicate name");
                    name.focus();
                } else {
                    if (data.edit == true) {
                        tabledata.find("tr:eq(" + trInx + ") td:eq(1)").text(name.val());
                        tabledata
                            .find("tr:eq(" + trInx + ") td:eq(2) img")
                            .attr("src", "img/" + photo.val() + "");
                        tabledata
                            .find("tr:eq(" + trInx + ") td:eq(2) img")
                            .attr("alt", "" + photo.val() + "");
                        tabledata.find("tr:eq(" + trInx + ") td:eq(3)").text(od.val());
                        tabledata
                            .find("tr:eq(" + trInx + ") td:eq(4)")
                            .text(name_link.val());
                        tabledata.find("tr:eq(" + trInx + ") td:eq(5)").text(status.val());
                        alert("edit suceeded");
                        $(".popup").remove();
                    } else {
                        var tr =
                            "<tr>" +
                            "<td>" +
                            data.id +
                            "</td>" +
                            "<td>" +
                            name.val() +
                            "</td>" +
                            "<td><img src=img/" +
                            photo.val() +
                            " alt=" +
                            photo.val() +
                            "></td>" +
                            "<td>" +
                            od.val() +
                            "</td>" +
                            "<td>" +
                            name_link.val() +
                            "</td>" +
                            "<td>" +
                            status.val() +
                            "</td>" +
                            "<td>" +
                            btnedit +
                            "" +
                            btndel +
                            "</td>" +
                            "</tr>";
                        tabledata.find("tr:eq(0)").after(tr);
                        id.val(data.id + 1);
                        od.val(data.id + 1);
                        name.val("");
                        name.focus();
                        photo.val("");
                        imgBox.css({
                            "background-image": "url(style/gallery.png)",
                        });
                        alert("Data saved");
                    }
                }
                $(".popup").last().remove();
            },
        });
    }

    // save news
    function save_news(eThis) {
        var Parent = eThis.parents(".frm");
        var id = Parent.find("#txt-id");
        var menu_id = Parent.find("#txt-menu_id");
        var title = Parent.find("#txt-title");
        var od = Parent.find("#txt-od");
        var photo = Parent.find("#txt-photo");
        var status = Parent.find("#txt-status");
        var news_link = Parent.find("#txt-news-link");
        var imgBox = Parent.find(".img-box");
        var mname = Parent.find("#txt-menu_id option:selected").text();
        var des = Parent.find("#txt-des");
        if (menu_id.val() == 0) {
            alert("Please select Menu");
            menu_id.focus;
            return;
        } else if (title.val() == "") {
            alert("Please Input Title");
            title.focus;
            return;
        } else if (photo.val() == "") {
            alert("Please Input Photo");
            photo.focus;
            return;
        } else if (des.val() == "") {
            alert("Please Input Description");
            des.focus;
            return;
        }
        var frm = eThis.closest("form.upl");
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: "action/save-news.php",
            type: "POST",
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                body.append(popup);
            },
            success: function(data) {
                if (data.edit == true) {
                    tabledata
                        .find("tr:eq(" + trInx + ") td:eq(1) span")
                        .text(menu_id.val()).mname;
                    tabledata.find("tr:eq(" + trInx + ") td:eq(2) ").text(title.val());
                    tabledata
                        .find("tr:eq(" + trInx + ") td:eq(3) img")
                        .attr("src", "img/" + photo.val() + "");
                    tabledata
                        .find("tr:eq(" + trInx + ") td:eq(3) img")
                        .attr("alt", "" + photo.val() + "");
                    tabledata.find("tr:eq(" + trInx + ") td:eq(4)").text(des.val());
                    tabledata.find("tr:eq(" + trInx + ") td:eq(5)").text(od.val());
                    tabledata.find("tr:eq(" + trInx + ") td:eq(6)").text(status.val());
                    alert("edit suceeded");
                    $(".popup").remove();
                } else {
                    var tr =
                        "<tr>" +
                        "<td>" +
                        data.id +
                        "</td>" +
                        "<td><span class='none'>" +
                        menu_id.val() +
                        "</span>" +
                        mname +
                        "</td>" +
                        "<td>" +
                        title.val() +
                        "</td>" +
                        "<td><img src=img/" +
                        photo.val() +
                        " alt=" +
                        photo.val() +
                        "></td>" +
                        "<td>" +
                        des.val() +
                        "</td>" +
                        "<td>" +
                        od.val() +
                        "</td>" +
                        "<td>1</td>" +
                        "<td>1</td>" +
                        "<td>" +
                        data.post_date +
                        "</td>" +
                        "<td>" +
                        news_link.val() +
                        "</td>" +
                        "<td>" +
                        status.val() +
                        "</td>" +
                        "<td>" +
                        btnedit +
                        "" +
                        btndel +
                        "</td>" +
                        "</tr>";
                    tabledata.find("tr:eq(0)").after(tr);
                    alert("Data saved");
                    id.val(data.id + 1);
                    od.val(data.id + 1);
                    menu_id.val("");
                    menu_id.focus();
                    title.val("");
                    title.focus();
                    des.val("");
                    des.focus();

                    photo.val("");
                    imgBox.css({
                        "background-image": "url(style/gallery.png)",
                    });
                }
                $(".popup").last().remove();
            },
        });
    }


    //get user data
    function get_user_data() {
        // $.ajax({
        //     url: "action/get_menu_data_json.php",
        //     type: "POST",
        //     data: {
        //         s: s,
        //         e: e,
        //         searchfld: txtsearch.val(),
        //         searchval: searchvalue.val(),
        //         opti: searchOpt,
        //     },
        //     // contentType:false,
        //     cache: false,
        //     // processData:false,z
        //     dataType: "json",
        //     beforeSend: function() {
        //         body.append(popup);
        //     },
        //     success: function(data) {
        //         if (data.length == 0) {
        //             alert("Data not found");
        //             tabledata.html(trHead + txt);
        //             $(".popup").last().remove();
        //             return;
        //         } else {
        //             var txt = "";
        //             for (i in data) {
        //                 txt +=
        //                     "<tr>" +
        //                     "<td width=4px>" +
        //                     data[i]["id"] +
        //                     "</td>" +
        //                     "<td >" +
        //                     data[i]["name"] +
        //                     "</td>" +
        //                     '<td width=90px><img src="img/' +
        //                     data[i]["img"] +
        //                     '" alt=' +
        //                     data[i]["img"] +
        //                     "></td>" +
        //                     "<td width=5px>" +
        //                     data[i]["od"] +
        //                     "</td>" +
        //                     "<td width=15px>" +
        //                     data[i]["name_link"] +
        //                     "</td>" +
        //                     "<td width=5px>" +
        //                     data[i]["status"] +
        //                     "</td>" +
        //                     "<td width=120px>" +
        //                     btnedit +
        //                     "" +
        //                     btndel +
        //                     "</td>" +
        //                     "</tr>";
        //             }
        //         }

        //         totalitem.text(data[0]["total"]);
        //         totalpage.text(
        //             Math.ceil(data[0]["total"] / $("#limit-box-data").val())
        //         );
        //         tabledata.html(trHead + txt);

        //         $(".popup").last().remove();
        //     },
        // });

    }
    //save user data
    function save_user_data() {
        var frm = eThis.closest("form.upl");
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: "action/save_user.php",
            type: "POST",
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {

                body.append(popup);
            },
            success: function(data) {
                alert(1);
                // if (data.edit == true) {
                //     tabledata
                //         .find("tr:eq(" + trInx + ") td:eq(1) span")
                //         .text(menu_id.val()).mname;
                //     tabledata.find("tr:eq(" + trInx + ") td:eq(2) ").text(title.val());
                //     tabledata
                //         .find("tr:eq(" + trInx + ") td:eq(3) img")
                //         .attr("src", "img/" + photo.val() + "");
                //     tabledata
                //         .find("tr:eq(" + trInx + ") td:eq(3) img")
                //         .attr("alt", "" + photo.val() + "");
                //     tabledata.find("tr:eq(" + trInx + ") td:eq(4)").text(des.val());
                //     tabledata.find("tr:eq(" + trInx + ") td:eq(5)").text(od.val());
                //     tabledata.find("tr:eq(" + trInx + ") td:eq(6)").text(status.val());
                //     alert("edit suceeded");
                //     $(".popup").remove();
                // } else {
                // var tr =
                //     "<tr>" +
                //     "<td>" +
                //     data.id +
                //     "</td>" +
                //     "<td><img src=img/" +
                //     photo.val() +
                //     " alt=" +
                //     photo.val() +
                //     "></td>" +
                //     "<td>" +
                //     btnedit +
                //     "" +
                //     btndel +
                //     "</td>" +
                //     "</tr>";
                // tabledata.find("tr:eq(0)").after(tr);
                // alert("Data saved");
                // id.val(data.id + 1);
                // od.val(data.id + 1);
                // menu_id.val("");
                // menu_id.focus();
                // title.val("");
                // title.focus();
                // des.val("");
                // des.focus();

                // photo.val("");
                // imgBox.css({
                //     "background-image": "url(style/gallery.png)",
                // });
                // }
                // $(".popup").last().remove();
            },
        });

    }
    //get menu data
    function get_data_menu() {
        var trHead =
            "<tr>" +
            "<th>ID</th>" +
            "<th>Name</th>" +
            "<th>Photo</th>" +
            "<th>OD</th>" +
            "<th>name_link</th>" +
            "<th>Status</th>" +
            "<th>Action</th>" +
            "</tr>";

        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: "action/get_menu_data_json.php",
            type: "POST",
            data: {
                s: s,
                e: e,
                searchfld: txtsearch.val(),
                searchval: searchvalue.val(),
                opti: searchOpt,
            },
            // contentType:false,
            cache: false,
            // processData:false,z
            dataType: "json",
            beforeSend: function() {
                body.append(popup);
            },
            success: function(data) {
                if (data.length == 0) {
                    alert("Data not found");
                    tabledata.html(trHead + txt);
                    $(".popup").last().remove();
                    return;
                } else {
                    var txt = "";
                    for (i in data) {
                        txt +=
                            "<tr>" +
                            "<td width=4px>" +
                            data[i]["id"] +
                            "</td>" +
                            "<td >" +
                            data[i]["name"] +
                            "</td>" +
                            '<td width=90px><img src="img/' +
                            data[i]["img"] +
                            '" alt=' +
                            data[i]["img"] +
                            "></td>" +
                            "<td width=5px>" +
                            data[i]["od"] +
                            "</td>" +
                            "<td width=15px>" +
                            data[i]["name_link"] +
                            "</td>" +
                            "<td width=5px>" +
                            data[i]["status"] +
                            "</td>" +
                            "<td width=120px>" +
                            btnedit +
                            "" +
                            btndel +
                            "</td>" +
                            "</tr>";
                    }
                }

                totalitem.text(data[0]["total"]);
                totalpage.text(
                    Math.ceil(data[0]["total"] / $("#limit-box-data").val())
                );
                tabledata.html(trHead + txt);

                $(".popup").last().remove();
            },
        });
    }

    // GET NEWS data
    function get_news_data() {
        var trHead =
            "<tr>" +
            "<th>ID</th>" +
            "<th>Menu ID</th>" +
            "<th>Title</th>" +
            "<th>Image</th>" +
            "<th>Description</th>" +
            "<th>OD</th>" +
            "<th>click</th>" +
            "<th>UID</th>" +
            "<th>Post Date</th>" +
            "<th>News Link</th>" +
            "<th>status</th>" +
            "<th>Action</th>" +
            "</tr>";

        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: "action/get_news_data_json.php",
            type: "POST",
            data: {
                s: s,
                e: e,
                searchfld: txtsearch.val(),
                searchval: searchvalue.val(),
                opti: searchOpt,
            },
            // contentType:false,
            cache: false,
            // processData:false,
            dataType: "json",
            beforeSend: function() {
                body.append(popup);
            },
            success: function(data) {
                if (data.length == 0) {
                    alert("Data not found");
                    tabledata.html(trHead + txt);
                    $(".popup").last().remove();
                    return;
                }
                var txt = "";
                for (i in data) {
                    txt +=
                        "<tr>" +
                        "<td width=4px>" +
                        data[i]["id"] +
                        "</td>" +
                        "<td><span class='none'>" +
                        data[i]["menuid"] +
                        "</span>" +
                        data[i]["menu_id"] +
                        "</td>" +
                        // '<td><span>' + data[i][menuid] + '</span>' + data[i][menu_id] + '</td>'
                        "<td>" +
                        data[i]["title"] +
                        "</td>" +
                        '<td width=90px><img src="img/' +
                        data[i]["img"] +
                        '" alt=' +
                        data[i]["img"] +
                        "></td>" +
                        "<td >" +
                        data[i]["des"] +
                        "</td>" +
                        "<td width=5px>" +
                        data[i]["od"] +
                        "</td>" +
                        "<td >" +
                        data[i]["click"] +
                        "</td>" +
                        "<td >" +
                        data[i]["uid"] +
                        "</td>" +
                        "<td >" +
                        data[i]["post_date"] +
                        "</td>" +
                        "<td >" +
                        data[i]["news_link"] +
                        "</td>" +
                        "<td width=5px>" +
                        data[i]["status"] +
                        "</td>" +
                        "<td width=120px>" +
                        btnedit +
                        "" +
                        btndel +
                        "</td>" +
                        "</tr>";
                }

                totalitem.text(data[0]["total"]);
                totalpage.text(
                    Math.ceil(data[0]["total"] / $("#limit-box-data").val())
                );
                tabledata.html(trHead + txt);

                $(".popup").last().remove();
            },
        });
    }

    // Show Edit data
    body.on("click", "table tr td .btn-edit", function() {
        var Parent = $(this).parents("tr");
        body.append(popup);
        $(".popup").load(
            "form/" + frm[frmNo],
            function(responseTxt, statusTxt, xhr) {
                if (statusTxt == "success")
                    body.find(".frm .head span").text($(".page-title").text());
                // get_last_id();
                if (frmNo == 2) {
                    getEditNews(Parent);
                } else if (frmNo == 3) {
                    getEditMenu(Parent);
                }

                //  alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
            }
        );
    });

    // Get Edit menu
    function getEditMenu(Parent) {
        var id = Parent.find("td:eq(0)").text().trim();
        var name = Parent.find("td:eq(1)").text().trim();
        var photo = Parent.find("td:eq(2) img").attr("alt");
        var od = Parent.find("td:eq(3)").text().trim();
        var name_link = Parent.find("td:eq(4)").text().trim();
        var status = Parent.find("td:eq(5)").text().trim();
        body.find(".frm #txt-edit-id").val(id);
        body.find(".frm #txt-id").val(id);
        body.find(".frm #txt-name").val(name);
        body.find(".frm #txt-photo", "img/").val(photo);
        body.find(".frm #txt-od").val(od);
        body.find(".frm #txt-Link").val(name_link);
        body.find(".frm #txt-status").val(status);
        body.find(".frm .img-box").css({
            "background-image": "url(img/" + photo + ")",
        });
        trInx = Parent.index();
    }

    // Get date edit news
    function getEditNews(Parent) {
        var id = Parent.find("td:eq(0)").text().trim();
        var menu_id = Parent.find("td:eq(1) span").text().trim();
        // var menuid = Parent.find("span:eq(1)").text().trim();
        var title = Parent.find("td:eq(2) ").text().trim();
        var photo = Parent.find("td:eq(3) img").attr("alt");
        var des = Parent.find("td:eq(4)").text().trim();
        var od = Parent.find("td:eq(5)").text().trim();
        var click = Parent.find("td:eq(6)").text().trim();
        var uid = Parent.find("td:eq(7)").text().trim();
        var post_date = Parent.find("td:eq(8)").text().trim();
        var news_link = Parent.find("td:eq(9)").text().trim();
        var status = Parent.find("td:eq(10)").text().trim();
        body.find(".frm #txt-edit-id-news").val(id);
        body.find(".frm #txt-id").val(id);
        body.find(".frm #txt-photo", "img/").val(photo);
        body.find(".frm #txt-menu_id").val(menu_id);
        // body.find('.frm #txt-menu_id').val(menuid);
        body.find(".frm #txt-title").val(title);
        body.find(".frm #txt-des").val(des);
        body.find(".frm #txt-uid").val(uid);
        body.find(".frm #txt-news_link").val(news_link);
        body.find(".frm #txt-status").val(status);
        body.find(".frm #txt-od").val(od);
        body.find(".frm #txt-click").val(click);
        body.find(".frm .img-box").css({
            "background-image": "url(img/" + photo + ")",
        });

        trInx = Parent.index();
    }

    // body.on("click", "table tr td .btn-Del", function() {
    //     var Parent = $(this).parents("tr");
    //     var eThis = $(this);
    //     if (frmNo == 2) {
    //         save_news(eThis);
    //     } else if (frmNo == 3) {
    //         del_data_menu();
    //     }
    // });

    //upload photo to server
    body.on("change", ".frm .txt-file ", function() {
        var eThis = $(this);
        var Parent = eThis.parents(".frm");
        var frm = eThis.closest("form.upl");
        var frm_data = new FormData(frm[0]);
        var imgBox = Parent.find(".img-box");
        var photo = Parent.find("#txt-photo");
        $.ajax({
            url: "action/upl-img.php",
            type: "POST",
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                body.append(popup);
            },
            success: function(data) {
                photo.val(data.imgPath);
                imgBox.css({
                    "background-image": "url(img/" + data.imgPath + ")",
                });
                $(".popup").last().remove();
            },
        });
    });
});