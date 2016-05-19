define(['underscore', 'backbone'], function(_, Backbone){
    
    "use strict";
    
    return Backbone.Model.extend({
        
        defaults: {
            title: null,
            description: null,
            picture: null,
            createdAt: null,
            updatedAt: null
        },
                
        parse: function(data) {
            var page = {};
            page.id = data.id;
            page.title = data.title;
            page.description = data.description;
            page.createdAt = data.created_at;
            page.updatedAt = data.updated_at;
            page.picture = data.picture_url;
            return page;
        }
        
    });
    
})
