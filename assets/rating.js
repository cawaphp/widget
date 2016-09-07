require([
    "jquery",
    "cawaphp/cawa/assets/widget"
], function($)
{
    $.widget("cawa.rating", $.cawa.widget, {


        options: {
            round: -1,
            ajax: {
                type: 'GET',
                url: window.location.pathname,
                dataType: "json"
            },
            query: 'note'
        },

        _default: null,
        _count : null,
        _percent: null,

        _create: function ()
        {
            var self = this;
            var top = this.element.find('.top');
            self._count = this.element.find('.top *').length;
            self._default = top.css('width');

            if (!this.element.hasClass('readOnly')) {
                this.element.on('mousemove', function(event) {
                    self._percent = self._round((event.pageX - $(this).offset().left) * 100 / $(this).width(), 2);
                    top.css('width', self._percent + '%');
                });

                this.element.on('mouseleave', $.proxy(self._revert, self));

                this.element.find('a').on('click', function ()
                {
                    if (self.options.round >= 0) {
                        self._sumbit(self._percent);
                    } else {
                        self._sumbit(Math.round(self._percent / self._count));
                    }
                })
            }
        },

        _revert: function()
        {
            var top = this.element.find('.top');
            top.css('width', this._default);
        },

        _round : function(number)
        {
            number = Math.abs(number);
            var factor = Math.pow(10, this.options.round >= 0 ? this.options.round  : 2);
            var tempNumber = number * factor;
            var roundedTempNumber = Math.round(tempNumber);
            var finalRounded = roundedTempNumber / factor;

            if (finalRounded > 100) {
                finalRounded = 100;
            }

            if (this.options.round >= 0) {
                return finalRounded;
            }

            return Math.round(Math.round(finalRounded / this._count) * this._count);
        },

        _sumbit: function(note)
        {
            var self = this;
            var options = this.options.ajax;

            options.data = {};
            options.data[this.options.query] = note;

            $.ajax(options)
                .done(function (result, textStatus, xhr)
                {
                    self._trigger('submit', {note: note});
                })
                .fail(function (xhr, textStatus, errorThrown)
                {
                    self._trigger('failed', {note: note});
                    self._revert();
                })
        }
    });
});
