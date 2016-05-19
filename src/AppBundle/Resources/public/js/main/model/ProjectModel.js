define(['underscore', 'backbone'], function(_, Backbone){
    
    "use strict";
    
    return Backbone.Model.extend({
        
        defaults: {
            name: null,
            description: null,
            position: null,
            url: null
,
        },
                
        parse: function(data) {
            var project = {};
            project.id = data.id;
            project.name = data.name;
            project.description = data.description;
            project.url = data.url;
            project.position = data.position;
            return project;
        }
        
    });
    
});