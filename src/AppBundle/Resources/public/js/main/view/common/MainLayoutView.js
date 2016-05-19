define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'main/view/common/NavigationView'
    ], function(_, $, Backbone, Marionette, NavigationView){
        
        'use strict';
        
        return Marionette.LayoutView.extend({
            
            el: 'body',
            
            navigation: null,
            
            footer: null,
            
            regions: {
                main : '#main'
            },
            
            initialize: function() {
                var $this = this;
                this.navigation = new NavigationView();
                this.footer = new NavigationView({el : 'footer'});
                this.navigation.on('nav:change', function(link) {
                    $this.trigger('nav:change',link);
                });
                this.footer.on('nav:change', function(link) {
                    $this.trigger('nav:change',link);
                });
            }           
            
        });
});

