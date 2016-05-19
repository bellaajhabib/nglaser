define([
    'main/model/SkillModel',
    'main/view/pages/skill/SkillView',
    'main/model/JobModel',
    'main/view/pages/job/JobView'
], function (SkillModel, SkillView, JobModel, JobView) {


    describe("View Tests", function () {

        it("Skill View Should set the class name base on the model", function() {
            
            var skillModel = new SkillModel();
            var skillView = new SkillView({model: skillModel});
            skillModel.set('level', 1);
            expect(skillView.className()).toBe('label label-info');
            skillModel.set('level', 2);
            expect(skillView.className()).toBe('label label-warning');
            skillModel.set('level', 3);
            expect(skillView.className()).toBe('label label-success');
            skillModel.set('level', 4);
            expect(skillView.className()).toBe('label label-danger');
            skillModel.set('level', 6);
            expect(skillView.className()).toBe('label label-info');
            skillModel.set('level', 'crap');
            expect(skillView.className()).toBe('label label-info');

        });
        
        
        it("Job Model make sure getEndDate is null ", function() {
            var jobModel = new JobModel();
            var jobView = new JobView({model: jobModel});
            expect(jobView.templateHelpers().getEndDate()).toBe('Current');
            jobModel.set('endDate', 'Feb /2015');
            expect(jobView.templateHelpers().getEndDate()).toBe('Feb /2015');
        });
            
    });

})