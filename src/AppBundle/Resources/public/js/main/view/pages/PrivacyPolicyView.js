define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/privacy.tpl',
], function(_, $, Backbone, Marionette, PrivacyTPL){

        return Marionette.ItemView.extend({
           
            template: _.template(PrivacyTPL),

            tagName: 'div',
            
            id: 'privacypolicy'

           
        });

});


