;
(function ($, window, document, undefined) {
    var pluginName = 'circleMenu',
        defaults = {
            depth: 0,
            item_diameter: 30,
            circle_radius: 80,
            angle: {
                start: 0,
                end: 90
            },
            speed: 500,
            delay: 1000,
            step_out: 20,
            step_in: -20,
            trigger: 'hover',
            transition_function: 'ease',
            effects_array: ['animated', 'bounce', 'zoomInDown', 'zoomOutUp', 'zoomInLeft', 'zoomOutRight', 'zoomInRight', 'zoomOutLeft'
                , 'zoomInUp', 'zoomOutDown', 'rubberBand', 'wobble', 'fadeIn', 'fadeOut', 'flip', 'lightSpeedIn', 'lightSpeedOut'
                , 'rotateIn', 'rotateOut', 'rotateInDownLeft', 'rotateOutDownLeft', 'zoomIn', 'tada'],
            openedImg: '',
            closedImg:''
        };

    function vendorPrefixes(items, prop, value) {
        ['-webkit-', '-moz-', '-o-', '-ms-', ''].forEach(function (prefix) {
            items.css(prefix + prop, value);
        });
    }

    function CircleMenu(element, options) {
        this._timeouts = [];
        this.element = $(element);
        this.options = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
        this.unhook();
        this.hook();
    }

    CircleMenu.prototype.init = function () {
        var self = this,
            directions = {
                'bottom-left': [180, 90],
                'bottom': [135, 45],
                'right': [-45, 45],
                'left': [225, 135],
                'top': [225, 315],
                'bottom-half': [180, 0],
                'right-half': [-90, 90],
                'left-half': [270, 90],
                'top-half': [180, 360],
                'top-left': [270, 180],
                'top-right': [270, 360],
                'full': [-90, 270 - Math.floor(360 / (self.element.children('li').length - 1))],
                'bottom-right': [0, 90]
            },
            dir;

        self._state = 'closed';
        self.element.addClass(pluginName + '-closed');
        circleMenuBackgroundImg(self.element,self.options.closedImg);


        if (typeof self.options.direction === 'string') {
            dir = directions[self.options.direction.toLowerCase()];
            if (dir) {
                self.options.angle.start = dir[0];
                self.options.angle.end = dir[1];
            }
        }

        self.menu_items = self.element.children('li:not(:first-child)');
        self.initCss();
        self.item_count = self.menu_items.length;
        self._step = (self.options.angle.end - self.options.angle.start) / (self.item_count - 1);
        self.menu_items.each(function (index) {
            var $item = $(this),
                angle = (self.options.angle.start + (self._step * index)) * (Math.PI / 180),
                x = Math.round(self.options.circle_radius * Math.cos(angle)),
                y = Math.round(self.options.circle_radius * Math.sin(angle));

            $item.data('plugin_' + pluginName + '-pos-x', x);
            $item.data('plugin_' + pluginName + '-pos-y', y);
            $item.on('click', function () {
                self.select(index + 2);
            });
        });

        // Initialize event hooks from options
        ['open', 'close', 'init', 'select'].forEach(function (evt) {
            var fn;

            if (self.options[evt]) {
                fn = self.options[evt];
                self.element.on(pluginName + '-' + evt, function () {
                    return fn.apply(self, arguments);
                });
                delete self.options[evt];
            }
        });

        self.submenus = self.menu_items.children('ul');
        self.submenus.circleMenu($.extend({}, self.options, {depth: self.options.depth + 1}));

        self.trigger('init');
    };
    CircleMenu.prototype.trigger = function () {
        var args = [],
            i, len;

        for (i = 0, len = arguments.length; i < len; i++) {
            args.push(arguments[i]);
        }
        this.element.trigger(pluginName + '-' + args.shift(), args);
    };
    CircleMenu.prototype.unhook = function () {
        var self = this;
        self.element.off('mouseenter').off('mouseleave');
        self.element.children('li:first-child').off('click');
    };
    CircleMenu.prototype.hook = function () {
        var self = this;
        if (self.options.trigger === 'hover') {
            self.element.on('mouseenter',function (evt) {
                if (self._state != 'opening') {
                    self.open();
                }
            }).on('mouseleave', function (evt) {
                if (self._state == 'opening') {
                    $(document).off('wpcm_items_open');
                    $(document).on('wpcm_items_open', function (e) {
                        self.close();
                    });
                } else {
                    self.close();
                }
            });
        } else if (self.options.trigger === 'click') {
            self.element.children('li:first-child').on('click', function (evt) {
                evt.preventDefault();
                if (self._state === 'closed' || self._state === 'closing') {
                    self.open();
                } else {
                    self.close(true);
                }
                return false;
            });
        } else if (self.options.trigger === 'none') {
            // Do nothing
        }
    };
    CircleMenu.prototype.open = function () {
        var self = this,
            $self = this.element,
            start = 0,
            set;

        self.clearTimeouts();
        if (self._state === 'open') return self;
        $self.addClass(pluginName + '-open');
        circleMenuBackgroundImg(self.element,self.options.openedImg);
        $self.removeClass(pluginName + '-closed');
        if (self.options.step_out >= 0) {
            set = self.menu_items;
        } else {
            set = $(self.menu_items.get().reverse());
        }
        set.each(function (index) {
            var $item = $(this);
            self._timeouts.push(setTimeout(function () {
                $item.css({
                    left: $item.data('plugin_' + pluginName + '-pos-x') + 'px',
                    top: $item.data('plugin_' + pluginName + '-pos-y') + 'px'
                });
                vendorPrefixes($item, 'transform', 'scale(1)');
                if (self.options.transition_function != 'ease' && self.options.transition_function != '--') {
                    $item.addClass('animated ' + self.options.transition_function);
                }
            }, start + Math.abs(self.options.step_out) * index));
            if (typeof(self.options.transition_function_extra) != 'undefined') {
                $item.removeClass(self.options.transition_function + ' ' + self.options.transition_function_extra);
            } else {
                $item.removeClass(self.options.transition_function);
            }
        });
        self._timeouts.push(setTimeout(function () {
            if (self._state === 'opening') self.trigger('open');
            self._state = 'open';
            self._timeouts.push(setTimeout(function () {
                $(document).trigger('wpcm_items_open');
            }, 1000));
        }, start + Math.abs(self.options.step_out) * set.length));
        self._state = 'opening';
        return self;
    };
    CircleMenu.prototype.close = function (immediate) {
        var mouseOverElem = ($(document.querySelectorAll(":hover")).hasClass('wpcm-link-wrapper')
            || $(document.querySelectorAll(":hover")).hasClass('wpcm-each-link')
            || $(document.querySelectorAll(":hover")).hasClass('wpcm-link-img'));
        var self = this;
        $self = this.element;

        do_animation = function do_animation() {
            $self.find('.wpcm-link-wrapper').removeClass('animated ' + self.options.transition_function);
            var start = 0,
                set;
            self.submenus.circleMenu('close');
            self.clearTimeouts();
            if (self._state === 'closed') return self;
            if (self.options.step_in >= 0) {
                set = self.menu_items;
            } else {
                set = $(self.menu_items.get().reverse());
            }
            if (self.options.transition_function != 'ease' && self.options.transition_function != '--') {
                var extraTimeoutVal = 100;
                self._timeouts.push(setTimeout(function () {
                    set.each(function (index) {
                        var $item = $(this);
                        self._timeouts.push(setTimeout(function () {
                            if (typeof(self.options.transition_function_extra) != 'undefined') {
                                $item.addClass('animated ' + self.options.transition_function_extra);
                            } else {
                                $item.addClass('animated ' + self.options.transition_function);
                            }
                            self._timeouts.push(setTimeout(function () {
                                $item.css({top: 0, left: 0});
                                self._timeouts.push(setTimeout(function () {
                                    if (typeof(self.options.transition_function_extra) != 'undefined') {
                                        $item.removeClass('animated ' + self.options.transition_function_extra);
                                    }
                                    $item.removeClass('animated ' + self.options.transition_function);
                                }, 200));
                            }, 300));
                            vendorPrefixes($item, 'transform', 'scale(.5)');
                        }, start + Math.abs(self.options.step_in) * index));
                    });
                }, extraTimeoutVal));
            } else {
                set.each(function (index) {
                    var $item = $(this);
                    self._timeouts.push(setTimeout(function () {
                        $item.css({top: 0, left: 0});
                        vendorPrefixes($item, 'transform', 'scale(.5)');
                    }, start + Math.abs(self.options.step_in) * index));
                });
            }
            self._timeouts.push(setTimeout(function () {
                if (self._state === 'closing') self.trigger('close');
                self._state = 'closed';
            }, start + Math.abs(self.options.step_in) * set.length));
            $self.removeClass(pluginName + '-open');
            $self.addClass(pluginName + '-closed');
            circleMenuBackgroundImg(self.element,self.options.closedImg);
            self._state = 'closing';
            return self;
        };
        if (!mouseOverElem) {
            if (immediate) {
                do_animation();
            } else {
                self._timeouts.push(setTimeout(do_animation, self.options.delay));
            }
        }
        return this;
    };
    CircleMenu.prototype.select = function (index) {
        var self = this,
            selected, set_other;
        if (self._state === 'open' || self._state === 'opening') {
            self.clearTimeouts();
            self.element.children('li').removeClass(self.options.effects_array.join(' '));

            set_other = self.element.children('li:not(:nth-child(' + index + '),:first-child)');
            selected = self.element.children('li:nth-child(' + index + ')');
            self.trigger('select', selected);
            vendorPrefixes(selected.add(set_other), 'transition', 'all 500ms ease-out');
            vendorPrefixes(selected, 'transform', 'scale(2)');
            vendorPrefixes(set_other, 'transform', 'scale(0)');
            selected.css('opacity', '0');
            set_other.css('opacity', '0');
            self.element.removeClass(pluginName + '-open');
            setTimeout(function () {
                self.initCss();
            }, 500);
        }
    };
    CircleMenu.prototype.clearTimeouts = function () {
        var timeout;

        while (timeout = this._timeouts.shift()) {
            clearTimeout(timeout);
        }
    };
    CircleMenu.prototype.initCss = function () {
        var self = this,
            $items;

        self._state = 'closed';
        self.element.removeClass(pluginName + '-open');
        self.element.css({
            'list-style': 'none',
            'margin': 0,
            'padding': 0,
            'width': self.options.item_diameter + 'px'
        });
        $items = self.element.children('li');
        $items.attr('style', '');
        $items.css({
            'display': 'block',
            'width': self.options.item_diameter + 'px',
            'height': self.options.item_diameter + 'px',
            'text-align': 'center',
            'line-height': self.options.item_diameter + 'px',
            'position': 'absolute',
            'z-index': 1,
            'opacity': ''
        });
        self.element.children('li:first-child').css({'z-index': 1000 - self.options.depth});
        self.menu_items.css({
            top: 0,
            left: 0
        });
        vendorPrefixes($items, 'border-radius', self.options.item_diameter + 'px');
        vendorPrefixes(self.menu_items, 'transform', 'scale(.5)');
        self._timeouts.push(setTimeout(function () {
            if (self.options.transition_function == '--' || self.options.transition_function == 'ease') {
                vendorPrefixes($items, 'transition', 'all ' + self.options.speed + 'ms ' + self.options.transition_function);
            } else {
                vendorPrefixes($items, 'transition', 'all ' + self.options.speed + 'ms ease');
            }
        }, 0));

        circleMenuBackgroundImg(self.element,self.options.closedImg);
    };

    $.fn[pluginName] = function (options, reset) {
        if (typeof(reset) == 'undefined') {
            reset = false;
        }
        return this.each(function () {
            var obj = $.data(this, 'plugin_' + pluginName),
                commands = {
                    'init': function () {
                        obj.init();
                    },
                    'open': function () {
                        obj.open();
                    },
                    'close': function () {
                        obj.close(true);
                    }
                };
            if (typeof options === 'string' && obj && commands[options]) {
                commands[options]();
            }
            if (reset) {
                obj = null;
            }
            if (!obj) {
                $.data(this, 'plugin_' + pluginName, new CircleMenu(this, options));
            }
        });
    };

    circleMenuBackgroundImg = function ($elm, imgUrl) {
        $($elm.find('li').get(0)).css({'background-image': 'url(' + imgUrl + ')'});
    }
})(jQuery, window, document);