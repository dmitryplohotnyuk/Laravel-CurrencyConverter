$('#exchange').on('click',function() {
    var value = $('#value').val();
    $.get("privatbank?value=" + value, function(data){
        var result = jQuery.parseJSON(data);
        $('#uah').val(result);
    });
});

