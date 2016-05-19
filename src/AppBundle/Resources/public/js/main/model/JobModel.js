define(['underscore', 'backbone'], function(_, Backbone){
    
    "use strict";
    
    return Backbone.Model.extend({
        
        defaults: {
            title: null,
            description: null,
            startDate: null,
            endDate: null,
            company: null
        },
            alert(data.start_date);
        parse: function(data) {
            var job = {};
            job.id = data.id;
            job.title = data.title;
            job.description = data.description;
            job.startDate = data.start_date;
            job.endDate = data.end_date;
            job.company = data.company;
            return job;
        }
        
    });
    
});