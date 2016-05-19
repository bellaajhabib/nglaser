define([
    'main/model/PageModel',
    'main/collection/Collection'
], function(PageModel, Collection){
    
    'use strict';
    
    return Collection.extend({
        
        model: PageModel,
        
        url: function() {
            return Routing.generate('api_get_pages');
        }
        
    });
    
});
