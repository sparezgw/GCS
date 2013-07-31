$(document).on("pageinit", function() {
    $("#add").click(function() {
        var content = "<li><a href='#'>Ferrari</a></li>";
        $("#set").append( content ).listview('refresh');
    });

    $("#allClient li").on( "click", function() {
        var $item = $(this);
        var pid = $item.attr('data-id');
        var content = "<li data-id='" + pid + "'><a href='/client/" + pid + "'>" + $item.text() + "</a><a href='javascript:remove(" + pid + ")' /></li>";
        $("#familyMember").append(content).listview('refresh');
        $(this).css( "display", "none" );
        $("#allClient").listview('refresh');
    });
    
    $("#expand").click(function() {
        $("#set").children(":last").trigger( "expand" );
    });
    $("#collapse").click(function() {
        $("#set").children(":last").trigger( "collapse" );
    });

    $('button[name="cardAdd"]').on("click", function() {
        var fam = $("#familyMember li").map(function() {
            var li = $.makeArray(this);
            return $(li).attr("data-id");
        }).get().join();
        $('input[name="family"]').val(fam);
    })
});

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
function back(pid) {
    $clientItem = $("#allClient li[data-id='" + pid + "']");
    $clientItem.remove();
    $("#allClient").listview('refresh');

    $familyItem = $("#familyMember li[data-id='" + pid + "']");
    $familyItem.css( "display", "list-item" );
    $("#familyMember").listview('refresh');
}
