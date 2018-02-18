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
        $('<button />').attr('type','button').addClass('btn btn-default').attr('data-dismiss','modal').html(APP.JSMsgs.CLOSE)
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



jQuery.fn.showOnHover = function(options){
    $(this).css('opacity','0');
    return this.hover(
        function(){ $(this).show().css('opacity','1'); }, 
        function(){ $(this).css('opacity','0'); }
    );
};


var general = function () {
    return {
        init: function () {
            $("[data-toggle=tooltip]").tooltip();

            $("[data-toggle=popover]")
                .popover()
                .click(function (e) {
                    e.preventDefault();
                });
            
            toastr.options = {
                closeButton:true,
                timeOut:3000
            }
            
            $('.on-visible').showOnHover();
            
            $('.call').on('click', function(e){
                e.preventDefault();
                alert($(e).attr('href'));
                $.ajax({
                    url:$(e).attr('href'),
                    type: 'GET',
                    data: {},
                    dataType: 'json',
                    success:function(json){
                        var $toast = toastr[json.response](json.title, json.responseText);
                    },
                    error: function(data){
                        var json = $.parseJSON(data);
                        var $toast = toastr[json.response](json.title, json.responseText);
                    }
                }); 
            });
            
            $('.delete-single').on('click', function(e){
                e.preventDefault();
                var $btn = $(this),
                    $ul = $('<ul />'),
                    $message = $('<p />');
                
                $ul.append($('<li />').html('#' + $btn.data('record')))
                $message.append($btn.data('message')).append($ul);
                
                $buttons = $('<button />')
                        .attr('type','button')
                        .attr('data-dismiss','modal')
                        .addClass('btn btn-danger')
                        .html(APP.JSMsgs.ACCEPT)
                        .on('click', function(){
                            $.ajax({
                                url:$btn.attr('href'),
                                type: 'DELETE',
                                //data: { '_token':$('input[name="_token"]:first').val() },
                                dataType: 'json',
                                success:function(json){
                                    toastr.options.onHidden = function(){
                                        window.location.href = json.redirect;
                                    }
                                    var $toast = toastr[json.response](json.title, json.responseText);
                                },
                                error: function(data){
                                    var json = $.parseJSON(data);
                                    var $toast = toastr[json.response](json.title, json.responseText);
                                }
                            });
                        });
                
                $m = $('#modal').getModal({title:$btn.data('title'), body:$message.html(), buttons:$buttons}); 
            });
            
            $('.delete-multiple').on('click', function(){
                
                var $checkboxes = $('.datatable').find('tbody :checked'),
                    $ul = $('<ul />'),
                    $btn = $(this),
                    $buttons = null,
                    $message = $('<p />'),
                    $form = $('#deleteMultiple');
                
                if ($checkboxes.length>0) {
                    $message.append($btn.data('message'));
                    $.each($checkboxes, function(j,k){
                        $ul.append($('<li />').html('#' + $(k).val() + ' - ' + $(k).data('name')))
                    });
                    $message.append($ul);
                    
                    $buttons = $('<button />')
                        .attr('type','button')
                        .attr('data-dismiss','modal')
                        .addClass('btn btn-danger')
                        .html(APP.JSMsgs.ACCEPT)
                        .on('click', function(){
                            $.ajax({
                                url:$form.attr('action'),
                                type: 'DELETE',
                                data: $form.serialize(),
                                dataType: 'json',
                                success:function(json){
                                    toastr.options.onHidden = function(){
                                        $('.datatable').DataTable().ajax.reload(null, false);
                                    }
                                    var $toast = toastr[json.response](json.title, json.responseText);
                                },
                                error: function(data){
                                    var json = $.parseJSON(data);
                                    var $toast = toastr[json.response](json.title, json.responseText);
                                }
                            });
                        }); 
                } else {
                    $message.append($btn.data('no-records-found'));
                }
                
                $m = $('#modal').getModal({title:$btn.data('title'), body:$message.html(), buttons:$buttons}); 
            });
            
           // $('.nav-tabs-count').countNavItems();
            
            $('.selectFilter.select2').each(function(i,j){
                var $obj;
                $obj = $(this);
                 
                $obj.select2({
                    ajax: {
                        url: APP.BASE_URL+'/'+$obj.attr('uri'),
                        dataType: 'json',
                        delay: 250,
                        data: function(params){
                            var $return = {};
                            var $filterBy = $('#'+$obj.data('filtered-by'));
                            if ($filterBy.length) {
                                $return[$filterBy.attr('name')] = $filterBy.val();
                            }
                            $return.q = params.term;
                            $return.page = params.page;
                            return $return;
                        },
                        processResults: function (data, page){
                            return{
                                results: data.items
                            };
                        },
                        cache: true
                    },
                    id: function(data){ return data.id; },
                    escapeMarkup: function (markup) { return markup; },
                    minimumInputLength: 1,
                    templateResult: function formatRepo(repo){
                        if (repo.loading) return repo.text;
            
                        return markup.html($obj.attr('type'),repo);
                    },
                    templateSelection:function formatRepoSelection(repo){
                        return repo.text;
                    }
                });
                
                var $_callback = $obj.data('function-callback');
                
                if (typeof $_callback != 'undefined') {                    
                    $obj.on('change', function(){
                        $('body')[$_callback]({customer_id: $('#customer_id').val()});
                    });
                }
                
                var $_filterField = $('#'+$obj.data('filter-field'));
                
                if ($_filterField.length) {
                    $obj.on('change', function(){
                        $_filterField.trigger('change');
                    });
                }
                
            });
        }
    };
}();

$(function () {
    "use strict";
    general.init();
    
    $('.currency').mask("#.##0.00", {reverse: true});
});