define([
    'main/model/JobModel',
    'main/collection/Collection'
], function(JobModel, Collection){
    
    'use strict';
    
    return Collection.extend({
        
        model: JobModel,
        
        url: function() {
            return Routing.generate('api_get_jobs');
        }
        
    });
    
});
