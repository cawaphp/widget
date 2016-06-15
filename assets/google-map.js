var $ = require("jquery");
var _ = require("lodash");
var GoogleMapsLoader = require('google-maps');

$.widget("cawa.google-map", $.cawa.widget, {

    options: {
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

        self._map = new google.maps.Map(this.element.find("div")[0], self.options.map);

        $.each(self.options.shapes, function(key, value) {

            var type = value.type;
            delete value.type;
            value.map = self._map;

            if (self._shapes[type] == undefined) {
                self._shapes[type] = [];
            }

            switch(type)
            {
                case 'Marker':
                    var content;
                    if (value.content) {
                        content = value.content;
                        delete value.content;
                    }

                    var marker = new google.maps.Marker(value);
                    self._shapes[type].push(marker);

                    if (content) {
                        var infowindow = new google.maps.InfoWindow({
                            content: content
                        });

                        marker.addListener('click', function ()
                        {
                            infowindow.open(self._map, marker);
                        });
                    }
                    break;
                case 'Circle':
                    var shape = new google.maps[type](value);
                    self._shapes[type].push(shape);
                    google.maps.event.addDomListener(shape, "radius_changed", $.proxy(self.fit, self));
                    break;

            }

        });

        google.maps.event.addDomListener(window, "resize", $.proxy(self._fit, self));
        self.fit();
    },

    getShapes: function(type)
    {
        return this._shapes[type] != undefined ? this._shapes[type] : [];
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

        _.forOwn(self._shapes, function(shapes, type)
        {
           _.each(shapes, function (shape, key)
           {
               if (shape.getBounds != undefined) {
                   bounds.union(shape.getBounds());
               }
           });
        });

        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
        if (!bounds.isEmpty()) {
            map.fitBounds(bounds);
        }
    }

});
