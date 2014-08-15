function add(n, x){
    var i = parseInt($('#' + n).val());
    i += x;
    if(i < 0){
        i = 0;
    }
    $('#' + n).val(i);
}