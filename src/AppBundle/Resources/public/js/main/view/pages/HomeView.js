define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/home.tpl'
    ], function(_, $, Backbone, Marionette, HomeTPL){
        
        'use strict';
        
        return Marionette.ItemView.extend({
            
            template: _.template(HomeTPL),
           
            tagName: 'div',
            
            id: 'home'
        });
});



