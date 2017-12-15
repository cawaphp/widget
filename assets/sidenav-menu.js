require([
    "jquery",
    "velocity",
    "cawaphp/cawa/assets/widget"
], function($)
{
    $.widget("cawa.sidenav-menu", $.cawa.widget, {
        /**
         * @private
         */
        _create: function ()
        {
            var self = this;
            var element = this.element;

            if (self.options.selectedSection) {
                this.element.find(self.options.selectedSection).addClass('active no-transition');
            }

            if (self.options.selectedLink) {
                this.element.find(self.options.selectedLink).addClass('active no-transition');
            }

            this.element.find('section.cawa-sidenav-section ul li a').on('click', function () {
                var link = $(this);
                var section = element.find('#' + link.data('sectionTarget'));
                var sectionActive = element.find('section.active');

                self.element.trigger('click.sidenav-menu', [link]);

                section
                    .addClass('active')
                    .one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd', function () {
                        sectionActive.removeClass('active');
                        self.element.trigger('sectionChanged.sidenav-menu', {
                            section: section,
                            link: link
                        });
                    });
            });
        }
    });
});


