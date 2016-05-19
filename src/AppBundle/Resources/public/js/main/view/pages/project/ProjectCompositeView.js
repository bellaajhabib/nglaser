define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/project/projects.tpl',
    'main/view/pages/project/ProjectView'
], function(_, $, Backbone, Marionette, ProjectTPL, ProjectView){

        return Marionette.CompositeView.extend({
           
           template: _.template(ProjectTPL),
           
           childView: ProjectView,
           
           childViewContainer: '#project-list',
           
           id: 'project'
    
        });

});

