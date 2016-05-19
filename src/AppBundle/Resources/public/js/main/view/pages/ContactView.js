define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/contact.tpl',
], function(_, $, Backbone, Marionette, ContactTPL){

        return Marionette.ItemView.extend({
           
            template: _.template(ContactTPL),

            tagName: 'div',
            
            id: 'contact'

           
        });

});


