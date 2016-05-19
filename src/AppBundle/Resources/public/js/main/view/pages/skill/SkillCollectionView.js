define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'main/view/pages/skill/SkillView'
    ], function(_, $, Backbone, Marionette, SkillView){
        
        'use strict';
        
        return Marionette.CollectionView.extend({
            
            childView: SkillView
            
        });
});



