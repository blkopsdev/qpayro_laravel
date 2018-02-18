$(function(){

    $('#formSuccess').submit(function(e){
        var $form = $(this);
        
        var $flush = $.ajax({
            url:APP.BASE_URL+'/complete',
            type:$form.attr('method'),
            data:{}
        });

        $flush.done(function(data, textStatus, jqXHR){
            $form.unbind('submit').submit();
        });
    });
    
    $('.submit-form').click(function(c){
       if($('#formSuccess')){
            $('#formSuccess').submit();
       }
    });

});
