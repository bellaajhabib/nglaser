define([
    'underscore',
    'jquery',
    'backbone',
    'marionette'
    ], function(_, $, Backbone, Marionette){
        'use strict';
        
    return Marionette.AppRouter.extend({
        
        initialize: function() {
            this.App = this.options.App;
        },
        
        App: null,
        
        routes: {
            '': 'home',
            'skills' : 'skills',
            'jobs' : 'jobs',
            'community' : 'community',
            'projects' : 'projects',
            'privacypolicy' : 'privacy',
            'contact' : 'contact',
            'about': 'about'
        },
        home: function() {
            this.App.vent.trigger('page:home');
        },
        skills: function() {
            this.App.vent.trigger('page:skills');
        },
        jobs: function() {
            this.App.vent.trigger('page:jobs');
        },
        community: function() {
            this.App.vent.trigger('page:community');
        },
        projects: function() {
            this.App.vent.trigger('page:projects');            
        },
        privacy: function() {
            this.App.vent.trigger('page:privacy');
        },
        contact: function() {
            this.App.vent.trigger('page:contact');
        },
        about: function() {
            this.App.vent.trigger('page:about');
        }
        
    });
});

