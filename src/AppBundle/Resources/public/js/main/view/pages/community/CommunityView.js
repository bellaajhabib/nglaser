define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/community/community.tpl',
], function(_, $, Backbone, Marionette, CommunityTPL){

        return Marionette.ItemView.extend({
           
           template: _.template(CommunityTPL),
           
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

