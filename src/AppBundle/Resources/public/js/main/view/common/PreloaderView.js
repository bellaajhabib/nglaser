define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/preloader.tpl'
    ], function(_, $, Backbone, Marionette, PreloadTPL){
        
        'use strict';
        
        return Marionette.ItemView.extend({
            
            template: _.template(PreloadTPL),
            
            tagName: 'div',
            
            id: 'preloader'
            
        });
});

