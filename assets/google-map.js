var $ = require("jquery");
var GoogleMapsLoader = require('google-maps');

$.widget("cawa.google-map", $.cawa.widget, {

    options: {
        map : {
        },
        markers: []
    },

    _google: null,

    _create: function()
    {
        if (!this.options.key) {
            throw new Error("Missing mandatory GoogleMap Api Key");
        }

        var self = this;

        GoogleMapsLoader.KEY = this.options.key;
        GoogleMapsLoader.LANGUAGE = $.locale();

        GoogleMapsLoader.load(function(google) {
            self._google = google;
            self._loadMap()
        });
    },

    _loadMap : function()
    {
        var self = this;
        var google = this._google;

        var map = new google.maps.Map(this.element.find("div")[0], self.options.map);

        $.each(self.options.markers, function(key, value) {
            var content;
            if (value.content) {
                content = value.content;
                delete value.content;
            }

            value.map = map;
            var marker = new google.maps.Marker(value);

            if (content) {
                var infowindow = new google.maps.InfoWindow({
                    content: content
                });

                marker.addListener('click', function ()
                {
                    infowindow.open(map, marker);
                });
            }
        });

        google.maps.event.addDomListener(window, "resize", function ()
        {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
    }
});
