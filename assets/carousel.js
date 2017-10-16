require([
    "jquery",
    "swiper",
    "cawaphp/cawa/assets/widget"
], function($, Swiper)
{
    $.widget("cawa.carousel", $.cawa.widget, {

        options: {
            plugin: {
                direction: 'horizontal'
            }
        },

        _create: function ()
        {
            var options = this.options.plugin;

            if (this.element.find('.swiper-button-next').length && this.element.find('.swiper-button-prev').length) {
                if (!options.navigation) {
                    options.navigation = {};
                }

                options.navigation.nextEl = this.element.find('.swiper-button-next')[0];
                options.navigation.prevEl = this.element.find('.swiper-button-prev')[0];
            }

            if (this.element.find('.swiper-scrollbar').length) {
                if (!options.scrollbar) {
                    options.scrollbar = {};
                }

                options.scrollbar.el = this.element.find('.swiper-scrollbar')[0];
            }

            if (this.element.find('.swiper-pagination').length) {
                if (!options.pagination) {
                    options.pagination = {};
                }
                options.pagination.el = this.element.find('.swiper-pagination')[0];
            }

            new Swiper(this.element[0], options);
        }
    });
});
