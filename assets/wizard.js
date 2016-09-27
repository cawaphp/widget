require([
    "jquery",
    "perfect-scrollbar",
    "cawaphp/cawa/assets/widget"
], function($, ps)
{
    $.widget("cawa.wizard", $.cawa.widget, {

        options: {
            dots: true
        },

        _create: function ()
        {
            ps.initialize(this.element.find('.steps-container')[0],  {
                suppressScrollY : true,
                useBothWheelAxes: true
            });
        }
    });
});


