define([
    'underscore',
    'jquery',
    'backbone',
    'marionette',
    'text!main/view/templates/community/communities.tpl',
    'main/view/pages/community/CommunityView'
], function(_, $, Backbone, Marionette, CommunityTPL, CommunityView){

        return Marionette.CompositeView.extend({
           
           template: _.template(CommunityTPL),
           
           childView: CommunityView,
           
           childViewContainer: '#community-list',
           
           id: 'community'
    
        });

});

