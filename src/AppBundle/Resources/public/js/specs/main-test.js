require.config({
    baseUrl: '/bundles/app/js/thirdparty/',
    paths: {
        'jasmine': 'jasmine-core/lib/jasmine-core/jasmine',
        'jasmine-html': 'jasmine-core/lib/jasmine-core/jasmine-html',
        'jasmine-boot': 'jasmine-core/lib/jasmine-core/boot',
        'underscore': 'underscore/underscore',
        'backbone': 'backbone/backbone',
        'marionette': 'backbone.marionette/lib/backbone.marionette',
        'jquery': 'jquery/dist/jquery',
        'text': 'text/text',
        'bootstrap': 'bootstrap/dist/js/bootstrap',
        'specs': '../specs/',
        'main': '../main/'
    },
    shim: {
        'jasmine-html': {
            deps: ['jasmine']
        },
        'jasmine-boot': {
            deps: ['jasmine', 'jasmine-html']
        },
        underscore: {
            exports: '_'
        },
        backbone: {
            exports: 'Backbone',
            deps: ['jquery', 'underscore']
        },
        marionette: {
            exports: 'Marionette',
            deps: ['backbone']
        },
        bootstrap: {
            deps: ['jquery']
        }
    }
});

require(['jasmine-boot'], function () {
    require([
        'specs/ModelSpec',
        'specs/CollectionSpec',
        'specs/ViewSpec'
    ], function () {
        window.onload();
    });
});