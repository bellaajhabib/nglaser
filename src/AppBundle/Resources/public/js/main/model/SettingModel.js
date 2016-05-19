define(['underscore', 'backbone'], function(_, Backbone){
    
    'use strict';
    
    return Backbone.Model.extend({
        
        defaults: {
            value: null,
            name: null
        },
                
        parse: function(data) {
            var setting = {};
            setting.id = data.id;
            setting.name = data.name;
            setting.value = data.value;
            return setting;
        }
        
    });
    
});