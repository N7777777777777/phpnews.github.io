$(document).ready(function() {

    var s = $("#txt-s");
    var e = $("#txt-e");
    var btn_more = $(".btn-more");
    var totaldata = $("#txt-total-data");
    var con = $("#txt-con");
    var baseurl = $("#txt-url").val();

    $(".btn-more").click(function() {
        s.val(parseInt(s.val()) + parseInt(e.val()));
        var eThis = $(this);
        var txt = "";
        $.ajax({
            url: "home/action/get-news.php",
            type: "POST",
            data: { s: s.val(), e: e.val(), con: con.val() },
            // contentType: false,
            cache: false,
            // processData: false,

            dataType: "json",
            beforeSend: function() {
                eThis.html("<i class='fa fa-spinner fa-spin'>Waitting..... </i>");
                eThis.css({ "pointer-events": "none" });

            },
            success: function(data) {
                var numData = data.length;
                for (var i = 0; i < numData; i++) {
                    txt +=
                        "<a class='item-box'>" +
                        "<div class='img-box' id='bg-img' style='background-image:url(" + baseurl + "admin/img/ " +
                        data[i].img +
                        "); '></div>" +
                        "<div class='txt-box'>" +
                        "<h1>" +
                        data[i].title +
                        "</h1>" +
                        "<p>" +
                        data[i].des +
                        "</p>" +
                        "<h3>" +
                        data[i].menu_id +
                        "--" +
                        data[i].id +
                        "</h3></div>" +
                        "</a>";
                }
                eThis.parent(this).before(txt);
                eThis.html("More....");
                eThis.css({ "pointer-events": "auto" });

                totaldata.val(parseInt(totaldata.val()) - parseInt(e.val()));
                if (totaldata.val() <= 0) {
                    eThis.parent().hide();
                }
            },
        });
    });

    //btn-next
    $(".btn-next").click(function() {
        alert("hi");
    });
});