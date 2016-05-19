define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/job/job.tpl',
], function(_, $, Backbone, Marionette, JobTPL){

        return Marionette.ItemView.extend({
           
           template: _.template(JobTPL),
           
           tagName: 'div',
           
           className: 'row',
                       
           templateHelpers: function()  {
                var $this = this;
                return {
                    getEndDate: function() {
                        return null === $this.model.get('endDate') ? 'Current' : $this.model.get('endDate');
                    }
                };
            }
           
        });

});

