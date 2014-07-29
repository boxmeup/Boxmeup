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
		compass: {
			dist: {
				options: {
					sassDir: 'scss',
					cssDir: 'web/css',
					environment: 'production'
				}
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
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-requirejs');

	grunt.loadTasks('tasks');

	grunt.registerTask('default', ['jshint']);
	grunt.registerTask('build', ['compass', 'requirejs', 'releaseStamp']);
};
