// This file is autogenerated. See modules.json and autogenerator.py for details

/*
	paraminfo.js

	MediaWiki API Demos
	Demo of `Paraminfo` module: Get information about other action API modules and their parameters.

	MIT License
*/

var params = {
		action: 'paraminfo',
		format: 'json',
		modules: 'parse|query+info|query'
	},
	api = new mw.Api();

api.get( params ).done( function ( data ) {
	console.log( data );
} );
