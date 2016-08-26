var chooseDemo = function(idx) {
    // reset
    $("#result").html();
    var params = {};
    
    // set parameters
    switch (idx) {
        case 0:
            break;
        case 1:
            params = {reference:"1. Buch Mose 6:5-7"};
            break;
        case 2:
            params = {log:true,book:32};
            break;
        case 3:
            params =  {log:true,book:1,chapter:6};
            break;
        case 4:
            params = {
                log:true,
                book:1,
                chapter:1,
                verses:1
            };
            break;
        case 5:
            params = {
                log:true,
                book:1,
                chapter:1,
                verses:"1-4"
            };
            break;
    } 
    
    // async call for scripture
    $.get( "php/getScripture.php", params, function( data ) {
        if (idx == 0) 
            $("#intro .result").html(data);
        else
            $("#demo"+idx+" .result").html(data);
    });
}