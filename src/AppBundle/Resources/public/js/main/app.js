define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'bootstrap',
    'main/Router',
    'main/view/common/MainLayoutView',
    'main/view/common/PreloaderView',
    'main/view/pages/HomeView',
    'main/view/pages/skill/SkillLayoutView',
    'main/model/PageModel',
    'main/collection/SkillCollection',
    'main/view/pages/job/JobCompositeView',
    'main/collection/JobCollection',
    'main/view/pages/community/CommunityCompositeView',
    'main/collection/CommunityCollection',
    'main/view/pages/project/ProjectCompositeView',
    'main/collection/ProjectCollection',
    'main/view/pages/PrivacyPolicyView',
    'main/view/pages/ContactView',
    'main/view/pages/AboutView'
    ], function(_, $, Backbone, Marionette, bootstrap, Router, MainLayoutView, PreloaderView, HomeView, SkillLayoutView, PageModel, 
                        SkillCollection, JobCompositeView, JobCollection, CommunityCompositeView, CommunityCollection, ProjectCompositeView, ProjectCollection, PrivacyPolicyView, ContactView, AboutView){
        
        'use strict';
        
        var App = new Marionette.Application({
                      
           layout: null, 
           
           router: null,
                      
           start: function() {
               var $this = this;
               this.layout = new MainLayoutView();
               this.layout.on('nav:change', function(link) {
                    $this.navigate(link);
               });
               
               this.router = new Router({App: this});
               Backbone.history.start({pushState: true}); 
           },
           
           changeTitle: function(title) {
               $('title').text(title);
           },
           
           navigate: function(link) {
                this.router.navigate(link, {trigger: true, replace: true});
                this.layout.navigation.$el.find('.navbar-collapse').collapse('hide');
           }
           
        });
        
        App.vent.on('page:home', function(){ 
            App.layout.main.show(new PreloaderView());
            var homePage = new PageModel();
            homePage.url = Routing.generate('api_get_page', {slug: 'home'});
            $.when(homePage.fetch()).done(function(){
                App.changeTitle('La Home Page');
                App.layout.main.show(new HomeView({model: homePage}));
            });
        });
        
        App.vent.on('page:skills', function(){ 
            App.layout.main.show(new PreloaderView());
            var skillPage = new PageModel();
            var skillCollection = new SkillCollection();
            skillPage.url = Routing.generate('api_get_page', {slug: 'skills'});
            $.when(skillPage.fetch(), skillCollection.fetch()).done(function(){
                App.changeTitle('Mad Skills');
                App.layout.main.show(new SkillLayoutView({model: skillPage, skills: skillCollection}));
            });
        });
        
        App.vent.on('page:jobs', function(){ 
            App.layout.main.show(new PreloaderView());
            var jobPage = new PageModel();
            var jobCollection = new JobCollection();
            jobPage.url = Routing.generate('api_get_page', {slug: 'jobs'});
            $.when(jobPage.fetch(), jobCollection.fetch()).done(function(){
                App.changeTitle('Job History');
                App.layout.main.show(new JobCompositeView({model: jobPage, collection: jobCollection}));
            });
        });
        
        App.vent.on('page:community', function(){ 
            App.layout.main.show(new PreloaderView());
            var communityPage = new PageModel();
            communityPage.url = Routing.generate('api_get_page', {slug: 'community'});
            var communityCollection = new CommunityCollection();
            $.when(communityPage.fetch(), communityCollection.fetch()).done(function(){
                App.changeTitle('Helping The Community ');
                App.layout.main.show(new CommunityCompositeView({model: communityPage, collection: communityCollection}));
            });
        });
        
        App.vent.on('page:projects', function(){ 
            App.layout.main.show(new PreloaderView());
            var projectPage = new PageModel();
            projectPage.url = Routing.generate('api_get_page', {slug: 'projects'});
            var projectCollection = new ProjectCollection();
            $.when(projectPage.fetch(), projectCollection.fetch()).done(function(){
                App.changeTitle('Building Cool Projects');
                App.layout.main.show(new ProjectCompositeView({ model: projectPage, collection: projectCollection }));
            });
        });
        
        App.vent.on('page:privacy', function(){ 
            App.layout.main.show(new PrivacyPolicyView());
            App.layout.navigation._removeUnderlineNave();
        });
        
        App.vent.on('page:contact', function(){ 
            App.layout.main.show(new ContactView());
            App.layout.navigation._removeUnderlineNave();
        });
        
        App.vent.on('page:about', function(){ 
            App.layout.main.show(new AboutView());
            App.layout.navigation._removeUnderlineNave();
        });
        
        
        
        return App;
    
});

