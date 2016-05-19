define(['underscore', 'backbone'], function(_, Backbone){
    
    'use strict';
    
    return Backbone.Model.extend({
        
        defaults: {
            title: null,
            organization: null,
            url: null,
            description: null,
            position: null,
            endDate: null,
            startDate: null
        },
                
        parse: function(data) {
            var community = {};
            community.id = data.id;
            community.title = data.title;
            community.organization = data.organization;
            community.position = data.position;
            community.url = data.url;
            community.startDate = data.start_date;
            community.endDate = data.end_date;
            community.description = data.description;
            return community;
        }
        
    });
    
});
