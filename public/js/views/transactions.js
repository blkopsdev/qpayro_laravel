$(function(){
    
    $('.item-view').click(function(e){
        e.preventDefault();
        
        var $ajax = $.ajax({
            url:$(this).attr('href'),
            type:'GET',
            dataType:'html',
            data:{},
            beforeSend: function(){
                $(".loadersjew").show();
                /*$.isLoading({
                    tpl: '<span class="isloading-wrapper btn btn-info btn-lg btn-rounded %wrapper%"><span><b>%text%</b> <i class="%class% fa-spin"></i></span>',
                    class: 'fa fa-circle-o-notch fa-1x fa-fw',
                    text:"Cargando...",
                    disableOthers: [
                    ]
                });*/
            }
        }).done(function(data, textStatus, jqXHR){
            $(".loadersjew").fadeOut("slow");
            
            $('#modal').getModal({title:'Detalle de transacción',body:data});
            
        }).fail(function(jqXHR, textStatus, errorThrown){
            alert('fail to load data');
        });
        
        
	});
    
});