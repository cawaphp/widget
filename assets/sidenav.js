require([
    "jquery",
    "hammerjs",
    "velocity",
    "cawaphp/cawa/assets/widget"
], function($, Hammer)
{
    $.widget("cawa.sidenav", $.cawa.widget, {
        options: {
            edge: 'left',
            draggable: true,
            overlay: true
        },

        _menuOut: false,
        _panning: false,
        _menuWidth: null,
        _dragTarget: null,
        _overlay: null,

        /**
         * @private
         */
        _create: function ()
        {
            var self = this;

            this._addBackgroundElements();
            this._handleResize();

            if (this.element.hasClass('active')) {
                this.display();
            }

            this.element.find('button.close').on('click', function ()
            {
                self.hide();
            });

            if (self.options.draggable) {
                this._handleDrag();
            }
        },

        /**
         * @private
         */
        _handleResize: function()
        {
            var self = this;
            var element = this.element;

            var resize = function()
            {
                self._menuWidth = element.width();
            };

            self.addDestroyCallback(function()
            {
                $(window).off('resize', resize);
            });

            $(window).on('resize', resize);
            resize();
        },

        /**
         * @private
         */
        _addBackgroundElements: function ()
        {
            var self = this;
            var body = $('body');

            // Add Overlay
            if (self.options.overlay) {
                this._overlay = $('<div class="cawa-sidenav-overlay"></div>')
                    .css('opacity', 0)
                    .addClass('hidden')
                    .click( function(){
                        self._removeMenu();
                    });

                body.append(this._overlay);
            } else {
                this._overlay = $();
            }

            // Add Touch Area
            if (self.options.draggable) {
                this._dragTarget = $('<div class="cawa-sidenav-drag-target"></div>')
                    .on('click', function(){
                        self._removeMenu();
                    })
                ;

                if (self.options.edge === 'left') {
                    self._dragTarget.css({'left': 0}); 
                }
                else {
                    self._dragTarget.css({'right': 0});
                }

                body.append(this._dragTarget);
            } else {
                this._dragTarget = $();
            }
        },

        /**
         * Toggle menu
         *
         * @returns {boolean}
         */
        toggle: function() {
            if (this._menuOut === true) {
                this.hide();
                return false;
            }
            else {
                this.show();
                return true;
            }
        },

        /**
         * Hide Menu
         *
         * @returns {boolean}
         */
        hide: function() {
            if (this._menuOut === false) {
                return false;
            }

            this._removeMenu();

            return true;
        },

        /**
         * Show Menu
         *
         * @returns {boolean}
         */
        show: function() {
            var self = this;
            var element = this.element;

            if (self._menuOut === true) {
                return false;
            }

            if (self.options.edge === 'left') {
                element.velocity({'translateX': [0, -self._menuWidth]}, {duration: 200, queue: false, easing: 'easeOutQuad'});
            }
            else {
                element.velocity({'translateX': [0, self._menuWidth]}, {duration: 200, queue: false, easing: 'easeOutQuad'});
            }

            self._showBackgroundElements(false);

            return true;
        },

        /**
         * Show Menu
         *
         * @returns {boolean}
         */
        display: function() {
            if (!this.element.hasClass('active')) {
                this.element.addClass('active')
            }

            this.element
                .css('transform', this.element.css('transform'))
                .removeClass('active')
            ;

            this._showBackgroundElements(true);

            this._menuOut = true;
        },

        /**
         * @private
         */
        _handleDrag: function()
        {
            var self = this;
            var element = this.element;

            var hammer = new Hammer(this._dragTarget[0], {
                prevent_default: false
            });

            var analyse = function(e)
            {
                var position,
                    overlay,
                    closing = false,
                    opening = false,
                    x = e.center.x,
                    y = e.center.y;

                if (self.options.edge === 'left') {
                    position = (x - self._menuWidth);

                    // Keep within boundaries
                    if (position > 0) {
                        position = 0;
                    } else if (position < -self._menuWidth) {
                        position = -self._menuWidth;
                    }
                } else {
                    position = (self._menuWidth - (window.innerWidth - x));

                    // Keep within boundaries
                    if (position < 0) {
                        position = 0;
                    } else if (position > self._menuWidth) {
                        position = self._menuWidth;
                    }
                }

                if (self.options.edge === 'left') {
                    overlay = x / self._menuWidth;

                    if (x < (self._menuWidth / 2)) {
                        closing = true;
                    } else if (x >= (self._menuWidth / 2)) {
                        opening = true;
                    }
                } else {
                    overlay = Math.abs((x - window.innerWidth) / self._menuWidth);

                    if (x < (window.innerWidth - self._menuWidth / 2)) {
                        opening = true;
                    }
                    else if (x >= (window.innerWidth - self._menuWidth / 2)) {
                        closing = true;
                    }
                }

                if (Math.abs(e.velocityX) > 0.5) {
                    if (self._menuOut === false) {
                        opening = true;
                    } else {
                        closing = true;
                    }
                }

                return {
                    x: x,
                    y: y,
                    position: position,
                    overlay: overlay,
                    closing: closing,
                    opening: opening === false && closing === false ? true : opening
                }
            };

            hammer.on('pan', function (e) {
                if (e.pointerType === "touch") {
                    var current = analyse(e);

                    element.css('transform', 'translateX(' + current.position + 'px)');

                    self._overlay
                        .removeClass('hidden')
                        .velocity(
                            {opacity: current.overlay},
                            {duration: 10, queue: false, easing: 'easeOutQuad'}
                        );
                }
            });

            hammer.on('panend', function(e) {
                if (e.pointerType === "touch") {
                    self._panning = false;

                    var current = analyse(e);

                    if (current.opening) {
                        element.velocity(
                            {'translateX': [0, current.position]},
                            {duration: 200, queue: false, easing: 'easeOutQuad'}
                        );
                        self._showBackgroundElements(true);
                    } else if (current.closing) {
                        element.velocity(
                            {'translateX': [self.options.edge === 'left' ? - self._menuWidth - 10 : self._menuWidth + 10, current.position]},
                            self._velocityOptions()
                        );
                        self._menuOut = false;
                        self._removeBackgroundElements();
                    }
                }
            });
        },

        /**
         * @param {boolean} quick
         * @private
         */
        _showBackgroundElements: function(quick)
        {
            var self = this;

            if (self._overlay.prop('tagName')) {
                self._overlay
                    .removeClass('hidden')
                    .velocity(
                        {opacity: 1},
                        {
                            duration: quick ? 50 : 300,
                            queue: false,
                            easing: 'easeOutQuad',
                            complete: function () {
                                self._menuOut = true;
                                self._panning = false;
                            }
                        }
                    );
            } else {
                self._menuOut = true;
                self._panning = false;
            }

            if (self.options.edge === 'left') {
                self._dragTarget.css({width: self.options.overlay ? '100%' : self._menuWidth + 10, right: '', left: 0});
            }
            else {
                self._dragTarget.css({width: self.options.overlay ? '100%' : self._menuWidth + 10, right: 0, left: ''});
            }
        },

        /**
         * @private
         */
        _removeBackgroundElements: function()
        {
            this._overlay.velocity(
                {opacity: 0},
                {
                    duration: 200,
                    queue: false,
                    easing: 'easeOutQuad',
                    complete: function() {
                        $(this).addClass('hidden');
                    }
                }
            );

            if (this.options.edge === 'left') {
                this._dragTarget.css({width: '10px', right: '', left: 0});
            } else {
                this._dragTarget.css({width: '10px', right: 0, left: ''});
            }
        },


        /**
         *
         * @param {boolean=} restoreNav
         * @returns {{duration: number, queue: boolean, easing: string, complete: complete}}
         * @private
         */
        _velocityOptions: function(restoreNav)
        {
            var self = this;
            var element = this.element;

            return {
                duration: 200,
                queue: false,
                easing: 'easeOutCubic',
                complete: function() {
                    element.css('transform', 'translateX(' + (self.options.edge === 'left' ? '-' : '') + '100%)');

                    if (restoreNav === true) {
                        element.removeAttr('style');
                        element.css('width', self._menuWidth);
                    }
                }
            };
        },

        /**
         * @param {boolean=} restoreNav
         * @returns {boolean}
         * @private
         */
        _removeMenu: function(restoreNav) {
            var self = this;
            var element = this.element;

            if (!self._menuOut && !self._panning) {
                return false;
            }

            self._panning = false;
            self._menuOut = false;

            self._removeBackgroundElements();

            if (self.options.edge === 'left') {
                element.velocity(
                    {'translateX': -self._menuWidth},
                    self._velocityOptions(restoreNav)
                );
            }
            else {
                element.velocity(
                    {'translateX': self._menuWidth},
                    self._velocityOptions(restoreNav)
                );
            }

            return true;
        },

        _destroy: function () {
            this.hide();
            this._dragTarget.remove();
            this._overlay.remove();
        }
    });
});


