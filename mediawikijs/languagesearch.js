// This file is autogenerated. See modules.json and autogenerator.py for details

/*
	languagesearch.js

	MediaWiki API Demos
	Demo of `Languagesearch` module: Search for a language in any language

	MIT License
*/

var params = {
		action: 'languagesearch',
		search: 'Gu',
		format: 'json'
	},
	api = new mw.Api();

api.get( params ).done( function ( data ) {
	var langs = data.languagesearch,
		lang;
	for ( lang in langs ) {
		console.log( lang + ': ' + langs[ lang ] );
	}
} );
