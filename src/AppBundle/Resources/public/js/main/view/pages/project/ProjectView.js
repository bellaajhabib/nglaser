define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/project/project.tpl',
], function(_, $, Backbone, Marionette, ProjectTPL){

        return Marionette.ItemView.extend({
           
            template: _.template(ProjectTPL),

            tagName: 'div',

            className: 'row'
           
        });

});

