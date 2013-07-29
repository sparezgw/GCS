$(document).on("pageinit", function() {
    $("#add").click(function() {
        var content = "<li><a href='#'>Ferrari</a></li>";
        $("#set").append( content ).listview('refresh');
    });
    // $(".mem").click(function() {
        
    //     var $item = $(this);
    //     // $(this).prop({disabled: true});
    //     // $(this).removeClass("mem");
    //     var content = "<li><a href='" + $item.attr('data-href') + "'>" + $item.html() + "</a></li>";
        
        
    //     $("#member").append( content ).listview('refresh');
    //     // $(this).parent("li").remove();
    //     $("#all").listview('refresh');
    // });

    $("#all li").on( "click", function() {
        var $item = $(this);
        var content = "<li><a href='" + $item.attr('data-href') + "'>" + $item.text() + "</a></li>";
        $("#member").append(content).listview('refresh');
        $(this).remove();
        // $(this).css( "display", "none" );
        $("#all").listview('refresh');
    });
    $("#expand").click(function() {
        $("#set").children(":last").trigger( "expand" );
    });
    $("#collapse").click(function() {
        $("#set").children(":last").trigger( "collapse" );
    });
});