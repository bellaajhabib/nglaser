define([
    'main/model/SkillModel',
    'main/collection/Collection'
], function(SkillModel, Collection){
    
    'use strict';
    
    return Collection.extend({
        
        model: SkillModel,
        
        url: function() {
            return Routing.generate('api_get_skills');
        }
        
    });
    
});
