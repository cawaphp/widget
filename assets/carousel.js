var $ = require("jquery");
require("slick-carousel");

$.widget("cawa.carousel", $.cawa.widget, {

    options: {
        dots: true
    },

    _create: function ()
    {
        this.element
            .on('init', function() {
                $(this).css('visibility', 'visible');
            })
            .slick(this.options);
    }
});

