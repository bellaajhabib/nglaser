define([
    'main/model/CommunityModel',
    'main/collection/Collection'
], function(CommunityModel, Collection){
    
    'use strict';
    
    return Collection.extend({
        
        model: CommunityModel,
        
        url: function() {
            return Routing.generate('api_get_communities');
        }
        
    });
    
});
