define([
    'main/model/PageModel',
    'main/model/SettingModel',
    'main/model/CommunityModel',
    'main/model/JobModel',
    'main/model/ProjectModel',
    'main/model/SkillModel'
], function (PageModel, SettingModel, CommunityModel, JobModel, ProjectModel, SkillModel) {


    describe("Model Tests", function () {

        it("Page Model Should parse json data", function () {
            var page = new PageModel();
            var pageJson = {
                "id": 10,
                "created_at": "11/30/2015",
                "updated_at": "11/30/2015",
                "title": "This is example page",
                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pellentesque pulvinar dictum. Morbi fringilla nunc sed turpis scelerisque, a efficitur enim sodales. Donec dapibus, nibh eu ornare feugiat, diam erat tempor magna, eu fermentum quam dolor vitae mauris. Cras consequat odio ut augue venenatis ultricies. Sed malesuada, mi sit amet volutpat sollicitudin, ante dui pulvinar lectus, ut elementum massa risus sit amet erat. Vestibulum congue tincidunt ligula, et tempor nisi faucibus et. Sed vitae nunc quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus egestas efficitur auctor. Donec sit amet lacus maximus, imperdiet velit in, mattis diam. Fusce auctor ut nibh eget venenatis. Quisque in bibendum leo.",
                "picture_url": "example.jpg",
                "_links": {
                  "_self": {
                    "href": "/api/pages/10"
                  },
                  "_all": {
                    "href": "/api/pages"
                  }
                }
              };
            var pageParsed = page.parse(pageJson);
            expect(pageParsed.title).toBe('This is example page');            
            expect(pageParsed.description).toBe(pageJson.description);
            expect(pageParsed.createdAt).toBe('11/30/2015');
            expect(pageParsed.updatedAt).toBe('11/30/2015');
            expect(pageParsed.picture).toBe('example.jpg');
        });
        
        it("Setting Model should parse json data", function(){
            var settingJson = {
                "id": 4,
                "created_at": "11/30/2015",
                "updated_at": "11/30/2015",
                "name": "email",
                "value": "example@email.com",
                "_links": {
                  "_self": {
                    "href": "/api/settings/4"
                  },
                  "_all": {
                    "href": "/api/settings"
                  }
                }
              };
            var settingModel = new SettingModel();
            var settingParsed = settingModel.parse(settingJson);
            expect(settingParsed.id).toBe(4);
            expect(settingParsed.name).toBe('email');
            expect(settingParsed.value).toBe('example@email.com');

        });
       
        
        it("Community Model should parse json data", function(){
            var communityJson = {
                "id": 2,
                "title": "Another Test",
                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget purus dictum, egestas nisi a, egestas enim. Morbi mollis neque et risus pharetra euismod. Sed mattis, mauris vitae auctor consequat, ipsum justo pulvinar sem, quis blandit nisi sem sit ",
                "organization": "Blue Moon",
                "start_date": "February, 2014",
                "end_date": null,
                "url": "http://www.google.com",
                "position": 5,
                "_links": {
                  "_self": {
                    "href": "/api/communities/2"
                  }
                }
              };
            var communityModel = new CommunityModel();
            var communityParsed = communityModel.parse(communityJson);
            expect(communityParsed.id).toBe(2);
            expect(communityParsed.title).toBe('Another Test');
            expect(communityParsed.description).toBe(communityJson.description);
            expect(communityParsed.organization).toBe('Blue Moon');
            expect(communityParsed.url).toBe('http://www.google.com');
            expect(communityParsed.startDate).toBe('February, 2014');
            expect(communityParsed.endDate).toBe(null);
            expect(communityParsed.position).toBe(5);

        });
        
        it("Job Model should parse json data", function(){
            var jobJson = {
                "id": 1,
                "title": "Example Title",
                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas rutrum urna convallis, faucibus dui vitae, consectetur leo. Aliquam ac lorem id lorem facilisis pharetra. Aenean ut pretium justo. Suspendisse ullamcorper lectus ut fringilla laoreet. Suspendisse aliquam sagittis lacus, at suscipit tellus ullamcorper in. Nam faucibus metus pharetra faucibus finibus. Sed ac leo odio. Sed in dolor lectus. Quisque consectetur arcu eget tellus iaculis, non scelerisque nulla fringilla.",
                "start_date": "June, 2014",
                "end_date": "October, 2015",
                "company": "Example Company",
                "_links": {
                  "_self": {
                    "href": "/api/jobs/1"
                  }
                }
              };
            var jobModel = new JobModel();
            var jobParsed = jobModel.parse(jobJson);
            expect(jobParsed.id).toBe(1);
            expect(jobParsed.title).toBe('Example Title');
            expect(jobParsed.description).toBe(jobJson.description);
            expect(jobParsed.company).toBe('Example Company');
            expect(jobParsed.startDate).toBe('June, 2014');
            expect(jobParsed.endDate).toBe('October, 2015');
        });
        
        
        it("Project Model should parse json data", function(){
            var projectJson = {
                "id": 2,
                "name": "Example Project One",
                "description": "sdfasdfasdfasdfaslkdmflaksdjf\r\nasdfkasdlkfjaskldjfa;klsdjfkasd\r\nfaksdjflkasdjf;lkasjdfa\r\nsdfkalsdjflaksdfa",
                "position": 3,
                "url": "http://www.google.com",
                "_links": {
                  "_self": {
                    "href": "/api/projects/2"
                  }
                }
              };
            var projectModel = new ProjectModel();
            var projectParsed = projectModel.parse(projectJson);
            expect(projectParsed.id).toBe(2);
            expect(projectParsed.name).toBe('Example Project One');
            expect(projectParsed.description).toBe(projectJson.description);
            expect(projectParsed.position).toBe(3);
            expect(projectParsed.url).toBe('http://www.google.com');
        });
        
        it("Skill Model Should Parse Json Data", function(){
            var skillJson = {
                    "id": 1,
                    "name": "Javascript",
                    "level": 1,
                    "position": 2,
                    "type": "frontend",
                    "url": "http://www.yahoo.com",
                    "_links": {
                      "_self": {
                        "href": "/api/skills/1"
                      }
                    }
                  };
            
            var skillModel = new SkillModel();
            var skillParsed = skillModel.parse(skillJson);
            expect(skillParsed.id).toBe(1);
            expect(skillParsed.name).toBe('Javascript');
            expect(skillParsed.type).toBe('frontend');
            expect(skillParsed.position).toBe(2);
            expect(skillParsed.level).toBe(1);
            expect(skillParsed.url).toBe('http://www.yahoo.com');

        });
        
        it("Skill Model Should do label class", function() {
            var skillModel = new SkillModel();
            skillModel.set('level', 1);
            expect(skillModel.getLabelClass()).toBe('label-info');
            skillModel.set('level', 2);
            expect(skillModel.getLabelClass()).toBe('label-warning');
            skillModel.set('level', 3);
            expect(skillModel.getLabelClass()).toBe('label-success');
            skillModel.set('level', 4);
            expect(skillModel.getLabelClass()).toBe('label-danger');
            skillModel.set('level', 6);
            expect(skillModel.getLabelClass()).toBe('label-info');
            skillModel.set('level', 'crap');
            expect(skillModel.getLabelClass()).toBe('label-info');

        });
            
    });

})