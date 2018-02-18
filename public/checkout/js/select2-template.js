$(function(){
    markup = {
        
        html: function(type, repo){
            var t;
            switch(type){
                case 'branch':
                    t = '<div class="clearfix">' +
                    '<div clas="col-sm-10">' +
                        '<div class="col-sm-6">' + repo.text + '</div>' +
                        '<div class="col-sm-3"><i class="ti-address"></i> ' + repo.tax_id + '</div>' +
                    '</div>' +
                    '</div>';
                    break;
                case 'vehicle':
                    t = '<div class="clearfix">' +
                    '<div clas="col-sm-10">' +
                        '<div class="col-sm-4">' + repo.text + '</div>' +
                        '<div class="col-sm-4">' + APP.JSMsgs.REG_NUMBER + ': ' + repo.reg_number + '</div>' +
                        '<div class="col-sm-4">' + APP.JSMsgs.VIN_NUMBER + ': ' + repo.vin_number + '</div>' +
                    '</div>' +
                    '</div>';
                    break;
                case 'customer':
                    t = '<div class="clearfix">' +
                    '<div clas="col-sm-10">' +
                        '<div class="col-sm-6">' + repo.text + '</div>' +
                        '<div class="col-sm-3"><i class="ti-receipt"></i> ' + repo.tax_id + '</div>' +
                        '<div class="col-sm-3"><i class="ti-mobile"></i> ' + repo.phone + '</div>' +
                    '</div>' +
                    '</div>';
                break;
                default:
                    t = '';
            }
            
            return t;
            
        }

    }
});