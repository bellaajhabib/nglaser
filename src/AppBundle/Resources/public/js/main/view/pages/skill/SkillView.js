define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/skill/skill.tpl'
    ], function(_, $, Backbone, Marionette, SkillItemTPL){
        
        'use strict';
        
        return Marionette.ItemView.extend({
            
            template: _.template(SkillItemTPL),
            
            tagName: 'span',
                
            className: function() {
                return 'label ' + this.model.getLabelClass();
            }
            
            
            
        });
});



