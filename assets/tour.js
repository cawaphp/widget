require([
    "jquery",
    "tether-shepherd",
    "cawaphp/cawa/assets/widget"
], function($, shepherd)
{
    $.widget("cawa.tour", $.cawa.widget, {

        options: {
            initSelector: '[data-tour]',
            defaults: {
                classes: 'shepherd-theme-arrows',
                scrollTo: true
            },
            buttons: [
                {
                    text: '✖',
                    action: 'cancel',
                    classes: 'light'
                },
                {
                    text: '❰',
                    action: 'back',
                    classes: 'light'
                },
                {
                    text: '❱',
                    action: 'next'
                }
            ]
        },


        _create: function ()
        {
            var self = this;

            var defaults = {
                defaults: this.options.defaults
            };
            var tour = new shepherd.Tour(defaults);

            var i = 0;
            $.each(this.options.steps, function(key, step)
            {
                var currentStep = $.extend(true, {}, step);

                currentStep.buttons = typeof currentStep.buttons === "undefined" ? $.extend(true, [], self.options.buttons) : step.buttons;

                $.each(currentStep.buttons, function(key, button)
                {
                    if (i === 0 && button.action === 'back') {
                        delete currentStep.buttons[key];
                        return true;
                    }

                    button.action = tour[button.action];
                    currentStep.buttons[key] = button;
                }) ;

                currentStep.scrollToHandler = self._scrollHandler;

                var attachTo =  currentStep.attachTo.split(" ");
                currentStep.attachTo = {
                    on: attachTo.pop(),
                    element: $(attachTo.join(' '))[0]
                };

                if (currentStep.advanceOn) {
                    var advanceOn =  currentStep.advanceOn.split(" ");
                    currentStep.advanceOn = {
                        event: advanceOn.pop(),
                        selector: advanceOn.join(' ')
                    };
                }

                tour.addStep(key, currentStep);
                i++;
            });

            tour.start();
        },

        _scrollHandler: function (target)
        {
            target = $(target);

            var topOfElement = target.offset().top;
            var heightOfElement = target.height();

            $('html, body').animate({
                scrollTop: topOfElement - heightOfElement
            }, {
                duration: 200
            });
        }
    });
});


