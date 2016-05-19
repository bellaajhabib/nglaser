define([
    'underscore',
    'jquery',
    'backbone',
    'marionette'
    ], function(_, $, Backbone, Marionette){
        
        'use strict';
        
        return Marionette.ItemView.extend({
            
            el: '#main-nav',
            
            ui: {
                main_nav: 'ul.navbar-nav'
            },
            
            events: {
                'click a' : '_navChange'
            },
            
            _navChange: function(e) {
                e.preventDefault();
                
                var href = e.target.tagName.toLowerCase() === 'a' ? e.target.getAttribute('href') : e.target.parentNode.getAttribute('href');
                if(false === e.target.hasAttribute('data-spa-enable')) {
                    window.location = href;
                    return false;
                }
                var listNav = this.$el.find('ul.navbar-nav > li');
                listNav.removeClass('active');
                listNav.each(function(){
                    if($(this).find('a')[0].getAttribute('href') === href) {
                        $(this).addClass('active');
                    }
                });
                this.trigger('nav:change', href);
            },
            
            _removeUnderlineNave: function() {
                var listNav = this.$el.find('ul.navbar-nav > li');
                listNav.removeClass('active');
            }
            
        });
});

