define([
    'main/model/ProjectModel',
    'main/collection/Collection'
], function(ProjectModel, Collection){
    
    'use strict';
    
    return Collection.extend({
        
        model: ProjectModel,
        
        url: function() {
            return Routing.generate('api_get_projects');
        }
        
    });
    
});
