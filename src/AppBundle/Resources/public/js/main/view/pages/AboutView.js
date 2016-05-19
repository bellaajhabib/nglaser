define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/about.tpl',
], function(_, $, Backbone, Marionette, AboutTPL){

        return Marionette.ItemView.extend({
           
            template: _.template(AboutTPL),

            tagName: 'div',
            
            id: 'about'

           
        });

});


