define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/job/jobs.tpl',
    'main/view/pages/job/JobView'
], function(_, $, Backbone, Marionette, JobTPL, JobView){

        return Marionette.CompositeView.extend({
           
           template: _.template(JobTPL),
           
           childView: JobView,
           
           childViewContainer: '#job-list',
           
           id: 'jobs'
    
        });

});

