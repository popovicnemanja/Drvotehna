$(document).ready(function() {
    $('.menu').on('click', function() {
        $('nav').find('ul').slideToggle(700);
    })
    ;(function () {
        window.Gallery = function (options) {
            this.options = options;
            this.setElements();
            this.setIndex();
            this.bindEvents();
            this.initialize();
        };

        Gallery.prototype = {
            $: function (child) {
                return this.$el.find(child);
            },

            setElements: function () {
                this.el = $(this.options.el)[0];
                this.$el = $(this.options.el);
                this.$li = this.$('li');
                this.$popup = $('.popup');
                this.$body = $('body');
            },

            setIndex: function () {
                this.$li.each(function (index) {
                    $(this).attr('data-gallery-index', index);
                });
            },

            bindEvents: function () {
                this.$el.on('click', 'li', $.proxy(this.open, this));
                this.$popup.on('click', '.close a', $.proxy(this.close, this));
                this.$popup.on('click', '.next a', $.proxy(this.next, this));
                this.$popup.on('click', '.prev a', $.proxy(this.prev, this));
            },

            initialize: function () {
                this.lastIndex = this.$li.last().index();
            },

            popup: function (options) {
                this.$popup.find('img').attr('src', options.image).attr('alt', options.title);
                this.$popup.find('figcaption').text( options.title );
                this.$popup.show();
                return this;
            },

            setCurrent: function (index) {
                this.currentIndex = index;
                return this;
            },

            checkKey: function (e) {
                if ( e.keyCode === 27) {
                    return this.close(e);
                }

                if ( e.keyCode === 39 ) {
                    return this.next();
                }

                if ( e.keyCode === 37 ) {
                    return this.prev();
                }
            },

            open: function (e) {
                e.preventDefault();
                this.setCurrent( parseInt($(e.currentTarget).attr('data-gallery-index'), 10) ).show();
                this.$body.on('keydown', $.proxy(this.checkKey, this));
            },

            close: function (e) {
                e.preventDefault();
                this.$popup.hide();
                this.$body.off('keydown');
                return this;
            },

            next: function (e) {
                e && e.preventDefault();

                if ( this.currentIndex === this.lastIndex ) {
                    return this.setCurrent(0).show();
                }

                return this.setCurrent(this.currentIndex + 1).show();
            },

            prev: function (e) {
                e && e.preventDefault();

                 if ( this.currentIndex === 0 ) {
                    return this.setCurrent(this.lastIndex).show();
                }

                return this.setCurrent(this.currentIndex - 1).show();
            },

            show: function () {
                var $img = this.$('li[data-gallery-index="'+this.currentIndex+'"]').find('img');

                this.popup({
                    image: $img.attr('src'),
                    title: $img.attr('alt')
                });
            }
        };
    })();

var gallery = new Gallery({ el: '.gallery' });

    var myCenter=new google.maps.LatLng(44.748564, 20.587488);
    var marker;
      function initialize() {
        var mapProp = {
        center:myCenter,
        scrollwheel: false,
        zoom:17,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map=new google.maps.Map(document.getElementById("map-canvas"),mapProp);
    var marker=new google.maps.Marker({
       position:myCenter,
      animation:google.maps.Animation.BOUNCE
  });

marker.setMap(map);
  }

  google.maps.event.addDomListener(window, 'load', initialize);


});

