require([
    "jquery",
    "cawaphp/cawa/assets/widget",
    "google-maps",
    "exports-loader?window.MarkerClusterer!js-marker-clusterer"
], function($, $$, GoogleMapsLoader, MarkerClusterer)
{
    $.widget("cawa.google-map", $.cawa.widget, {

        options: {
            fit: false,
            markerClusterer: {
                enabled: false,
                imagePath: null
            },
            map : {
            },
            shapes: []
        },

        _google: null,
        _map: null,
        _shapes: [],

        _create: function()
        {
            if (!this.options.key) {
                throw new Error("Missing mandatory GoogleMap Api Key");
            }

            var self = this;

            /** @TODO: this._shapes is not reinit and keep values if you don't reset it hard way */
            this._shapes = [];

            GoogleMapsLoader.KEY = this.options.key;
            GoogleMapsLoader.LANGUAGE = $.locale();
            // TODO: remove libraries, unecessary for map, but needed by google place
            GoogleMapsLoader.LIBRARIES = ['geometry', 'places'];
            GoogleMapsLoader.load(function(google) {
                self._google = google;
                self._loadMap()
            });
        },

        _loadMap : function()
        {
            var self = this;
            var google = this._google;

            self._map = new google.maps.Map(self.element.find("div")[0], self.options.map);

            // add shape
            $.each(self.options.shapes, function(key, value) {

                var type = value.type;
                delete value.type;

                self.addShape(type, value);
            });

            // markerClusterer
            if (self.options.markerClusterer.enabled === true && self.getShapes('Marker').length > 0) {

                delete self.options.markerClusterer.enabled;
                var cluster = new MarkerClusterer(
                    self._map,
                    this.getShapes('Marker'),
                    self.options.markerClusterer
                );
            }


            if (self.options.bounds) {
                this.setBounds(self.options.bounds);
            } else if (self.options.fit) {
                self.fit();
                google.maps.event.addDomListener(window, "resize", $.proxy(self.fit, self));
            } else {
                google.maps.event.addDomListener(window, "resize", $.proxy(self.resizeCenter, self));
            }

            // bound changed
            google.maps.event.addListenerOnce(self._map, 'idle', function()
            {
                self._map.addListener('bounds_changed', function() {
                    $(self.element).trigger('change.position.google-map.cawa', {
                        bounds: self._map.getBounds(),
                        center: self._map.getCenter()
                    });
                });
            })

        },

        addShape: function(type, options)
        {
            var self = this;

            if (self.options.markerClusterer.enabled === false) {
                options.map = self._map;
            }

            if (typeof self._shapes[type] === "undefined") {
                self._shapes[type] = [];
            }

            var shape = null;

            switch (type) {
                case 'Marker':
                    var content;
                    if (options.content) {
                        content = options.content;
                        delete options.content;
                    }

                    var data = null;

                    if (options.data) {
                        data = options.data;
                        delete options.data;
                    }

                    if (options.label) {
                        options.label = {
                            text: options.label.text,
                            fontWeight: 'bold',
                            color: options.label.color ||
                            (options.iconColor && options.iconColor.fillColor ? self.colorLuminance(options.iconColor.fillColor, -0.7) : '#6D0008')
                        };
                    }

                    if (options.iconColor) {
                        if (options.iconColor.fillColor && ! options.iconColor.strokeColor) {
                            options.iconColor.strokeColor = self.colorLuminance(options.iconColor.fillColor, -0.5);
                        }

                        options.icon = self.customIcon({
                            fillColor: options.iconColor.fillColor || '#FB6066',
                            strokeColor: options.iconColor.strokeColor || '#BB2E39'
                        }, options.label ? true : false);

                        delete options.iconColor;
                    }

                    shape = new google.maps.Marker(options);
                    self._shapes[type].push(shape);

                    var infoWindow = null;

                    if (content) {
                        infoWindow = new google.maps.InfoWindow({
                            content: content
                        });
                    }

                    shape.addListener('click', function ()
                    {
                        $(self.element).trigger('click.marker.google-map.cawa', {marker: shape, data: data});

                        if (infoWindow) {
                            $(self.element).trigger('show.info-window.google-map.cawa', {infoWindow: infoWindow});
                            infoWindow.open(self._map, shape);
                        }
                    });

                    break;
                case 'Circle':
                    shape = new google.maps.Circle(options);
                    self._shapes[type].push(shape);

                    google.maps.event.addDomListener(shape, "radius_changed", $.proxy(self.fit, self));

                    break;
            }
        },

        customIcon: function (opts, withLabel) {
            return Object.assign({
                path: withLabel ?
                    'm -0.00364737,-48.000498 c -9.95194923,0 -18.02130663,8.059221 -18.02130663,17.999999 0,9.9408 15.0178596,30.00000149 18.02130663,30.00000127 3.00344767,0 18.02130837,-20.05920227 18.02130837,-30.00000127 0,-9.940778 -8.0693588,-17.999999 -18.02130837,-17.999999 z' :
                    'm -0.00364737,-48.000498 c -9.95194923,0 -18.02130663,8.059221 -18.02130663,17.999999 0,9.9408 15.0178596,30.00000149 18.02130663,30.00000127 3.00344767,0 18.02130837,-20.05920227 18.02130837,-30.00000127 0,-9.940778 -8.0693588,-17.999999 -18.02130837,-17.999999 z m 0,6 c 6.62561427,0 12.01280737,5.384791 12.01278537,12 0,6.615207 -5.3871698,12 -12.01278537,12 -6.62563623,0 -12.01278463,-5.384793 -12.01278463,-12 0,-6.615209 5.3871482,-12 12.01278463,-12 z',
                fillColor: '#FB6066',
                fillOpacity: 1,
                strokeColor: '#BB2E39',
                strokeWeight: 1.25,
                scale:0.70,
                labelOrigin: new google.maps.Point(0, -29)
            }, opts);
        },

        colorLuminance: function (hex, lum) {
            // validate hex string
            hex = String(hex).replace(/[^0-9a-f]/gi, '');
            if (hex.length < 6) {
                hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
            }
            lum = lum || 0;

            // convert to decimal and change luminosity
            var rgb = "#", c, i;
            for (i = 0; i < 3; i++) {
                c = parseInt(hex.substr(i * 2, 2), 16);
                c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                rgb += ("00" + c).substr(c.length);
            }

            return rgb;
        },

        getShapes: function(type)
        {
            return typeof this._shapes[type] !== "undefined" ? this._shapes[type] : [];
        },

        resizeCenter : function()
        {
            var self = this;
            var google = this._google;
            var map = this._map;

            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        },

        fit : function()
        {
            var self = this;
            var google = this._google;
            var map = this._map;

            if (!google) {
                return false;
            }

            var bounds = new google.maps.LatLngBounds();

            $.forEach(self._shapes, function(shapes, type)
            {
               $.forEach(shapes, function (shape, key)
               {
                   if (typeof shape.getBounds !== "undefined") {
                       bounds.union(shape.getBounds());
                   } else if (typeof shape.getPosition !== "undefined") {
                       bounds.extend(shape.getPosition());
                   }
               });
            });

            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
            if (!bounds.isEmpty()) {
                map.fitBounds(bounds);
            }
        },

        setBounds: function (bounds) {
            this._map.fitBounds(bounds);
        }
    });
});
