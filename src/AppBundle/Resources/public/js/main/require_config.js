var require_config = {
    baseUrl: '/bundles/app/js/thirdparty/',
	paths: {
		underscore: 'underscore/underscore',
		backbone: 'backbone/backbone',
		marionette: 'backbone.marionette/lib/backbone.marionette',
		jquery: 'jquery/dist/jquery',
		text: 'text/text',
        bootstrap: 'bootstrap/dist/js/bootstrap',
        main: '../main/'
	},
	shim: {
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
};