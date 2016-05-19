define([
    'main/model/SettingModel',
    'main/collection/Collection'
], function(SettingModel, Collection){
    
    'use strict';
    
    return Collection.extend({
        
        model: SettingModel,
        
        url: function() {
            return Routing.generate('api_get_settings');
        }
        
    });
    
});
