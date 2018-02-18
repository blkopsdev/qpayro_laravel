jQuery.fn.getModal = function(options){
    var defaults = {
        title: null,
        body: null,
        size: 'medium',
        buttons: null
    };
    var opts = $.extend(defaults, options);
    
    var m = $(this).modal();
    
    m.find('.modal-dialog').removeClass('modal-lg');
    
    if(opts.size=='large'){
        m.find('.modal-dialog').addClass('modal-lg');
    }
    
    m.find('.modal-title').html(opts.title);
    m.find('.modal-body').html(opts.body);
    
    m.find('.modal-footer').empty().append(
        $('<button />').attr('type','button').addClass('btn btn-default').attr('data-dismiss','modal').html('Cerrar')
    );
    
    if (opts.buttons !== null){
        if(opts.buttons.length>0) {
        m.find('.modal-footer').prepend(
            opts.buttons  
        );
        }
    }
    
    /*m.on('hidden', function () {
        window.location.href = json.redirect;
    })*/
                
    return m;
};
