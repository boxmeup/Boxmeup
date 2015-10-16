/*global module:false*/
module.exports = function(grunt) {
	"use strict";
	var pkg, name, file;

	file = grunt.file;

	pkg = file.readJSON('package.json');
	name = pkg.name;
	grunt.initConfig({
		jshint: {
			options : {
				jshintrc : "jshint.json",
				ignores : [
					'web/js/build.js'
				]
			},
			source : ['web/js/**/*.js']
		},
		sass: {
			dist: {
				options: {
					outputStyle: 'compressed'
				},
				files: {
					'web/css/app.css': 'scss/app.scss',
					'web/css/login.css': 'scss/login.scss'
				}
			}
		},
		copy: {
			'compass-mixins': {
				files: [
					{
						expand: true,
						cwd: 'node_modules/compass-mixins/lib',
						src: '**/*',
						dest: 'scss/vendor/compass-mixins/'
					}
				]
			}
		},
		requirejs: {
			compile: {
				options: {
					baseUrl: "web/js",
					mainConfigFile: "web/js/main.js",
					name: "main",
					out: "web/js/build.js"
				}
			}
		},
		releaseStamp: {
			out: 'release.txt'
		}
	});
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-requirejs');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-sass');

	grunt.loadTasks('contrib/tasks');

	grunt.registerTask('build-sass', ['copy:compass-mixins', 'sass:dist']);
	grunt.registerTask('default', ['jshint', 'build-sass']);
	grunt.registerTask('build', ['build-sass', 'requirejs', 'releaseStamp']);
	grunt.registerTask('ci', ['jshint']);
};
