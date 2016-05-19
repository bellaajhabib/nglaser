define(['underscore', 'backbone'], function(_, Backbone){
    
    'use strict';
    
    return Backbone.Model.extend({
        
        defaults: {
            name: null,
            level: null,
            position: null,
            type: null,
            url: null
        },
                
        parse: function(data) {
            var skill = {};
            skill.id = data.id;
            skill.name = data.name;
            skill.level = data.level;
            skill.position = data.position;
            skill.type = data.type;
            skill.url = data.url;
            return skill;
        },
        
        getLabelClass: function()  {
            
            if(1 === this.get('level')) {
                return 'label-info';
            }
            
            if(2 === this.get('level')) {
                return 'label-warning';
            }
            
            if(3 === this.get('level')) {
                return 'label-success';
            }
            
            if(4 === this.get('level')) {
                return 'label-danger';
            }
            
            if(5 === this.get('level')) {
                return 'label-primary';
            }
            
            return 'label-info';
        }
        
    });
    
});
