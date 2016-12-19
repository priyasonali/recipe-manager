/*
 |--------------------------------------------------------------------------
 | Browser-sync config file
 |--------------------------------------------------------------------------
 |
 | For up-to-date information about the options:
 |   http://www.browsersync.io/docs/options/
 |
 | There are more options than you see here, these are just the ones that are
 | set internally. See the website for more info.
 |
 |
 */
module.exports = {
	files: [
				'*.html',
				'./stylesheets/css/*.css',
				'./scripts/*.js',
				'./scripts/controllers/*.js',
				'./scripts/directives/*.js',
				'./scripts/filters/*js',
				'./scripts/services/*.js'
	],
	proxy: 'localhost',
	port: 1337,
	open: false
};
