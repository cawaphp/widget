require([
    "jquery",
    "chart.js",
    "moment",
    "cawaphp/cawa/assets/widget"
], function($, Chart, moment)
{
    $.widget("cawa.charts", $.cawa.widget, {

        _create: function ()
        {
            $.forEach(this.options.globalOptions, function(value, key)
            {
                Chart.defaults.global[key] = value;
            });

            Chart.defaults.global.responsive = true;
            Chart.defaults.global.animation = 0;
            Chart.defaults.global.hover.mode = 'index';
            Chart.defaults.global.hover.intersect = false;
            Chart.defaults.global.tooltips.mode = 'label';
            Chart.defaults.global.elements.line.borderWidth = 1;
            Chart.defaults.global.elements.rectangle.borderWidth = 1;
            Chart.defaults.global.defaultColor = 'rgba(54, 162, 235, 0.2)';

            new Chart(this.element, this.options.plugin);
        }
    });
});
