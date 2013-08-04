$(document).on("pageinit", function() {
    $("#allClient li").on( "click", function() {
        var $item = $(this);
        var pid = $item.attr('data-id'), name = $.trim($item.text());
        var content = "<li data-id='" + pid + "'><a href='/client/" + pid + "'>" + name + "</a><a href='javascript:remove(" + pid + ")' >移除 " + name + "</a></li>";
        $("#familyMember").append(content).listview('refresh');
        $(this).css( "display", "none" );
        $("#allClient").listview('refresh');
    });

    $("button[name='edit']").on("click", function() {
        var fam = $("#familyMember li:visible").map(function() {
            var li = $.makeArray(this);
            return $(li).attr("data-id");
        }).get().join();
        $('input[name="family"]').val(fam);
    })

    $("#newMember a:first-of-type").click(function () {
        var post = $("#newMember form").serialize();
        $.post("/api/add/p", post,
            function(data) {
                var content = "<li data-id='" + data.id + "'><a href='/client/" + data.id + "'>" + data.name + ", " + data.info + "</a><a href='javascript:remove(" + data.id + ")' >移除 </a></li>";
                $("#familyMember").append(content).listview('refresh');
        }, "json");
    });
});

// remove the item from selected family member list
function remove(pid) { 
    $familyItem = $("#familyMember li[data-id='" + pid + "']");
    var name = $.trim($familyItem.children().text());
    $familyItem.css( "display", "none" );
    $("#familyMember").listview('refresh');

    $clientItem = $("#allClient li[data-id='" + pid + "']");
    if ($clientItem.is("li")) {
        $clientItem.css( "display", "list-item" );
    } else{
        var content = '<li data-icon="plus" data-id="'+pid+'"><a href="javascript:back('+pid+')">'+name+'</a></li>';
        $("#allClient li:first").after(content);
    };
    
    $("#allClient").listview('refresh');
    
}

// set back the item which already remove from the list
function back(pid) {
    $clientItem = $("#allClient li[data-id='" + pid + "']");
    $clientItem.remove();
    $("#allClient").listview('refresh');

    $familyItem = $("#familyMember li[data-id='" + pid + "']");
    $familyItem.css( "display", "list-item" );
    $("#familyMember").listview('refresh');
}
