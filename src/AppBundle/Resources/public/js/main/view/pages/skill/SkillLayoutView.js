define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/skill/skills.tpl',
    'main/view/pages/skill/SkillCollectionView',
    'main/collection/SkillCollection'
], function(_, $, Backbone, Marionette, SkillTPL, SkillCollectionView, SkillCollection){
        
        'use strict';
        
        return Marionette.LayoutView.extend({
            
            template: _.template(SkillTPL),
            
            onShow: function() {
                var skills = this.options.skills;
                var languagesCollectionView = new SkillCollectionView({collection: new SkillCollection(skills.filter({type: 'Language'})) });
                this.langauges.show(languagesCollectionView);
               
                var phpFrameworkCollectionView = new SkillCollectionView({collection: new SkillCollection(skills.filter({type: 'PHP Frameworks'})) });
                this.phpFrameworks.show(phpFrameworkCollectionView);
              
                var symfonyBundlesCollectionView = new SkillCollectionView({collection: new SkillCollection(skills.filter({type: 'Symfony Bundles'})) });
                this.bundles.show(symfonyBundlesCollectionView);
               
                var javascriptLibsCollectionView = new SkillCollectionView({collection: new SkillCollection(skills.filter({type: 'Javascript Libraries'})) });
                this.javascriptlibs.show(javascriptLibsCollectionView);

                var javascriptFrameworkCollectionView = new SkillCollectionView({collection: new SkillCollection(skills.filter({type: 'Javascript Frameworks'})) });
                this.javascriptFrameworks.show(javascriptFrameworkCollectionView);
                
                var databaseCollectionView = new SkillCollectionView({collection: new SkillCollection(skills.filter({type: 'Databases'})) });
                this.databases.show(databaseCollectionView);

                var frontendCollectionView = new SkillCollectionView({collection: new SkillCollection(skills.filter({type: 'General Frontend'})) });
                this.frontend.show(frontendCollectionView);

                var generalCollectionView = new SkillCollectionView({collection: new SkillCollection(skills.filter({type: 'General Web Dev'})) });
                this.general.show(generalCollectionView);

            },
            
            regions : {
                langauges : '#languages',
                phpFrameworks: '#phpframeworks',
                bundles: '#bundles',
                javascriptlibs: '#javascriptlibs',
                javascriptFrameworks: '#javascriptFrameworks',
                databases: '#databases',
                frontend: '#frontend',
                general: '#general',
            },
           
            tagName: 'div',
            
            id: 'skill'
        });
});



