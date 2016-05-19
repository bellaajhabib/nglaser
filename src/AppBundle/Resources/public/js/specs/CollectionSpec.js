define([
    'main/collection/Collection',
    'main/collection/CommunityCollection',
    'main/model/CommunityModel',
    'main/collection/JobCollection',
    'main/model/JobModel',
    'main/collection/PageCollection',
    'main/model/PageModel',
    'main/collection/ProjectCollection',
    'main/model/ProjectModel',
    'main/collection/SettingCollection',
    'main/model/SettingModel',
    'main/collection/SkillCollection',
    'main/model/SkillModel'

], function (Collection, CommunityCollection, CommunityModel, JobCollection, JobModel, 
            PageCollection, PageModel, ProjectCollection, ProjectModel, SettingCollection, SettingModel, SkillCollection, SkillModel) {
    describe("Collection Specs ", function() {
                
        it("Community Collection should have a url set and model set", function(){
            var collection = new CommunityCollection();
            expect(collection.url().indexOf('api') >= 0).toBe(true);
            expect(collection.url()).toBe(Routing.generate('api_get_communities'));
            expect(collection.model).toEqual(CommunityModel);
        });
        
        it("Job Collection should have a url set and model set", function(){
            var collection = new JobCollection();
            expect(collection.url().indexOf('api') >= 0).toBe(true);
            expect(collection.url()).toBe(Routing.generate('api_get_jobs'));
            expect(collection.model).toEqual(JobModel);
        });
        
        it("Page Collection should have a url set and model set", function(){
            var collection = new PageCollection();
            expect(collection.url().indexOf('api') >= 0).toBe(true);
            expect(collection.url()).toBe(Routing.generate('api_get_pages'));
            expect(collection.model).toEqual(PageModel);
        });
        
        it("Project Collection should have a url set and model set", function(){
            var collection = new ProjectCollection();
            expect(collection.url().indexOf('api') >= 0).toBe(true);
            expect(collection.url()).toBe(Routing.generate('api_get_projects'));
            expect(collection.model).toEqual(ProjectModel);
        });
        
        it("Setting Collection should have a url set and model set", function(){
            var collection = new SettingCollection();
            expect(collection.url().indexOf('api') >= 0).toBe(true);
            expect(collection.url()).toBe(Routing.generate('api_get_settings'));
            expect(collection.model).toEqual(SettingModel);
        });
        
        it("Skill Collection should have a url set and model set", function(){
            var collection = new SkillCollection();
            expect(collection.url().indexOf('api') >= 0).toBe(true);
            expect(collection.url()).toBe(Routing.generate('api_get_skills'));
            expect(collection.model).toEqual(SkillModel);
        });
        
    });
})