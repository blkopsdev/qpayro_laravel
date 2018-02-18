$(function(){

    $('#formPayment').submit(function(e){
        $("input[type='submit']", this)
        .attr('disabled', 'disabled');
        
        e.preventDefault();
        $parsley = $(this).parsley();
        $parsley.reset();
        $(this).find('.parsley-errors-list').empty();
        if($parsley.validate()){

            var $form = $(this);

            var $preprocess = $.ajax({
                url:APP.BASE_URL+'/preprocess',
                type:$form.attr('method'),
                data:$form.serialize(),
                beforeSend: function(){
                    $('#paymentButton').prop('disabled', true);
                    $.isLoading({
                        tpl: '<span class="isloading-wrapper btn btn-info btn-lg btn-rounded %wrapper%"><span><b>%text%</b> <i class="%class% fa-spin"></i></span>',
                        class: 'fa fa-circle-o-notch fa-1x fa-fw',
                        text:APP.JSMsgs.PROCESSING,
                        disableOthers: [
                            $( "#paymentButton" )
                        ]
                    });
                }
            });

            $preprocess.done(function(data, textStatus, jqXHR){

                 if (jqXHR) {
                    var json = $.parseJSON(jqXHR.responseText);
                    $('#x_fp_hash').val(json.x_fp_hash);
                }

                var $process = $.ajax({
                    url:$form.attr('action'),
                    type:$form.attr('method'),
                    data:$form.serialize(),
                    dataType: 'json',
                    timeout:25000,
                    /** beforeSend: function(){
                        $('#paymentButton').prop('disabled', true);
                        //alert($('#paymentButton').attr('id'));
                        $.isLoading({
                            tpl: '<span class="isloading-wrapper btn btn-info btn-lg btn-rounded %wrapper%"><span><b>%text%</b> <i class="%class% fa-spin"></i></span>',
                            class: 'fa fa-circle-o-notch fa-1x fa-fw',
                            text:"Procesando pago...",
                            disableOthers: [
                                $( "#paymentButton" )
                            ]
                        });
                    } **/
                });

                $process.done(function(data, textStatus, jqXHR) {
                    $.isLoading('hide');
                    if (jqXHR) {
                    var json = $.parseJSON(jqXHR.responseText);

                        if (json.redirect) {
                            /*toastr.options.onHidden = function(){
                                window.location.href = json.redirect;
                            };*/
                            $('#paymentButton').prop('disabled', false);
                            $('#modal').on('hidden.bs.modal', function(){
                                window.location.href = json.redirect;
                            });
                            if(json.forceRedirect){
                                setTimeout( function(){ window.location.href = json.redirect; }, 6000 );
                            }
                        }

                        if(json.result){
                            $('#paymentButton').prop('disabled', true);
                            toastr.options.onHidden = function(){
                                window.location.href = json.redirect;
                            };
                            toastr.success(json.responseText, json.title);
                            setTimeout( function(){ window.location.href = json.redirect; }, 3000 );

                        } else {
                            $('#paymentButton').prop('disabled', false);
                            var html = '<p class="alert alert-warning">';
                                html += json.responseText +' (Error #' + json.responseCode + ')';
                                html += '</p>';

                            $('#modal').getModal({title:json.title,body:html});
                        }

                    }

                })

                $process.fail(function(jqXHR, textStatus, errorThrown){
                    if(textStatus==="timeout"){
                        var $revert = $.ajax({
                            url:APP.BASE_URL+'/revert',
                            type:$form.attr('method'),
                            data:$form.serialize(),
                            dataType: 'json',
                            timeout:10000,
                        }).done(function(data, textStatus, jqXHR){
                            $.isLoading('hide');
                            $('#modal').getModal({title:"Error",body:'<p class="alert alert-warning"><i class="fa fa-info-circle"></i> La transacción no pudo ser completada, no se encontró respuesta del servicio, por favor intente nuevamente.</p>'});
                        }).fail(function(jqXHR, textStatus, errorThrown){
                            $.isLoading('hide');
                            $('#modal').getModal({title:"Error",body:'<p class="alert alert-warning"><i class="fa fa-info-circle"></i> La transacción no pudo ser completada, no se encontró respuesta del servicio, por favor intente nuevamente.</p>'});
                        });
                    } else if(jqXHR.responseText){
                        $.isLoading('hide');
                        var errors = $.parseJSON(jqXHR.responseText);

                        $.each(errors, function(index, value) {
                            var $field = $('input[name="'+index+'"]').parsley();
                            window.ParsleyUI.removeError($field, index);
                            window.ParsleyUI.addError($field, index, value);
                        });
                        $('#modal').getModal({title:"Error",body:'<p class="alert alert-warning"><i class="fa fa-info-circle"></i> El formulario contiene errores y la petición no ha podido ser validada, favor revisa la información ingresada e intenta de nuevo.</p>'});

                    } else {
                        $.isLoading('hide');
                        $('#modal').getModal({title:"Error",body:'<p class="alert alert-warning"><i class="fa fa-info-circle"></i>No se ha podido establecer comunicación con el servicio, por favor intenta nuevamente.</p>'});
                    }
                });

            });

        }
    });

    var formMasks = function () {

        function plugins() {
            $.mask.definitions['~'] = "[+-]";

            $("#amount").mask("*.99");
        }

        return {
            init: function () {
                plugins();
            }
        };
    }();

    $(function () {
        "use strict";
        formMasks.init();
    });

    $(function() {

        $('.cc_exp').on('load change', function(){
            $('#expiryDate').val(
                $('#monthExp').val() +
                '/' +
                $('#yearExp').val().substring(2,4)
            ).trigger('change');
        });

        var clickCheckbox = document.querySelector('.js-check-click');

        if($('#creditCardNo').length){
            $('#creditCardNo').validateCreditCard(function(result) {
                if (result.valid && result.length_valid && result.luhn_valid) {
                    $('#creditCardIcons div#credit-card-'+(result.card_type !== null ? result.card_type.name:'')).addClass('btn-success');
                    $('#creditCardType').val(result.card_type.name);
                    if(result.card_type.name=='visa'){
                        $('#visaEnCuotas').show().removeClass().addClass('fadeInLeft animated');

                        if(clickCheckbox !== null) {
                            if(clickCheckbox.checked)
                                $('#visaEnCuotas').iCheck('enable'); else $('#visaEnCuotas').iCheck('disable');
                        }
                    } else {
                        $('#visaEnCuotas').hide().removeClass().addClass('fadeOutRight animated').iCheck('disable');
                        //find('radio').prop('disabled', true);
                    }
                } else {
                    $('#creditCardIcons div').attr('class','btn').addClass('btn-default');
                    $('#creditCardType').val('');
                    $('#visaEnCuotas').hide().removeClass().addClass('fadeOutRight animated').iCheck('disable');
                    //.find('radio').prop('disabled', true);
                }
                /*$('.log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name)
                         + '<br>Valid: ' + result.valid
                         + '<br>Length valid: ' + result.length_valid
                         + '<br>Luhn valid: ' + result.luhn_valid);*/
            });
        }

        if(clickCheckbox !== null) {
            $('#vcCheck').bind('click',function(){
                $e = $(this);
                if(clickCheckbox.checked){
                    $('#visaEnCuotas').iCheck('enable');
                } else {
                    $('#visaEnCuotas').iCheck('disable');
                }
            });
        }

        $('#sameAsBilling').bind('click', function(){
            $cb = $(this);
            if($cb.is(':checked')){

                $('#formPayment .copyTo').each(function(){
                    $i = $(this);

                    $('#'+$i.attr('copy-to')).val(this.value);
                    $(this).bind('change', function(){
                        $i = $(this);
                        $('#'+$i.attr('copy-to')).val(this.value);
                    });
                });
            } else {
                $('#formPayment .copyTo').unbind('change');
            }
        });

        $('#x_price').on('change click', function(e){
            e.preventDefault();
            
            var qty = ($('#x_quantity').lenght) ? $('#x_quantity').val() : 1;
            //alert($('#x_freight').val);
            var freight = ($('#x_freight')) ? parseFloat($('#x_freight').val()) : 0;
            
            var total = parseFloat(qty) * parseFloat($('#x_price').val()) + parseFloat(freight);
            $('#x_amount').val( total );
            $('#text_total span').text(total.toFixed(2));

        });

        $('.spinner-input').bind('click', function(c){
            var qty = parseInt($(this).val());
            $('#x_quantity').val(qty);

            var total = $('#x_quantity').val() * parseFloat($('#x_price').val()) + parseFloat($('#x_freight').val());
            $('#x_amount').val( total );

            $('#text_total span').text(total.toFixed(2));

        });

    });

    $('#modalCVV').click(function(c){
        c.preventDefault();
        var a = $(this);
        $.ajax({
            url: a.attr('href'),
            dataType: 'html',
        }).done(function(html){ $('#modal').getModal({title:a.attr('title'),body:html}); });
    });

});
