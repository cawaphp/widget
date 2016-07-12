require([
    "jquery",
    "cawaphp/cawa/assets/widget",
    "slick-carousel"
], function($)
{
    $.widget("cawa.carousel", $.cawa.widget, {

        options: {
            dots: true
        },

        _create: function ()
        {
            this.element
                .on('init', function ()
                {
                    $(this).css('visibility', 'visible');
                })
                .slick(this.options);
        }
    });
});
