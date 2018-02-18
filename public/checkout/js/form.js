var Form = function () {
    return {
        init: function () {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            // Colored switches
            var blue = document.querySelector('.js-switch-blue');
            var switchery = new Switchery(blue, {
                color: '#17c3e5'
            });
            
            var green = document.querySelector('.js-switch-green');
            var switchery = new Switchery(green, {
                color: '#2dcb73'
            });
        }
    };
}();

$(function () {
    "use strict";
    Form.init();
});