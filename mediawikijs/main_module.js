// This file is autogenerated. See modules.json and autogenerator.py for details

/*
	main_module.js

	MediaWiki API Demos
	Demo of `Main module` module: Get help for the main module.

	MIT License
*/

var params = {
		action: 'help',
		wrap: '',
		format: 'json'
	},
	api = new mw.Api();

api.get( params ).done( function ( data ) {
	console.log( data );
} );
